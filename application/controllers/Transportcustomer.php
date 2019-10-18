<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transportcustomer
 *
 * @author Prasan Srisopa
 */
class Transportcustomer extends CI_Controller{
    //put your code here
    public $group_id = 12;
    public $menu_id = 62;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('transportcustomer_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/transportcustomer.js'),
        );
        $this->renderView('transportcustomer_view', $data);
    }
    
    public function data() {
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $customer_id = $this->transportcustomer_model->get_customer()->row()->customer_id;
        $data = array(
            'datas' => $this->transportcustomer_model->get_receipt_master($customer_id,$date_start,$date_end),
        );
        $this->load->view('ajax/transportcustomer_page', $data);
    }
}
