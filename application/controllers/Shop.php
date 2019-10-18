<?php

class Shop extends CI_Controller {

    public $group_id = 2;
    public $menu_id = 3;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('shop_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/shop.js'),
        );
        $this->renderView('shop_view', $data);
    }

    public function ajax() {
        $data = array(
            'datas' => $this->shop_model->get_shop(),
        );
        $this->load->view('ajax/shop_page', $data);
    }

    public function edit_modal() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->shop_model->get_shop($id)->row(),
        );
        $this->load->view('modal/edit_shop_modal', $data);
    }

    public function edit() {
        $data = array(
            'shop_id_pri' => $this->input->post('shop_id_pri'),
            'shop_name' => $this->input->post('shop_name'),
            'tax_id' => $this->input->post('tax_id'),
            'tel_shop' => $this->input->post('tel_shop'),
            'fax_shop' => $this->input->post('fax_shop'),
            'website_shop' => $this->input->post('website_shop'),
            'email_shop' => $this->input->post('email_shop'),
            'address_shop' => $this->input->post('address_shop'),
            'status_shop_id' => $this->input->post('status_shop_id'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->where('shop_id_pri', $data['shop_id_pri'])->update('shop', $data);
    }
    
    public function editpassword() {
        $this->shop_model->edit($this->input->post('user_id'),array('password' => md5($this->input->post('username').'1234')));               
        $data = array(
            'datas' => $this->shop_model->get_shop(),
        );
        $this->load->view('ajax/shop_page', $data);
    } 

}
