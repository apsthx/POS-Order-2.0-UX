<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase
 *
 * @author Prasan Srisopa
 */
class Invoicelist extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 59;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('invoicelist_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css', 'jquery-ui.min.css'),
            'plugins_js' => array('parsley.min.js'),
            'js' => array('jquery-ui.js', 'build/invoicelist.js')
        );
        $this->renderView('invoicelist_view', $data);
    }

    public function data() {
        $status_transfer_id = $this->input->post('status_transfer_id');
        $myshop = $this->accesscontrol->getMyShop();
        $data = array(
            'datas' => $this->invoicelist_model->get_receipt_master($status_transfer_id, $myshop->shop_id),
        );
        $this->load->view('ajax/invoicelist_page', $data);
    }

    public function modal_alienate() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $receipt_master = $this->invoicelist_model->get_receipt_master_by_id($receipt_master_id_pri)->row();
        $myshop = $this->accesscontrol->getMyShop();
        $data = array(
            'myshop' => $myshop,
            'receipt_master' => $receipt_master
        );
        $this->load->view('modal/alienate_customer_modal', $data);
    }

    public function add_alienate() {
        $data = array(
            'shop_id_pri' => $this->input->post('shop_create_id'),
            'bank_id' => $this->input->post('bank_id'),
            'date_pay' => $this->input->post('date_pay'),
            'time_pay' => $this->input->post('time_pay'),
            'money' => $this->input->post('money'),
            'invoice' => $this->input->post('invoice'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_tel' => $this->input->post('customer_tel'),
            'status_inform_id' => 1,
            'date_modify' => $this->mics->getDate()
        );
        $data['image_id'] = $this->upload_pic($this->input->post('invoice'));
        $this->db->insert('inform_payment', $data);

        $data_invoice = array(
            'user_id' => $this->session->userdata('user_id'),
            'status_pay_id' => 4,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->where('receipt_master_id', $this->input->post('invoice'))
                ->where('shop_id_pri', $this->input->post('shop_create_id'))
                ->update('receipt_master', $data_invoice);

        redirect(base_url() . 'invoicelist');
    }

    private function upload_pic($invoice) {
        $path = "./assets/upload/img/"; //server path
        $file_name_up = $invoice;
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name_up;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 8192;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = array(
                'image_name' => $this->upload->data('file_name'),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('image', $data);
            return $this->db->insert_id();
        } else {
            return 2;
        }
    }

    public function confirm_transfer() {
        $receipt_master_id_pri = $this->input->post('id_pri_invoid');

        $myshop = $this->accesscontrol->getMyShop();
        $receipt_master = $this->invoicelist_model->get_receipt_master_by_id($receipt_master_id_pri);

        if ($receipt_master->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เกิดข้อผิดพลาด</div>');
            redirect(base_url('invoicelist'));
        } else {
            $master = $receipt_master->row();
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'status_transfer_id' => 3,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('customer_id', $myshop->shop_id)
                    ->update('receipt_master', $data);

            $receipt_detail = $this->invoicelist_model->get_detail($receipt_master_id_pri);
            if ($receipt_detail->num_rows() > 0) {
                foreach ($receipt_detail->result() as $detail) {
                    $products = $this->invoicelist_model->get_product_by_id($detail->product_id);
                    if ($products->num_rows() > 0) {
                        $product = $products->row();
                        $product_update = array(
                            'product_amount' => $detail->product_amount + $product->product_amount,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->db->where('product_id_pri', $product->product_id_pri)
                                ->update('product', $product_update);
                    }
                }
            }

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ยืนยันว่าได้รับของแล้ว เลขที่รายการ ' . $master->receipt_master_id);
            redirect(base_url('invoicelist'));
        }
    }

    public function payment() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $receipt_maseter = $this->invoicelist_model->get_receipt_master_by_id($receipt_master_id_pri);
        if ($receipt_maseter->num_rows() == 0) {
            redirect(base_url() . 'invoicelist');
        } else {
            $receipt = $receipt_maseter->row();
        }

        $data_edit = array(
            'user_id' => $this->session->userdata('user_id'),
            'status_pay_id' => 1,
            'date_modify' => $this->mics->getdate()
        );
        $this->invoicelist_model->edit($receipt_master_id_pri, $data_edit);

        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ชำระเงินใบสั่งซื้อ เลขที่รายการ ' . $receipt->receipt_master_id);

        $bank = $this->invoicelist_model->get_bank($this->input->post('bank_id'))->row();
        $bank_update = array(
            'bank_id' => $bank->bank_id,
            'bank_money' => $bank->bank_money - $receipt->price_sum_pay,
            'date_modify' => $this->mics->getDate()
        );
        $this->invoicelist_model->bank_update($bank_update);
        $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . ' จากใบสั่งซื้อ เลขที่ ' . $receipt->receipt_master_id);

        redirect(base_url() . 'invoicelist');
    }

}
