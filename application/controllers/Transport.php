<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receipt
 *
 * @author Prasan Srisopa
 */
class Transport extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 46;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('transport_model');
        $this->load->library('pdf2');
        //$this->load->model('sms_model');
        $this->load->library('thsms');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            //'css' => array('parsley.css'),
            //'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('flash-message.js', 'build/transport.js?v=1'),
        );
        $this->renderView('transport_view', $data);
    }

    public function data() {
        $status_transfer_id = $this->input->post('status_transfer_id');
        $dateunready_start = $this->input->post('dateunready_start');
        $dateunready_end = $this->input->post('dateunready_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'status_transfer_id' => $status_transfer_id,
            'datas' => $this->transport_model->get_receipt_master($status_transfer_id, $dateunready_start, $dateunready_end, $transport_service_id),
        );
        $this->load->view('ajax/transport_page', $data);
    }

    public function transfer_confirme() {
        $select_receipt_checkbox = $this->input->post('select_receipt_checkbox');
        $receipt_master_id_pri_array = $this->input->post('receipt_master_id_pri_arr');
        $status_transfer_id_array = $this->input->post('status_transfer_id_arr');

        $head_sms_id = $this->input->post('head_sms_id');

        $send_sms = $this->input->post('send_sms');

        $receipt_master_id_pri_arr = array();
        $receipt_master_id_pri_update_arr = array();

        for ($i = 1; $i <= sizeof($receipt_master_id_pri_array); $i++) {
            if (isset($select_receipt_checkbox[$i])) {
                if ($select_receipt_checkbox[$i] == 'on') {
                    $receipt_master_id_pri_arr[$i] = $receipt_master_id_pri_array[$i];
                    if ($status_transfer_id_array[$i] == 1) {
                        $receipt_master_id_pri_update_arr[$i] = $receipt_master_id_pri_array[$i];
                    }
                }
            }
        }

        foreach ($receipt_master_id_pri_update_arr as $receipt_master_id_pri) {

            $receipt_master = $this->transport_model->get_receipt_master_id($receipt_master_id_pri)->row();
            $receipt_master_id = $receipt_master->receipt_master_id;
            $transport_service_id = $receipt_master->transport_service_id;

            $product_id_arr = array();
            $product_amount_arr = array();

            $receipt_detail = $this->transport_model->get_detail($receipt_master_id_pri);
            if ($receipt_detail->num_rows() > 0) {
                foreach ($receipt_detail->result() as $detail) {
                    $product_id_arr[] = $detail->product_id;
                    $product_amount_arr[] = $detail->product_amount;
                }
            }

            $this->delete_in_stock($product_id_arr, $product_amount_arr);


            if ($transport_service_id == 3) {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'status_transfer_id' => 3,
                    'date_transfer' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                        ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                        ->update('receipt_master', $data);

                $transport_api = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri,
                    'transport_status_id' => 4,
                    'date_to' => $this->mics->getDate(),
                    'date_success' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate(),
                );
                $this->db->insert('transport_api', $transport_api);
            } else {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'status_transfer_id' => 2,
                    'date_transfer' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                        ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                        ->update('receipt_master', $data);


                $transport_api = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri,
                    'date_to' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate(),
                );
                $this->db->insert('transport_api', $transport_api);
            }
//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ยืนยันการจัดส่งสินค้า เลขที่รายการ ' . $receipt_master_id);
        }

        if ($transport_service_id != 3) {
            $sand_sms_error = "";
            foreach ($receipt_master_id_pri_arr as $receipt_master_id_pri) {
                if ($send_sms == 'on') {
                    $res_transport = $this->sendSMStransport($receipt_master_id_pri,$head_sms_id);//file_get_contents(base_url() . 'sms/sendSMStransport/' . $receipt_master_id_pri . '/' . $head_sms_id);
                    if ($res_transport == 0) {
                        $sand_sms_error .= '<div><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;ไม่สามารถส่ง SMS เลขที่จัดส่ง Tacking id. ของ ' . $receipt_master_id . ' ได้</div>';
                    }
                }
            }
            if ($sand_sms_error != "") {
                $this->session->set_flashdata('flash_message', $sand_sms_error);
            }
        }

        redirect(base_url() . 'transport');
    }

    private function delete_in_stock($product_id_arr, $product_amount_arr) {
        for ($i = 0; $i < sizeof($product_id_arr); $i++) {
            if ($product_id_arr[$i] != "") {

                $product_row = $this->transport_model->get_product($product_id_arr[$i])->row();
                $stocks = $this->transport_model->get_stock($product_id_arr[$i]);
                $amount_all = intval($product_amount_arr[$i]);

                $update_product = array(
                    'product_id_pri' => $product_row->product_id_pri,
                    'product_amount' => $product_row->product_amount - $amount_all,
                    'date_modify' => $this->mics->getDate()
                );
                $this->transport_model->product_update($update_product);

                foreach ($stocks->result() as $stock) {
                    if ($stock->map_product_amount >= $amount_all) {
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => $stock->map_product_amount - $amount_all,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->transport_model->map_stock_update($update);
                        break;
                    } else {
                        $amount_all = $amount_all - $stock->map_product_amount;
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => 0,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->transport_model->map_stock_update($update);
                    }
                }
            }
        }
    }
    
    private function sendSMStransport($receipt_master_id_pri, $head_sms_id) {
        $sms = new thsms();

        $datareceipt = $this->transport_model->get_receipt_master_id($receipt_master_id_pri)->row();
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $datasms = $this->transport_model->get_sms(null, $shop_id_pri)->row();

        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        $tel = $datareceipt->customer_tel;
        if ($head_sms_id == 'null') {
            $head_sms_name = 'เลขใบเสร็จ : ' . $datareceipt->receipt_master_id;
        } else {
            $head_sms_name = $this->transport_model->get_head_sms($head_sms_id)->row()->head_sms_name;
        }
        $text = $head_sms_name . ' -> เลขที่พัสดุ : ' . $datareceipt->transport_tracking_id;

        if ($datasms->credit_balance > 0) {
            $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);

            if ($creditsend[1] == 'OK') {
                $data = array(
                    'credit_sum' => $datasms->credit_sum + 1,
                    'credit_balance' => $datasms->credit_balance - 1,
                    'credit_all' => $creditsend[3],
                );
                $this->transport_model->editsms($datasms->setting_sms_id, $data);
                $action_text = $text . ' ส่งไปยัง ' . $tel;
                $user_id = $this->session->userdata('user_id');
                $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
