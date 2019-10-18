<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settingsms
 *
 * @author Prasan Srisopa
 */
class Settingsms extends CI_Controller {

    //put your code here
    public $menu_id = 7;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/settingsms_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-bell',
            'title' => 'เครดิตSMS',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'datas' => $this->settingsms_model->get_settingsms(),
        );
        $this->renderViewAdmin('settingsms_view', $data);
    }

    public function add() {
        $data = array(
            'setting_sms_number' => $this->input->post('setting_sms_number'),
            'setting_sms_username' => $this->input->post('setting_sms_username'),
            'setting_sms_password' => $this->input->post('setting_sms_password'),
            'credit_sum' => 0,
            'credit_balance' => $this->input->post('credit_balance'),
            'credit_all' => 0,
            'shop_id_pri' => $this->input->post('shop_id_pri'),
            'date_modify' => $this->mics->getdate()
        );
        $this->settingsms_model->add($data);
        redirect(base_url('admin/settingsms'));
    }

    public function settingsmsedit() {
        $id = $this->input->post('setting_sms_id');
        $data = array(
            'data' => $this->settingsms_model->get_settingsms($id)->row(),
        );
        $this->load->view('admin/modal/edit_settingsms_modal', $data);
    }

    public function edit() {
        $settingsms = $this->settingsms_model->get_settingsms($this->input->post('setting_sms_id'))->row();
                
        $data = array(
            'setting_sms_number' => $this->input->post('setting_sms_number'),
            'setting_sms_username' => $this->input->post('setting_sms_username'),
            'setting_sms_password' => $this->input->post('setting_sms_password'),
            'credit_sum' => $this->input->post('credit_sum'),
            'credit_balance' => $this->input->post('credit_balance'),
            'date_modify' => $this->mics->getdate()
        );
        $this->settingsms_model->edit($this->input->post('setting_sms_id'), $data);
        
        $action_text = 'แก้ไข ('.$settingsms->setting_sms_number.'|'.$this->input->post('setting_sms_number').' : '.$settingsms->setting_sms_username.'|'.$this->input->post('setting_sms_username').') เครดิต SMS ที่ส่งไปจาก '.$settingsms->credit_sum.' เป็น ' . $this->input->post('credit_sum') .' และ เครดิต SMS คงเหลือจาก '.$settingsms->credit_balance.' เป็น '.$this->input->post('credit_balance');
        $shop_id_pri = $settingsms->shop_id_pri;
        $this->systemlog->log_creditsms($action_text, $shop_id_pri);
        
        redirect(base_url('admin/settingsms'));
    }

    public function delete($id) {
        $this->settingsms_model->delete($id);
        redirect(base_url('admin/settingsms'));
    }
    
    public function settingsmsadd() {
        $id = $this->input->post('setting_sms_id');
        $data = array(
            'data' => $this->settingsms_model->get_settingsms($id)->row(),
        );
        $this->load->view('admin/modal/settingsms_add', $data);
    }
    
    public function smsadd() {
        $data = array(
            'credit_balance' => $this->input->post('credit_balance') + $this->input->post('sms_amount'),
            'date_modify' => $this->mics->getdate()
        );
        $this->settingsms_model->edit($this->input->post('setting_sms_id'), $data);
             
        $action_text = 'เพิ่มเครดิต SMS จำนวน ' . $this->input->post('sms_amount');
        $shop_id_pri = $this->settingsms_model->get_settingsms($this->input->post('setting_sms_id'))->row()->shop_id_pri;
        $this->systemlog->log_creditsms($action_text, $shop_id_pri);
        
        redirect(base_url('admin/settingsms'));
    }

}
