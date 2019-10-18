<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Smss
 *
 * @Prasan Srisopa
 */
class Smss extends CI_Controller {

    public $group_id = 4;
    public $menu_id = 28;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->library('thsms');
        $this->load->model('sms_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->sms_model->get_sms(NULL, $this->session->userdata('shop_id_pri')),
            'css' => array('jquery-ui.min.css'),
            'js' => array('jquery-ui.js','ckeditor/ckeditor.js','build/smsemail.js')
        );
        $this->renderView('sms_view', $data);
    }
    
    public function data() {
        $data = array(
            'datas' => $this->sms_model->get_sms_email(NULL, $this->session->userdata('shop_id_pri')),
        );
        $this->load->view('ajax/sms_email_page', $data);
    }
    
     public function smsemail() {
        $this->load->view('modal/sms_email_modal');
    }
    
     public function getText() {
        $term = $this->input->get('term');
        $result = $this->sms_model->getText($term);
        $json = array();
        foreach ($result->result() as $row) {
            $json[] = array(
                'value' => $row->fullname.' '.$row->tel. ' (' . $row->customer_id.') ',
                'id' => $row->customer_id_pri
            );
        }
        echo json_encode($json);
    }

}
