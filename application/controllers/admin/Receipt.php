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
class Receipt extends CI_Controller {

    //put your code here 14 21
    public $menu_id = 9;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/receipt_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-money',
            'title' => 'โอนเงิน',
            'css' => array(),
            'js' => array(),
        );
        $this->renderViewAdmin('receipt_view', $data);
    }

    public function loadTable() {
        $datestart = $this->input->post('datestart');
        $dateend = $this->input->post('dateend');
        $check = $this->input->post('check');
        $data = array(
            'datas' => $this->receipt_model->getUserReceiptEvidence($datestart, $dateend, $check),
        );
        $this->load->view('admin/ajax/receipt_load', $data);
    }

    public function check() {
        $receipt_id = $this->input->post('receipt_id');
        $check = $this->input->post('check');
        $data = array(
            'receipt_check' => $check,
        );
        $this->receipt_model->edit($receipt_id, $data);

        if ($check == 1) {
            $check_text = 'ผ่าน';
        } else {
            $check_text = 'ไม่ผ่าน';
        }
        
        $receipt_id = $this->receipt_model->getreceipt($receipt_id);
        if ($receipt_id->package_id != null) {
            $package_name = $this->receipt_model->getPackage($receipt_id->package_id)->package_name;
            $action_text = '(Admin ปรับสถานะ) แจ้งโอนเงิน ชำระค่าแพ็กเกจ ' . $package_name .' : ' .$check_text;
            $shop_id_pri = $this->session->userdata('shop_id_pri');
            $user_id = $this->session->userdata('user_id');
            $this->systemlog->log_sendreceipt($action_text, $receipt_id->shop_id_pri, $receipt_id->user_id);
        }else{
            $sms_name = $this->receipt_model->getSMS($receipt_id->sms_id)->sms_name;
            $action_text = '(Admin ปรับสถานะ) แจ้งโอนเงิน ชำระค่า SMS ' . $sms_name .' : ' .$check_text;
            $shop_id_pri = $this->session->userdata('shop_id_pri');
            $user_id = $this->session->userdata('user_id');
            $this->systemlog->log_sendreceipt($action_text, $receipt_id->shop_id_pri, $receipt_id->user_id);
        }

        echo $check;
    }

}
