<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Package
 *
 * @author Prasan Srisopa
 */
class Package extends CI_Controller {

    //put your code here
    public $menu_id = 2;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/package_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-gift',
            'title' => 'แพ็กเกจ',
            'css' => array(),
            'js' => array(),
            'datas' => $this->package_model->getPackage(),
            'datassms' => $this->package_model->getSMS()
        );
        $this->renderViewAdmin('package_view', $data);
    }

    public function Packageadd() {
        $this->load->view('admin/modal/package_add');
    }

    public function add() {
        $data = array(
            'package_name' => $this->input->post('package_name'),
            'package_cost' => $this->input->post('package_cost'),
            'package_useuser' => $this->input->post('package_useuser'),
            'package_sms' => $this->input->post('package_sms'),
            'package_useshop' => $this->input->post('package_useshop'),
            'package_useagent' => $this->input->post('package_useagent'),
            'package_usedate' => $this->input->post('package_usedate'),
            'package_status' => 1,
            'package_modify' => $this->mics->getdate()
        );
        $this->package_model->add($data);
        redirect(base_url('admin/package'));
    }

    public function Packageedit() {
        $id = $this->input->post('package_id');
        $data = array(
            'data' => $this->package_model->getPackage($id)->row(),
        );
        $this->load->view('admin/modal/package_edit', $data);
    }

    public function edit() {
        $data = array(
            'package_name' => $this->input->post('package_name'),
            'package_cost' => $this->input->post('package_cost'),
            'package_useuser' => $this->input->post('package_useuser'),
            'package_sms' => $this->input->post('package_sms'),
            'package_useshop' => $this->input->post('package_useshop'),
            'package_useagent' => $this->input->post('package_useagent'),
            'package_usedate' => $this->input->post('package_usedate'),
            'package_modify' => $this->mics->getdate()
        );
        $this->package_model->edit($this->input->post('package_id'), $data);
        redirect(base_url('admin/package'));
    }

    public function Packageeditstatus() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
        );
        $this->load->view('admin/modal/package_editstatus', $data);
    }

    public function editstatus() {
        $this->package_model->edit($this->input->post('package_id'), array('package_status' => 2, 'package_modify' => $this->mics->getdate()));
        redirect(base_url('admin/package'));
    }

    public function editchangestatus() {
        $this->package_model->edit($this->input->post('package_id'), array('package_status' => 1, 'package_modify' => $this->mics->getdate()));
        echo 1;
    }

    public function PackageView() {
        $id = $this->input->post('package_id');
        $data = array(
            'datas' => $this->package_model->getUserPackage($id),
        );
        $this->load->view('admin/modal/packageuser_view', $data);
    }
    
    public function smsadd() {
        $this->load->view('admin/modal/sms_add');
    }

    public function addsms() {
        $data = array(
            'sms_name' => $this->input->post('sms_name'),
            'sms_cost' => $this->input->post('sms_cost'),
            'sms_amount' => $this->input->post('sms_amount'),
            'sms_status' => 1,
            'sms_modify' => $this->mics->getdate()
        );
        $this->package_model->addsms($data);
        redirect(base_url('admin/package'));
    }

    public function smsedit() {
        $id = $this->input->post('sms_id');
        $data = array(
            'data' => $this->package_model->getSMS($id)->row(),
        );
        $this->load->view('admin/modal/sms_edit', $data);
    }

    public function editsms() {
        $data = array(
            'sms_name' => $this->input->post('sms_name'),
            'sms_cost' => $this->input->post('sms_cost'),
            'sms_amount' => $this->input->post('sms_amount'),
            'sms_modify' => $this->mics->getdate()
        );
        $this->package_model->editsms($this->input->post('sms_id'), $data);
        redirect(base_url('admin/package'));
    }

    public function smseditstatus() {
        $data = array(
            'sms_id' => $this->input->post('sms_id'),
        );
        $this->load->view('admin/modal/sms_editstatus', $data);
    }

    public function editstatussms() {
        $this->package_model->editsms($this->input->post('sms_id'), array('sms_status' => 2, 'sms_modify' => $this->mics->getdate()));
        redirect(base_url('admin/package'));
    }

    public function smseditchangestatus() {
        $this->package_model->editsms($this->input->post('sms_id'), array('sms_status' => 1, 'sms_modify' => $this->mics->getdate()));
        echo 1;
    }
    
    public function set() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
        );
        $this->load->view('admin/modal/set_package_modal', $data);
    }
    
    public function addpackage() {
        $data = array(
            'package_id' => $this->input->post('package_id'),
            'menu_id' => $this->input->post('menu_id'),
        );
        $this->package_model->addpackage($data);
    }

    public function delete() {
        $package_id = $this->input->post('package_id');
        $menu_id = $this->input->post('menu_id');
        $this->package_model->deletepackage($package_id,$menu_id);
    }

}
