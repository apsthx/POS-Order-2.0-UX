<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bank
 *
 * @Prasan Srisopa
 */
class Bank extends CI_Controller{
    //put your code here 10 20
    public $menu_id = 8;
    
    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin($this->menu_id);
        $this->load->model('admin/bank_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-address-card',
            'title' => 'บัญชีธนาคาร',
            'datas' => $this->bank_model->getBank(),
        );
        $this->renderViewAdmin('bank_view', $data);
    }

    public function Bankadd() {
        $this->load->view('admin/modal/bank_add');
    }
    
     public function add() {
        $data = array(
            'income_bank_name' => $this->input->post('income_bank_name'),
            'income_bank_branch' => $this->input->post('income_bank_branch'),
            'income_bank_account_name' => $this->input->post('income_bank_account_name'),
            'income_bank_accoun_number' => $this->input->post('income_bank_accoun_number'),
            'income_bank_active' => 1,
        );
        $this->bank_model->add($data);
        redirect(base_url('admin/bank'));
    }

    public function Bankedit() {
        $id = $this->input->post('income_bank_id');
        $data = array(
            'data' => $this->bank_model->getBank($id)->row(),
        );
        $this->load->view('admin/modal/bank_edit', $data);
    }

    public function edit() {
        $data = array(
            'income_bank_name' => $this->input->post('income_bank_name'),
            'income_bank_branch' => $this->input->post('income_bank_branch'),
            'income_bank_account_name' => $this->input->post('income_bank_account_name'),
            'income_bank_accoun_number' => $this->input->post('income_bank_accoun_number'),
        );
        $this->bank_model->edit($this->input->post('income_bank_id'), $data);
        $this->session->set_flashdata('flash_message', 'show');
        redirect(base_url('admin/bank'));
    }

    public function Bankeditstatus() {
        $data = array(
            'income_bank_id' => $this->input->post('income_bank_id'),
        );
        $this->load->view('admin/modal/bank_editstatus', $data);
    }
    
    public function editstatus() {
        $this->bank_model->edit($this->input->post('income_bank_id'), array('income_bank_active' => 2));
        redirect(base_url('admin/bank'));
    }

    public function editchangestatus() {
        $this->bank_model->edit($this->input->post('income_bank_id'), array('income_bank_active' => 1));
        echo 1;
    }
}
