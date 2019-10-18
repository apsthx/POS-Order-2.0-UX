<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grouppartners
 *
 * @author Prasan Srisopa
 */
class Grouppartners extends CI_Controller{
    //put your code here
    public $group_id = 7;
    public $menu_id = 17;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('grouppartners_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/grouppartners.js'),
            'datas' => $this->grouppartners_model->get_grouppartners(),
        );
        $this->renderView('grouppartners_view', $data);
    }
    
    public function add() {
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'partners_group_name' => $this->input->post('partners_group_name'),   
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getdate()
        );
        $this->grouppartners_model->add($data);
        redirect(base_url('grouppartners'));
    }
    
    public function grouppartnersedit() {
        $id = $this->input->post('partners_group_id');
        $data = array(
            'data' => $this->grouppartners_model->get_grouppartners($id)->row(),
        );
        $this->load->view('modal/edit_grouppartners_modal', $data);
    }
    
    public function edit() {
        $data = array(
            'partners_group_name' => $this->input->post('partners_group_name'),           
            'date_modify' => $this->mics->getdate()
        );
        $this->grouppartners_model->edit($this->input->post('partners_group_id'),$data);
        redirect(base_url('grouppartners'));
    }
    
    public function delete($id) {
        $this->grouppartners_model->delete($id);
        redirect(base_url('grouppartners'));
    }
}