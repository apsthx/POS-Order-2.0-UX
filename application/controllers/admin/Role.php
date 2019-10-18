<?php

class Role extends CI_Controller {

    public $menu_id = 4;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/role_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-key',
            'title' => 'สิทธิ์การใช้งาน',
            'datas' => $this->role_model->get_role(),
        );
        $this->renderViewAdmin('role_view', $data);
    }
    
    public function set() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
        );
        $this->load->view('admin/modal/set_role_modal', $data);
    }
    
    public function add() {
        $data = array(
            'role_id' => $this->input->post('role_id'),
            'menu_id' => $this->input->post('menu_id'),
        );
        $this->role_model->addrole($data);
    }

    public function delete() {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');
        $this->role_model->deleterole($role_id,$menu_id);
    }


}
