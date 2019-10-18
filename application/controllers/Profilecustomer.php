<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profilecustomer
 *
 * @author Prasan Srisopa
 */
class Profilecustomer extends CI_Controller{
    //put your code here
    public $group_id = 4;
    public $menu_id = 60;
    
    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('profilecustomer_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/profilecustomer.js'),
            'data' => $this->profilecustomer_model->get_customer($this->session->userdata('user_id'))->row(),
        );
        $this->renderView('profilecustomer_view', $data);
    }

    public function edit() {
        $data = array(
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'fullname' => $this->input->post('fullname'),
            'tel' => $this->input->post('tel'),
            'style' => $this->input->post('style'),
            'date_modify' => $this->mics->getdate()
        );
        $this->profilecustomer_model->edit($this->input->post('customer_id_pri'), $data);
        redirect(base_url() . 'profilecustomer');
    }

    public function modaleditpassword() {
        $data = array(
            'customer_id_pri' => $this->input->post('customer_id_pri'),
            'customer_id' => $this->input->post('customer_id'),
            'username' => $this->input->post('username')
        );
        $this->load->view('modal/edit_passwordcustomer_modal', $data);
    }

    public function checkpassword() {
        $customer_id_pri = $this->input->post('customer_id_pri');
        $password = md5($this->input->post('username') . $this->input->post('password'));
        $checkpassword = $this->profilecustomer_model->checkpassword($customer_id_pri, $password);
        if ($checkpassword->num_rows() == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function editpassword() {
        $customer_id_pri = $this->input->post('customer_id_pri');
        $password = md5($this->input->post('username') . $this->input->post('oldpassword'));
        $checkpassword = $this->profilecustomer_model->checkpassword($customer_id_pri, $password);
        if ($checkpassword->num_rows() == 1) {
            if ($this->input->post('newpassword') == $this->input->post('confirmpassword')) {
                $data = array(
                    'password' => md5($this->input->post('username') . $this->input->post('newpassword')),
                );
                $this->profilecustomer_model->edit($this->input->post('customer_id_pri'), $data);
                echo 1;
            } else {
                echo 3;
            }
        } else {
            echo 2;
        }
    }
    
    public function upload_image() {
        $json = array();
        $this->load->library('image_lib');

        $path = "./assets/upload/img/"; //server path
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|png',
            'overwrite' => 1,
            'max_size' => 8192
        );

        $this->load->library('upload', $config);
        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data = array(
                    'image_name' => $this->upload->data('file_name'),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->insert('image', $data);
                $image_id = $this->db->insert_id();
                $data_shop = array(
                    'image_id' => $image_id,
                    'date_modify' => $this->mics->getDate()
                );
                $this->profilecustomer_model->edit($this->session->userdata('user_id'), $data_shop);
                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }
}
