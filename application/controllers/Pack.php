<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pack
 *
 * @author Prasan Srisopa
 */
class Pack extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 45;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('pack_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/pack.js'),
        );
        $this->renderView('pack_view', $data);
    }

    public function dataunready() {
        $dateunready_start = $this->input->post('dateunready_start');
        $dateunready_end = $this->input->post('dateunready_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'datas' => $this->pack_model->get_receipt_master_unready($dateunready_start,$dateunready_end,$transport_service_id),
        );
        $this->load->view('ajax/pack_unready', $data);
    }

    public function datasuccess() {   
        $datesuccess_start = $this->input->post('datesuccess_start');
        $datesuccess_end = $this->input->post('datesuccess_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'datas' => $this->pack_model->get_receipt_master_success($datesuccess_start,$datesuccess_end,$transport_service_id),
        );
        $this->load->view('ajax/pack_success', $data);
    }

    public function datanumunready() {
        echo $this->pack_model->get_receipt_master_unready()->num_rows();
    }

    public function datanumsuccess() {
        echo $this->pack_model->get_receipt_master_success()->num_rows();
    }

    public function datadetail() {
        $data = array(
            'receipt_master_id' => $this->input->post('receipt_master_id'), //$this->pack_model->get_receipt_detail($receipt_master_id_pri),
        );
        $this->load->view('ajax/pack_detail', $data);
    }

    public function checkdetail() {
        $receipt_master_id = $this->input->post('receipt_master_id');
        $receipt_master_id_pri = $this->pack_model->get_receipt_master_id($receipt_master_id);
        if ($receipt_master_id_pri->num_rows() > 0) {
            if ($receipt_master_id_pri->row()->status_pack_id == 1) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function edit() {
        $receipt_master_id = $this->input->post('receipt_master_id');
        $receipt_master_id_pri = $this->pack_model->get_receipt_master_id($receipt_master_id)->row()->receipt_master_id_pri;
        $transport_tracking_id = $this->input->post('transport_tracking_id');
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'transport_tracking_id' => $transport_tracking_id,
            'status_pack_id' => 2,
            'date_pack' => $this->mics->getDate(),
        );
        $this->pack_model->edit($receipt_master_id_pri,$data);
        $this->systemlog->log_receipt($receipt_master_id_pri, $this->pack_model->get_user($this->session->userdata('user_id'))->row()->fullname . ' ได้ทำการบรรุจุสินค้า เลขที่รายการ ' . $receipt_master_id);
        echo 1;
    }

}
