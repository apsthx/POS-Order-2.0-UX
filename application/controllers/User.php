<?php

class User extends CI_Controller {
    //put your code here
    public $group_id = 4;
    public $menu_id = 33;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('user_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/user.js'),
        );
        $this->renderView('user_view', $data);
    }
    
    public function data(){
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->user_model->get_user($status_id),
        );
        $this->load->view('ajax/user_page', $data);
    }
       
    public function check_username() {
        $check = $this->user_model->check_username($this->input->post('username'));
        if($check->num_rows() > 0){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function add() {     
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'image_id' => 1,
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('username').$this->input->post('password')),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'fullname' => $this->input->post('fullname'),
            'tel' => $this->input->post('tel'),
            'role_id' => $this->input->post('role_id'),
            'comment' => $this->input->post('comment'),
            'type_user_id' => 2,
            'status_id' => 1,
            'style' => 'blue',
            'date_create' => $this->mics->getdate(),
            'date_modify' => $this->mics->getdate()
        ); 
        $user_id = $this->user_model->add($data);
        
        $userpackage = $this->user_model->getuserpackage($this->session->userdata('user_id'))->row();
        $packagedata = array(
            'user_id' => $user_id,
            'package_id' => $userpackage->package_id,
            'package_shop_id_pri' => $userpackage->package_shop_id_pri,
            'user_package_modify' => $userpackage->user_package_modify
        );
        $this->db->insert('user_package', $packagedata);
        
        redirect(base_url('user'));
    }
   
    public function useredit() {
        $id = $this->input->post('user_id');
        $data = array(
            'data' => $this->user_model->get_user(0,$id)->row(),
        );
        $this->load->view('modal/edit_user_modal', $data);
    }
   
    public function edit() {
         $data = array(
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'fullname' => $this->input->post('fullname'),
            'tel' => $this->input->post('tel'),
            'role_id' => $this->input->post('role_id'),
            'comment' => $this->input->post('comment'),
            'date_modify' => $this->mics->getdate()
        );
        $this->user_model->edit($this->input->post('user_id'),$data);
        redirect(base_url('user'));
    }
  
    public function modaleditstatus() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
        );
        $this->load->view('modal/editstatus_user_modal', $data);
    }

    
    public function editstatus() {
        $status_id = $this->input->post('status_id');
        $this->user_model->edit($this->input->post('user_id'),array('status_id' => 2));               
        $data = array(
            'datas' => $this->user_model->get_user($status_id),
        );
        $this->load->view('ajax/user_page', $data);
    } 
    
    public function modaleditpassword() {
        $data = array(
            'user_id' => $this->input->post('user_id'),
            'username' => $this->input->post('username'),
        );
        $this->load->view('modal/editpassword_user_modal', $data);
    }

    
    public function editpassword() {
        $status_id = $this->input->post('status_id');
        $this->user_model->edit($this->input->post('user_id'),array('password' => md5($this->input->post('username').'1234')));               
        $data = array(
            'datas' => $this->user_model->get_user($status_id),
        );
        $this->load->view('ajax/user_page', $data);
    } 
}
