<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile
 *
 * @author Prasan Srisopa
 */
class Profile extends CI_Controller {

    //put your code here
    public $menu_id = 0;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/profile_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user',
            'title' => 'ข้อมูลส่วนตัว',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'data' => $this->profile_model->get_admin($this->session->userdata('admin_id'))->row(),
        );
        $this->renderViewAdmin('profile_view', $data);
    }

    public function edit() {
        $data = array(
            'username' => $this->input->post('username'),
            'name' => $this->input->post('name'),
        );
        $this->profile_model->edit($this->input->post('admin_id'), $data);
        redirect(base_url() . 'admin/profile');
    }

    public function modaleditpassword() {
        $data = array(
            'admin_id' => $this->input->post('admin_id'),
        );
        $this->load->view('admin/modal/edit_password_modal', $data);
    }

    public function checkpassword() {
        $admin_id = $this->input->post('admin_id');
        $password = $this->input->post('password');
        $checkpassword = $this->profile_model->checkpassword($admin_id, $password);
        if ($checkpassword->num_rows() == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function editpassword() {
        $admin_id = $this->input->post('admin_id');
        $password = $this->input->post('oldpassword');
        $checkpassword = $this->profile_model->checkpassword($admin_id, $password);
        if ($checkpassword->num_rows() == 1) {
            if ($this->input->post('newpassword') == $this->input->post('confirmpassword')) {
                $data = array(
                    'password' => $this->input->post('newpassword'),
                );
                $this->profile_model->edit($this->input->post('admin_id'), $data);
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
                );
                $this->profile_model->edit($this->session->userdata('admin_id'), $data);
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
