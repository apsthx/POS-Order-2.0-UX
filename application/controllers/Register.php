<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register
 *
 * @Prasan Srisopa
 */
class Register extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('register_model');
    }

    public function index() {
        $data = array(
            'title' => 'สมัครสมาชิก',
        );
        $this->load->view('register_view', $data);
    }

    public function modalsendsms() {
        $tels = $this->register_model->getusertel($this->input->post('telcheck'));
        if ($tels->num_rows() > 0) {
            echo 1;
        } else {
            $data = array(
                'telcheck' => $this->input->post('telcheck'),
                'refotp' => $this->input->post('refotp'),
                'otp' => $this->input->post('otp'),
            );
            $this->load->view('modal/register_sendsms', $data);
        }
    }

    public function add() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password_confirm = $this->input->post('password_confirm');
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $tel = $this->input->post('telcheck');
        $shop_business = $this->input->post('shop_business');
        $accept = 1;//$this->input->post('accept');
        $input = array(
            'username' => $username,
            'password' => $password,
            'password_confirm' => $password_confirm,
            'fullname' => $fullname,
            'email' => $email,
            'tel' => $tel,
            'shop_business' => $shop_business,
            'accept' => $accept
        );
        $this->check_form_valid($input);
        $password_conv = md5($username . $password);

        $datashop = array(
            'shop_business' => $shop_business,
            'type_shop_id' => 1,
            'image_id' => 2,
            'status_shop_id' => 1,
            'date_create' => $this->mics->getDate(),
            'date_modify' => $this->mics->getDate()
        );
        $shop_id_pri = $this->register_model->addShop($datashop);
        $this->register_model->editShop($shop_id_pri, array('shop_id' => 'S' . $shop_id_pri,'shop_name' => 'S' . $shop_id_pri,'shop_create_id_pri' => $shop_id_pri));
        $shop_id = 'S' . $shop_id_pri;
        $datauser = array(
            'username' => $username,
            'password' => $password_conv,
            'shop_id_pri' => $shop_id_pri,
            'fullname' => $fullname,
            'email' => $email,
            'tel' => $tel,
            'image_id' => 1,
            'role_id' => 2,           
            'type_user_id' => 1,
            'status_id' => 1,
            'style' => 'blue',
            'date_create' => $this->mics->getDate(),
            'date_modify' => $this->mics->getDate()
        );
        $user_id = $this->register_model->addUser($datauser);

        $packagedata = array(
            'user_id' => $user_id,
            'package_id' => 1,
            'package_shop_id_pri' => $shop_id_pri,
            'user_package_modify' => $this->mics->getDate()
        );
        $this->register_model->addUserPackage($packagedata);

        //add detail shop
        $data_stock = array(
            'shop_id_pri' => $shop_id_pri,
            'stock_id' => $shop_id.'W1',
            'stock_name' => 'คลังสินค้าหลัก',
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('stock', $data_stock);

        $data_bank = array(
            'shop_id_pri' => $shop_id_pri,
            'bank_name' => 'เงินสด',
            'type_bank_id' => 1,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('bank', $data_bank);

        $sms = $this->accesscontrol->getemailsms();
        $setting_sms = array(
            'shop_id_pri' => $shop_id_pri,
            'setting_sms_number' => $sms->sms_tel,
            'setting_sms_username' => $sms->sms_username,
            'setting_sms_password' => $sms->sms_password,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('setting_sms', $setting_sms);

        $shop_setting_document = array(
            'shop_id_pri' => $shop_id_pri,
            'product_id_default' => $shop_id.'P',
            'stock_id_default' => $shop_id.'W',
            'stock_number_default' => 2,
            'customer_id_default' => $shop_id.'C',
            'partners_id_default' => $shop_id.'PC',
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('shop_setting_document', $shop_setting_document);

        $transport_setting = array(
            'shop_id_pri' => $shop_id_pri,
            'transport_service_id' => 1,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('transport_setting', $transport_setting);
        $transport_setting_id = $this->db->insert_id();

        $transport_api_setting = array(
            'transport_setting_id' => $transport_setting_id,
            'transport_service_id' => 1
        );
        $this->db->insert('transport_api_setting', $transport_api_setting);
        $transport_api_setting = array(
            'transport_setting_id' => $transport_setting_id,
            'transport_service_id' => 2
        );
        $this->db->insert('transport_api_setting', $transport_api_setting);
        //
        
        $sessiondata = array(
            'user_id' => $user_id,
            'package_id' => 1,
            'shop_id_pri' => $shop_id_pri,
            'role_id' => 2,
            'regenerate_login' => rand(100000, 999999),
        );
        $this->session->set_userdata($sessiondata);

        if ($this->systemlog->checkAddLogin($user_id) == 1) {
            $this->systemlog->updateLoginCheck($user_id, $this->session->userdata('regenerate_login'));
        } else {
            $this->systemlog->addLoginCheck($user_id, $this->session->userdata('regenerate_login'));
        }
        redirect(base_url() . 'login');
    }

    private function check_form_valid($input) {
        $error_text = "";
        if ($this->check_username($input['username']) == '1') {
            $error_text = "Username นี้มีผู้ใช้งานแล้ว";
        } elseif ($this->check_email($input['email']) == '1') {
            $error_text = "Email นี้มีผู้ใช้งานแล้ว";
        } elseif (!preg_match("/^[_a-zA-Z0-9]{4,20}$/", $input['username'])) {
            $error_text = "Username ไม่ถูกต้อง สามารถกรอกได้ _ a-zA-Z0-9 จำนวน 4-20 ตัวอักษร";
        } elseif (!preg_match("/^[a-zA-Z0-9]{6,20}$/", $input['password'])) {
            $error_text = "Password ไม่ถูกต้อง สามารถกรอกได้ a-zA-Z0-9 จำนวน 6-20 ตัวอักษร";
        } elseif ($input['password'] != $input['password_confirm']) {
            $error_text = "Password ไม่ตรงกัน";
        } elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/", $input['email'])) {
            $error_text = "Email ไม่ถูกต้อง";
        } elseif ($input['fullname'] == "") {
            $error_text = "กรุณากรอก ชื่อ-นามสกุล";
        } elseif ($input['accept'] == "") {
            $error_text = "กรุณายอมรับเงื่อนไขการสมัคร";
        }

        if ($error_text != "") {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;' . $error_text . '</div>');
            redirect(base_url() . 'register');
        }
    }

    public function check_username($username = null) {
        if ($username == NULL) {
            $username = $this->input->post('username');
        }
        $count = $this->register_model->checkUsername($username);
        if ($count > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    public function check_email($email = null) {
        if ($email == NULL) {
            $email = $this->input->post('email');
        }
        $count = $this->register_model->checkEmail($email);
        if ($count > 0) {
            return '1';
        } else {
            return '0';
        }
    }

}
