<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Partners
 *
 * @author Prasan Srisopa
 */
class Partners extends CI_Controller{
    //put your code here
    public $group_id = 7;
    public $menu_id = 16;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('partners_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/partners.js'),
        );
        $this->renderView('partners_view', $data);
    }
    
    public function data(){
        $partners_group_id = $this->input->post('partners_group_id');
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->partners_model->get_partners($partners_group_id,$status_id),
        );
        $this->load->view('ajax/partners_page', $data);
    }
    
    
    public function add() {  
        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->partners_number_default;
        $number_id = $document->partners_id_default . $run_number;
        $data_run_number = array('partners_number_default' => $document->partners_number_default + 1);
        $this->accesscontrol->update_document_setting($data_run_number);
        $data = array(
            'partners_id' => $number_id,
            'partners_group_id' => $this->input->post('partners_group_id'),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'facebook' => $this->input->post('facebook'),
            'line' => $this->input->post('line'),
            'instagram' => $this->input->post('instagram'),
            'address' => $this->input->post('address'),
            'tax_id' => $this->input->post('tax_id'),
            'tax_shop' => $this->input->post('tax_shop'),
            'tax_shop_sub' => $this->input->post('tax_shop_sub'),
            'tax_address' => $this->input->post('tax_address'),
            'status_id' => 1,
            'date_create' => $this->mics->getdate(),
            'date_modify' => $this->mics->getdate()
        );
        $this->partners_model->add($data);
        redirect(base_url('partners'));
    }
    
    public function partnersedit() {
        $id = $this->input->post('partners_id_pri');
        $data = array(
            'data' => $this->partners_model->get_partners(0,0,$id)->row(),
        );
        $this->load->view('modal/edit_partners_modal', $data);
    }
    
    public function edit() {
         $data = array(
            'partners_group_id' => $this->input->post('partners_group_id'),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'facebook' => $this->input->post('facebook'),
            'line' => $this->input->post('line'),
            'instagram' => $this->input->post('instagram'),
            'address' => $this->input->post('address'),
            'tax_id' => $this->input->post('tax_id'),
            'tax_shop' => $this->input->post('tax_shop'),
            'tax_shop_sub' => $this->input->post('tax_shop_sub'),
            'tax_address' => $this->input->post('tax_address'),
            'date_modify' => $this->mics->getdate()
        );
        $this->partners_model->edit($this->input->post('partners_id_pri'),$data);
        redirect(base_url('partners'));
    }
    
     public function modaleditstatus() {
        $data = array(
            'partners_id_pri' => $this->input->post('partners_id_pri'),
        );
        $this->load->view('modal/editstatus_partners_modal', $data);
    }

    
    public function editstatus() {
        $partners_group_id = $this->input->post('partners_group_id');
        $status_id = $this->input->post('status_id');
        $this->partners_model->edit($this->input->post('partners_id_pri'),array('status_id' => 2)); 
        $data = array(
            'datas' => $this->partners_model->get_partners($partners_group_id,$status_id),
        );
        $this->load->view('ajax/partners_page', $data);
    }
    
    public function check_id() {
        $check = $this->partners_model->check_id($this->input->post('partners_id'));
        if($check->num_rows() > 0){
            echo 1;
        }else{
            echo 0;
        }
    }
}
