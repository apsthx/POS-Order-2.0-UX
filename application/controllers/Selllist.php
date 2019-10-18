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
class Selllist extends CI_Controller {

    //put your code here
    public $group_id = 8;
    public $menu_id = 48;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('selllist_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            //'css' => array('parsley.css'),
            //'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('flash-message.js', 'build/selllist.js'),
        );
        $this->renderView('selllist_view', $data);
    }

    public function data() {
        $date_select = $this->input->post('date_select');
        $status_receipt_id = $this->input->post('status_receipt_id');
        $data = array(
            'datas' => $this->selllist_model->get_receipt_master($status_receipt_id, $date_select),
        );
        $this->load->view('ajax/selllist_page', $data);
    }

    public function cancel() {
        $receipt_master_id_pri = $this->input->post('id_pri_cancel');
        $comment = $this->input->post('comment');
        $receipt_master = $this->selllist_model->get_receipt_cancel($receipt_master_id_pri);
        if ($receipt_master->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;การยกเลิกเกิดข้อผิดพลาด</div>');
            redirect(base_url('selllist'));
        } else {
            $master = $receipt_master->row();
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'status_receipt_id' => 2,
                'comment' => $comment,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                    ->update('receipt_master', $data);

            $this->cancel_product($receipt_master_id_pri);

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ยกเลิกใบเสร็จ เลขที่รายการ ' . $master->receipt_master_id);


            $bank = $this->selllist_model->get_bank($master->bank_id)->row();
            $bank_update = array(
                'bank_id' => $master->bank_id,
                'bank_money' => $bank->bank_money - $master->price_sum_pay,
                'date_modify' => $this->mics->getDate()
            );
            echo '<pre>';
            print_r($bank_update);
            $this->selllist_model->bank_update($bank_update);
            $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . 'จากใบเสร็จ เลขที่รายการ ' . $master->receipt_master_id);


            redirect(base_url('selllist'));
        }
    }

    private function cancel_product($receipt_master_id_pri) {
        $receipt_detail = $this->selllist_model->get_detail($receipt_master_id_pri);
        if ($receipt_detail->num_rows() > 0) {
            foreach ($receipt_detail->result() as $detail) {
                $product = $this->selllist_model->get_product_by_id($detail->product_id)->row();
                $data = array(
                    'product_id_pri' => $product->product_id_pri,
                    'product_amount' => $detail->product_amount + $product->product_amount,
                    'date_modify' => $this->mics->getDate()
                );
                $this->selllist_model->product_update($data);
            }
        }
    }

    public function print_receipt() {
        $select_receipt_checkbox = $this->input->post('select_receipt_checkbox');
        $receipt_master_id_pri_array = $this->input->post('receipt_master_id_pri_arr');
        $print = $this->input->post('print');

        $receipt_master_id_pri_arr = array();

        for ($i = 1; $i <= sizeof($receipt_master_id_pri_array); $i++) {
            if (isset($select_receipt_checkbox[$i])) {
                if ($select_receipt_checkbox[$i] == 'on') {
                    $receipt_master_id_pri_arr[$i] = $receipt_master_id_pri_array[$i];
                }
            }
        }

        $url = "";
        if ($print == 'a4') {
            $url = base_url() . 'receipt/printbillA4';
        } elseif ($print == 'a5') {
            $url = base_url() . 'receipt/printbillA5';
        }
        echo "<form id='print-submit' action='" . $url . "' method='post' >";
        foreach ($receipt_master_id_pri_arr as $receipt_master_id_pri) {
            echo "<input type='hidden' name='receipt_master_id_pri_arr[]' value='" . $receipt_master_id_pri . "' />";
        }
        echo "</form>";
        echo "<script>document.getElementById('print-submit').submit();</script>";
    }

}
