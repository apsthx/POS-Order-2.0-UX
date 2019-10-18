<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupcustomer
 *
 * @author Prasan Srisopa
 */
class Groupcustomer extends CI_Controller{
    //put your code here
    public $group_id = 2;
    public $menu_id = 7;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('groupcustomer_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/groupcustomer.js'),
            'datas' => $this->groupcustomer_model->get_groupcustomer(),
        );
        $this->renderView('groupcustomer_view', $data);
    }
    
    public function add() {
        $data = array(
            'customer_group_name' => $this->input->post('customer_group_name'),
            'customer_group_save' => $this->input->post('customer_group_save'),
            'type_save_id' => $this->input->post('type_save_id'),         
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getdate()
        );
        $this->groupcustomer_model->add($data);
        redirect(base_url('groupcustomer'));
    }
    
    public function groupcustomeredit() {
        $id = $this->input->post('customer_group_id');
        $data = array(
            'data' => $this->groupcustomer_model->get_groupcustomer($id)->row(),
        );
        $this->load->view('modal/edit_groupcustomer_modal', $data);
    }
    
    public function edit() {
        $data = array(
            'customer_group_name' => $this->input->post('customer_group_name'),
            'customer_group_save' => $this->input->post('customer_group_save'),
            'type_save_id' => $this->input->post('type_save_id'),         
            'date_modify' => $this->mics->getdate()
        );
        $this->groupcustomer_model->edit($this->input->post('customer_group_id'),$data);
        redirect(base_url('groupcustomer'));
    }
    
    public function delete($id) {
        $this->groupcustomer_model->delete($id);
        redirect(base_url('groupcustomer'));
    }
    
}
