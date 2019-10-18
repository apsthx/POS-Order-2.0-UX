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
class Ordersub extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 53;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('ordersub_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/ordersub.js'),
        );
        $this->renderView('ordersub_view', $data);
    }

    public function data() {
        $confirm_order_id = $this->input->post('confirm_order_id');
        $myshop = $this->accesscontrol->getMyShop();
        $data = array(
            'datas' => $this->ordersub_model->get_receipt_master($confirm_order_id, $myshop->shop_id),
        );
        $this->load->view('ajax/ordersub_page', $data);
    }

    public function check_stock() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $details = $this->ordersub_model->get_receipt_master_detail($receipt_master_id_pri);
        $status = "ok";
        if ($details->num_rows() > 0) {
            foreach ($details->result() as $row) {
                $sum_in_stock = $this->ordersub_model->sum_in_stock($row->product_id)->row()->sum;
                if ($sum_in_stock < $row->product_amount) {
                    $status = "fail";
                }
            }
        }
        echo $status;
    }

    public function cancel() {
        $receipt_master_id_pri = $this->input->post('id_pri_cancel');
        $comment = $this->input->post('comment');
        $myshop = $this->accesscontrol->getMyShop();
        $receipt_master = $this->ordersub_model->get_receipt_cancel($receipt_master_id_pri, $myshop->shop_id);
        if ($receipt_master->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;การยกเลิกเกิดข้อผิดพลาด</div>');
            redirect(base_url('ordersub'));
        } else {
            $master = $receipt_master->row();
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'status_receipt_id' => 2,
                'comment' => $comment,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('refer', $myshop->shop_id)
                    ->update('receipt_master', $data);

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ยกเลิกใบสั่งซื้อ เลขที่รายการ ' . $master->receipt_master_id);
            redirect(base_url('ordersub'));
        }
    }

}
