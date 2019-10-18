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
    public $group_id = 1;
    public $menu_id = 29;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('settingsms_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/settingsms.js'),
            'datas' => $this->settingsms_model->get_settingsms(),
        );
        $this->renderView('settingsms_view', $data);
    }

    public function add() {
        $data = array(
            'setting_sms_number' => $this->input->post('setting_sms_number'),
            'setting_sms_username' => $this->input->post('setting_sms_username'),
            'setting_sms_password' => $this->input->post('setting_sms_password'),
            'credit_all' => $this->input->post('credit_all'),
            'credit_balance' => 0,
            'credit_sum' => 0,
            'shop_id_pri' => $this->input->post('shop_id_pri'),
            'date_modify' => $this->mics->getdate()
        );
        $this->settingsms_model->add($data);
        redirect(base_url('settingsms'));
    }

    public function settingsmsedit() {
        $id = $this->input->post('setting_sms_id');
        $data = array(
            'data' => $this->settingsms_model->get_settingsms($id)->row(),
        );
        $this->load->view('modal/edit_settingsms_modal', $data);
    }

    public function edit() {
        $data = array(
            'setting_sms_number' => $this->input->post('setting_sms_number'),
            'setting_sms_username' => $this->input->post('setting_sms_username'),
            'setting_sms_password' => $this->input->post('setting_sms_password'),
            'credit_all' => $this->input->post('credit_all'),
            'credit_balance' => $this->input->post('credit_balance'),
            'credit_sum' => $this->input->post('credit_sum'),
            'date_modify' => $this->mics->getdate()
        );
        $this->settingsms_model->edit($this->input->post('setting_sms_id'), $data);
        redirect(base_url('settingsms'));
    }

    public function delete($id) {
        $this->settingsms_model->delete($id);
        redirect(base_url('settingsms'));
    }

}
