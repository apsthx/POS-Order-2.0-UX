<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Headsms
 *
 * @author Prasan Srisopa
 */
class Headsms extends CI_Controller{
    //put your code here
    public $group_id = 4;
    public $menu_id = 84;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('headsms_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/headsms.js'),
            'datas' => $this->headsms_model->get_headsms(),
        );
        $this->renderView('headsms_view', $data);
    }

    public function addheadsms() {
        $data = array(
            'head_sms_name' => $this->input->post('head_sms_name'),
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
        );
        $this->headsms_model->addheadsms($data);
        redirect(base_url('headsms'));
    }
    
    public function headsmsedit() {
        $id = $this->input->post('head_sms_id');
        $data = array(
            'data' => $this->headsms_model->get_headsms($id)->row(),
        );
        $this->load->view('modal/edit_headsms_modal', $data);
    }
    
    public function editheadsms() {
        $data = array(
            'head_sms_name' => $this->input->post('head_sms_name_edit'),
        );
        $this->headsms_model->editheadsms($this->input->post('head_sms_id_edit'),$data);
        redirect(base_url('headsms'));
    }
    
    public function deleteheadsms($id) {
        $this->headsms_model->deleteheadsms($id);
        redirect(base_url('headsms'));
    }
    
}
