<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author nut
 */
class User extends CI_Controller {

    //put your code here
    public $menu_id = 3;
    public $perPage = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/user_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'title' => 'ผู้ใช้งาน',
            'css' => array(),
            'js' => array(),
        );
        $this->renderViewAdmin('user_view', $data);
    }

    public function loadTable() {
        $package = $this->input->post('package');
        $search = $this->input->post('search');
        $count = $this->user_model->countUser($package, $search);
        $config['div'] = 'for_table';
        $config['additional_param'] = "{'package': '" . $package . "','search': '" . $search . "'}";
        $config['base_url'] = base_url('admin/user/loadtable');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->perPage;
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data = array(
            'datas' => $this->user_model->getUser(array('start' => $segment, 'limit' => $this->perPage), $package, $search),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links(),
            'search' => $search
        );
        $this->load->view('admin/ajax/user_load', $data);
    }

    public function Usereditstatus() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
        );
        $this->load->view('admin/modal/user_editstatus', $data);
    }

    public function editstatus() {
        $this->user_model->edit($this->input->post('user_id'), array('status_id' => 2, 'date_modify' => $this->mics->getdate()));
        $shop_id_pri = $this->user_model->getUser1Row($this->input->post('user_id'))->row()->shop_id_pri;
        $this->user_model->editshop($shop_id_pri, array('status_shop_id' => 2, 'date_modify' => $this->mics->getdate()));
        redirect(base_url('admin/user'));
    }

    public function editchangestatus() {
        $this->user_model->edit($this->input->post('user_id'), array('status_id' => 1, 'date_modify' => $this->mics->getdate()));
        $shop_id_pri = $this->user_model->getUser1Row($this->input->post('user_id'))->row()->shop_id_pri;
        $this->user_model->editshop($shop_id_pri, array('status_shop_id' => 1, 'date_modify' => $this->mics->getdate()));
        echo 1;
    }

    public function Useredit() {
        $id = $this->input->post('user_id');
        $data = array(
            'data' => $this->user_model->getUser1Row($id)->row(),
        );
        $this->load->view('admin/modal/user_edit', $data);
    }

    public function edit() {
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'date_modify' => $this->mics->getDate(),
        );
        $this->user_model->edit($this->input->post('user_id'), $data);
        redirect(base_url('admin/user'));
    }

    public function Usereditpackage() {
        $id = $this->input->post('user_id');
        $data = array(
            'data' => $this->user_model->getUser1Row($id)->row(),
        );
        $this->load->view('admin/modal/user_editpackage', $data);
    }

    public function editpackage() {
        $userpackage = $this->user_model->getuserpackage($this->input->post('user_id'));
        $data = array(
            'package_id' => $this->input->post('package_id'),
            'user_package_modify' => $userpackage->user_package_modify
        );
        $this->user_model->editUserPackage($userpackage->package_shop_id_pri, $data);

        $package_name = $this->user_model->package($this->input->post('package_id'))->row()->package_name;       
        $action_text = 'อัพเดทแพ็กเกจ : ' . $package_name;
        $shop_id_pri = $this->user_model->getUser1Row($this->input->post('user_id'))->row()->shop_id_pri;
        $this->systemlog->log_package($action_text, $shop_id_pri);

        redirect(base_url('admin/user'));
    }

    public function Usereditpassword() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'username' => $this->input->post('username'),
        );
        $this->load->view('admin/modal/user_editpassword', $data);
    }

    public function editpassword() {
        $this->user_model->edit($this->input->post('user_id'), array('password' => md5($this->input->post('username') . '1234'), 'date_modify' => $this->mics->getdate()));
        redirect(base_url('admin/user'));
    }
    
    public function tokenupdate() {
        $datas = $this->user_model->shop();
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                if($data->token == null || $data->token == ''){
                    echo $data->shop_id_pri.' '.$data->user_id.' ';
                    $token = md5($data->shop_id_pri.'-'.$data->user_id);
                    echo $token.' ';
                    $this->user_model->editshop($data->shop_id_pri,array('token' => $token));
                }
                echo $data->shop_id.' '.$data->token.'<br/>';
            }
        }
    }
    
     public function shopView() {
        $id = $this->input->post('shop_id_pri');
        $data = array(
            'datas' => $this->user_model->getshopcreate($id),
        );
        $this->load->view('admin/modal/user_view', $data);
    }

}
