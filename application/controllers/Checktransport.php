<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Checktransport
 *
 * @author Prasan Srisopa
 */
class Checktransport extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 79;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('checktransport_model');
        $this->load->library('simple_html_dom');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/checktransport.js'),
        );
        $this->renderView('checktransport_view', $data);
    }

    public function dataunready() {
        $dateunready_start = $this->input->post('dateunready_start');
        $dateunready_end = $this->input->post('dateunready_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $transport_status_id = $this->input->post('transport_status_id');
        $data = array(
            'datas' => $this->checktransport_model->get_transport_api_unready($dateunready_start, $dateunready_end, $transport_service_id, $transport_status_id),
        );
        $this->load->view('ajax/checktransport_unready', $data);
    }

    public function datasuccess() {
        $datesuccess_start = $this->input->post('datesuccess_start');
        $datesuccess_end = $this->input->post('datesuccess_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'datas' => $this->checktransport_model->get_transport_api_success($datesuccess_start, $datesuccess_end, $transport_service_id),
        );
        $this->load->view('ajax/checktransport_success', $data);
    }

    public function modal_detail() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $receipt = $this->checktransport_model->get_receipt_master($receipt_master_id_pri)->row();

        $data = array(
            'receipt' => $receipt
        );
        if ($receipt->transport_service_id == 2) {
            $this->load->view('modal/detail_api_kerry_modal', $data);
        } elseif ($receipt->transport_service_id == 1) {
            $this->load->view('modal/detail_api_ems_modal', $data);
        }
    }

}
