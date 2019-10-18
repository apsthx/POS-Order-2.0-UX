<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alienatecustomer
 *
 * @Prasan Srisopa
 */
class Alienatecustomer extends CI_Controller{
    //put your code here
    public $group_id = 9;
    public $menu_id = 69;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('alienatecustomer_model');
    }

    public function index() {
        $data = array(
            'alienatecustomer_category_id' => $this->input->get('category'),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js'),
            'js' => array('build/alienatecustomer.js'),
        );
        $this->renderView('alienatecustomer_view', $data);
    }

    public function ajax() {
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->alienatecustomer_model->get_inform_payment(),
        );
        $this->load->view('ajax/alienatecustomer_page', $data);
    }

    public function modal_add() {
        $this->load->view('modal/alienatecustomer_add_modal');
    }

    public function modal_edit() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->alienatecustomer_model->get_inform_payment($id)->row()
        );
        $this->load->view('modal/alienatecustomer_edit_modal', $data);
    }

    public function add() {       
        $data = array(
            'bank_id' => $this->input->post('bank_id'),
            'date_pay' => $this->input->post('date_pay'),
            'time_pay' => $this->input->post('time_pay'),
            'money' => $this->input->post('money'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_tel' => $this->input->post('customer_tel'),
            'status_inform_id' => 1,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $data['image_id'] = $this->upload_pic($this->input->post('customer_id').'-'.$this->input->post('customer_name').'-'.$this->input->post('date_pay').'-'.date('YmdHis'));
        $this->db->insert('inform_payment', $data);
        redirect(base_url() . 'alienatecustomer');
    }
    
    private function upload_pic($file_name) {
        $path = "./assets/upload/img/"; //server path
        $file_name_up = $file_name;
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name_up;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 8192;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = array(
                'image_name' => $this->upload->data('file_name'),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('image', $data);
            return $this->db->insert_id();
        } else {
            return 2;
        }
    }
}
