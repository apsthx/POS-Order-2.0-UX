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
class Purchase extends CI_Controller{
    //put your code here
    public $group_id = 7;
    public $menu_id = 18;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('purchase_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/purchase.js'),
        );
        $this->renderView('purchase_view', $data);
    }

    public function data() {
        $type_receipt_id = $this->input->post('type_receipt_id');
        $status_pay_id = $this->input->post('status_pay_id');
        $status_transfer_id = $this->input->post('status_transfer_id');
        $status_receipt_id = $this->input->post('status_receipt_id');
        $data = array(
            'datas' => $this->purchase_model->get_receipt_master($status_receipt_id, $type_receipt_id, $status_pay_id, $status_transfer_id),
        );
        $this->load->view('ajax/purchase_page', $data);
    }

    public function modaledit() {
        $data = array(
            'receipt_master_id_pri' => $this->input->post('receipt_master_id_pri'),
        );
        $this->load->view('modal/edit_purchase_modal', $data);
    }

//    public function edit() {
//        $comment = $this->purchase_model->get_receipt_master_id($this->input->post('receipt_master_id_pri'))->row()->comment;
//
//        $data_edit = array(
//            'comment' => $comment . ' : ยกเลิก ' . $this->input->post('comment'),
//            'status_receipt_id' => 2,
//            'date_modify' => $this->mics->getdate()
//        );
//
//        $this->purchase_model->edit($this->input->post('receipt_master_id_pri'), $data_edit);
//
//        $type_receipt_id = $this->input->post('type_receipt_id');
//        $status_pay_id = $this->input->post('status_pay_id');
//        $status_transfer_id = $this->input->post('status_transfer_id');
//        $status_receipt_id = $this->input->post('status_receipt_id');
//        $data = array(
//            'datas' => $this->purchase_model->get_receipt_master($status_receipt_id, $type_receipt_id, $status_pay_id, $status_transfer_id),
//        );
//        $this->load->view('ajax/purchase_page', $data);
//    }
    
    public function edit() {
        $data_receipt = $this->purchase_model->get_receipt_master_id($this->input->post('receipt_master_id_pri'))->row();
        $comment = $data_receipt->comment;

        $data_edit = array(
            'comment' => $comment . ' : ยกเลิกเพราะ ' . $this->input->post('comment'),
            'status_receipt_id' => 2,
            'date_modify' => $this->mics->getdate()
        );

        $this->systemlog->log_receipt($data_receipt->receipt_master_id_pri, 'ยกเลิกเพราะ ' . $this->input->post('comment'));
        $this->purchase_model->edit($data_receipt->receipt_master_id_pri, $data_edit);

        if ($data_receipt->status_pay_id != 2) {
            $bank = $this->purchase_model->get_bank($data_receipt->bank_id)->row();
            $data_bank = array(
                'bank_money' => $bank->bank_money + $data_receipt->price_sum_pay,
                'date_modify' => $this->mics->getdate()
            );
            $this->systemlog->log_bank('ลบเงิน จากการยกเลิกเลขที่ใบเสร็จ ' . $data_receipt->receipt_master_id);
            $this->purchase_model->editbank($data_receipt->bank_id, $data_bank);
        }

        if ($data_receipt->status_transfer_id != 1) {
            $detail = $this->purchase_model->get_receipt_master_detail($data_receipt->receipt_master_id_pri);
            if ($detail->num_rows() > 0) {
                //คืนสินค้า
                foreach ($detail->result() as $detailproduct) {
                    $product = $this->purchase_model->get_product($detailproduct->product_id);
                    if ($product->num_rows() == 1) {                        
                        $data_product = array(
                            'product_amount' => $product->row()->product_amount - $detailproduct->product_amount,
                        );
                        $this->purchase_model->editproduct($product->row()->product_id_pri, $data_product);
                        
                        $map_product_stock = $this->purchase_model->get_map_product_stock($product->row()->product_id_pri)->row(1);
                                              
                        $data_stock = array(
                            'map_product_amount' => $map_product_stock->map_product_amount - $detailproduct->product_amount,
                        );
                        $this->purchase_model->editmapproductstock($map_product_stock->map_product_stock_id, $data_stock);                       
                    }
                }
                                
            }
        }

        $type_receipt_id = $this->input->post('type_receipt_id');
        $status_pay_id = $this->input->post('status_pay_id');
        $status_transfer_id = $this->input->post('status_transfer_id');
        $status_receipt_id = $this->input->post('status_receipt_id');
        $data = array(
            'datas' => $this->purchase_model->get_receipt_master($status_receipt_id, $type_receipt_id, $status_pay_id, $status_transfer_id),
        );
        $this->load->view('ajax/purchase_page', $data);
    }

}
