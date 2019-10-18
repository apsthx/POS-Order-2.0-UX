<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author Prasan Srisopa
 */
class Email extends CI_Controller {

    //put your code here
    public $menu_id = 6;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/email_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-envelope',
            'title' => 'อีเมล์ใช้งาน',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
        );
        $this->renderViewAdmin('email_view', $data);
    }

    public function edit() {
        $data = array(
            'fromaddress' => $this->input->post('fromaddress'),
            'from' => $this->input->post('from'),
            'smtp_host' => $this->input->post('smtp_host'),
            'smtp_port' => $this->input->post('smtp_port'),
            'smtp_user' => $this->input->post('smtp_user'),
            'smtp_password' => $this->input->post('smtp_password'),
        );
        $this->email_model->edit($data);
        redirect(base_url() . 'admin/email');
    }
    
    public function editsms() {
        $data = array(
            'sms_tel' => $this->input->post('sms_tel'),
            'sms_username' => $this->input->post('sms_username'),
            'sms_password' => $this->input->post('sms_password'),
        );
        $this->email_model->edit($data);
        redirect(base_url() . 'admin/email');
    }
}
