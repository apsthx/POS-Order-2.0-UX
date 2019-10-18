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
class Ordermain extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 70;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('ordermain_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/ordermain.js'),
        );
        $this->renderView('ordermain_view', $data);
    }

    public function data() {
        $type_receipt_id = $this->input->post('type_receipt_id');
        $status_pay_id = $this->input->post('status_pay_id');
        $status_transfer_id = $this->input->post('status_transfer_id');
        $status_receipt_id = $this->input->post('status_receipt_id');
        $data = array(
            'datas' => $this->ordermain_model->get_receipt_master($status_receipt_id, $type_receipt_id, $status_pay_id, $status_transfer_id),
        );
        $this->load->view('ajax/ordermain_page', $data);
    }

    public function payment() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $receipt_maseter = $this->ordermain_model->get_receipt_master_id($receipt_master_id_pri, 2, 1);
        if ($receipt_maseter->num_rows() == 0) {
            redirect(base_url() . 'ordermain');
        } else {
            $receipt = $receipt_maseter->row();
        }

        $data_edit = array(
            'user_id' => $this->session->userdata('user_id'),
            'status_pay_id' => 1,
            'status_transfer_id' => 3,
            'date_modify' => $this->mics->getdate()
        );
        $this->ordermain_model->edit($receipt_master_id_pri, $data_edit);

        $detail = $this->ordermain_model->get_receipt_master_detail($receipt_master_id_pri);
        if ($detail->num_rows() > 0) {
            //คืนสินค้า
            foreach ($detail->result() as $detailproduct) {
                $product = $this->ordermain_model->get_product($detailproduct->product_id);
                if ($product->num_rows() == 1) {
                    $data_product = array(
                        'product_amount' => $product->row()->product_amount + $detailproduct->product_amount,
                    );
                    $this->ordermain_model->editproduct($product->row()->product_id_pri, $data_product);
                }
            }
        }

        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ชำระเงินใบสั่งซื้อ เลขที่รายการ ' . $receipt->receipt_master_id);

        $bank = $this->ordermain_model->get_bank($this->input->post('bank_id'))->row();
        $bank_update = array(
            'bank_id' => $bank->bank_id,
            'bank_money' => $bank->bank_money - $receipt->price_sum_pay,
            'date_modify' => $this->mics->getDate()
        );
        $this->ordermain_model->bank_update($bank_update);
        $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . ' จากใบสั่งซื้อ เลขที่ ' . $receipt->receipt_master_id);

        redirect(base_url() . 'ordermain');
    }

    public function cancel() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $receipt_maseter = $this->ordermain_model->get_receipt_master_id($receipt_master_id_pri, NULL, NULL, 1);
        if ($receipt_maseter->num_rows() == 0) {
            redirect(base_url() . 'ordermain');
        } else {
            $receipt = $receipt_maseter->row();
        }

        $data_edit = array(
            'comment' => 'ยกเลิกเพราะ ' . $this->input->post('comment'),
            'status_receipt_id' => 2,
            'date_modify' => $this->mics->getdate()
        );

        $this->ordermain_model->edit($receipt->receipt_master_id_pri, $data_edit);
        $this->systemlog->log_receipt($receipt->receipt_master_id_pri, 'ยกเลิกเพราะ ' . $this->input->post('comment'));

        if ($this->input->post('bank_ck') == '1') {

            $bank = $this->ordermain_model->get_bank($this->input->post('bank_id'))->row();
            $data_bank = array(
                'bank_money' => $bank->bank_money + $receipt->price_sum_pay,
                'date_modify' => $this->mics->getdate()
            );
            $this->systemlog->log_bank('เพิ่มเงิน จากการยกเลิกเลขที่ใบเสร็จ ' . $receipt->receipt_master_id);
            $this->ordermain_model->editbank($bank->bank_id, $data_bank);

            $detail = $this->ordermain_model->get_receipt_master_detail($receipt->receipt_master_id_pri);
            if ($detail->num_rows() > 0) {
                //คืนสินค้า
                foreach ($detail->result() as $detailproduct) {
                    $product = $this->ordermain_model->get_product($detailproduct->product_id);
                    if ($product->num_rows() == 1) {
                        $data_product = array(
                            'product_amount' => $product->row()->product_amount - $detailproduct->product_amount,
                        );
                        $this->ordermain_model->editproduct($product->row()->product_id_pri, $data_product);
                    }
                }
            }
        }
        redirect(base_url() . 'ordermain');
    }

}
