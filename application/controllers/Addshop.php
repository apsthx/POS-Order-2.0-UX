<?php

class Addshop extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 3;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('addshop_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => "fa fa-plus",
            'title' => " สร้างสาขา/ตัวแทนจำหน่าย",
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/addshop.js'),
        );
        $this->renderView('addshop_view', $data);
    }

    public function check_shop_custom_id() {
        $shop_id = $this->input->post('shop_custom_id');
        if ($this->addshop_model->check_shop_id($shop_id) > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function check_username() {
        $username = $this->input->post('username');
        if ($this->addshop_model->check_username($username) > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function add() {
        $type_shop_id = $this->input->post('type_shop_id');
        $checkpackage = $this->checkpackages($type_shop_id);
        echo $checkpackage;
        if ($checkpackage != '1') {
            redirect(base_url() . 'shop');
        } else {
            $shop = $this->addshop_model->getshop($this->session->userdata('shop_id_pri'))->row();
            $data_shop = array(
                'shop_create_id_pri' => $shop->shop_create_id_pri,
                'shop_create_id' => $shop->shop_id_pri,
                'type_shop_id' => $type_shop_id,
                'shop_promptpay_id' => $this->input->post('shop_promptpay_id'),
                'shop_name' => $this->input->post('shop_name'),
                'tax_id' => $this->input->post('tax_id'),
                'tel_shop' => $this->input->post('tel_shop'),
                'fax_shop' => $this->input->post('fax_shop'),
                'website_shop' => $this->input->post('website_shop'),
                'email_shop' => $this->input->post('email_shop'),
                'address_shop' => $this->input->post('address_shop'),
                'image_id' => 2,
                'status_shop_id' => 1,
                'date_create' => $this->mics->getDate(),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('shop', $data_shop);
            $shop_id_pri = $this->db->insert_id();

            $data_shop_id = array(
                'shop_id' => 'S' . $shop_id_pri,
            );
            $this->addshop_model->updateshop($shop_id_pri, $data_shop_id);
            $shop_id = 'S' . $shop_id_pri;

            $username = $this->input->post('username');
            $password = md5($username . $username);
            $data_user = array(
                'shop_id_pri' => $shop_id_pri,
                'username' => $username,
                'password' => $password,
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'tel' => $this->input->post('tel'),
                'role_id' => ($type_shop_id == 2) ? 3 : 4,
                'status_id' => 1,
                'type_user_id' => 1,
                'image_id' => 1,
                'style' => 'blue',
                'date_create' => $this->mics->getDate(),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('user', $data_user);
            $user_id = $this->db->insert_id();

            $userpackage = $this->addshop_model->getuserpackage($this->session->userdata('user_id'))->row();
            $packagedata = array(
                'user_id' => $user_id,
                'package_id' => $userpackage->package_id,
                'package_shop_id_pri' => $userpackage->package_shop_id_pri,
                'user_package_modify' => $userpackage->user_package_modify
            );
            $this->db->insert('user_package', $packagedata);

            $data_stock = array(
                'shop_id_pri' => $shop_id_pri,
                'stock_id' => $shop_id . 'W1',
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
                'product_id_default' => $shop_id . 'P',
                'stock_id_default' => $shop_id . 'W',
                'stock_number_default' => 2,
                'customer_id_default' => $shop_id . 'C',
                'partners_id_default' => $shop_id . 'PC',
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

            redirect(base_url() . 'shop');
        }
    }

    public function checkpackage() {
        $type_shop_id = $this->input->post('type_shop_id'); //ajax
        $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
        if ($type_shop_id == 2) {
            if ($this->accesscontrol->checkuseshop($package_shop->package_shop_id_pri) >= $this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useshop) {
                echo 2;
            } else {
                echo 1;
            }
        } else if ($type_shop_id == 3) {
            if ($this->accesscontrol->checkuseagent($package_shop->package_shop_id_pri) >= $this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useagent) {
                echo 3;
            } else {
                echo 1;
            }
        }
    }

    public function checkpackages($type_shop_id) {
        $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
        if ($type_shop_id == 2) {
            if ($this->accesscontrol->checkuseshop($package_shop->package_shop_id_pri) >= $this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useshop) {
                return 2;
            } else {
                return 1;
            }
        } else if ($type_shop_id == 3) {
            if ($this->accesscontrol->checkuseagent($package_shop->package_shop_id_pri) >= $this->accesscontrol->getPackage($this->session->userdata('package_id'))->row()->package_useagent) {
                return 3;
            } else {
                return 1;
            }
        }
    }

}
