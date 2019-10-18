<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Apidoc
 *
 * @author Prasan Srisopa
 */
class Apidoc extends CI_Controller{
    //put your code here
    public $menu_id = 0;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/apidoc_model');
    }

    public function index() {
        $datas = $this->apidoc_model->shop();
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $datashop) {
                if($datashop->token == null || $datashop->token == ''){
                    //echo $data->shop_id_pri.' '.$data->user_id.' ';
                    $token = md5($datashop->shop_id_pri.'-'.$datashop->user_id);
                    //echo $token.' ';
                    $this->apidoc_model->editshop($datashop->shop_id_pri,array('token' => $token));
                }
                //echo $data->shop_id.' '.$data->token.'<br/>';
            }
        }
        $data = array(
            'menu_id' => $this->menu_id,
            'title' => 'API',
            'css' => array(),
            'js' => array(),
        );
        $this->renderViewAdmin('apidoc_view', $data);
    }
    
    public function apieditstatus() {
        $data = array(
            'shop_id_pri' => $this->input->post('shop_id_pri'),
        );
        $this->load->view('admin/modal/apidoc_editstatus', $data);
    }

    public function editstatus() {
        $this->apidoc_model->editshop($this->input->post('shop_id_pri'), array('token_status' => 2, 'date_modify' => $this->mics->getdate()));
        redirect(base_url('admin/apidoc'));
    }

    public function editchangestatus() {
        $this->apidoc_model->editshop($this->input->post('shop_id_pri'), array('token_status' => 1, 'date_modify' => $this->mics->getdate()));
        echo 1;
    }
    
     public function viewgroup() {
        $id = $this->input->post('shop_id_pri');
        $data = array(
            'datas' => $this->apidoc_model->customergroup($id),
        );
        $this->load->view('admin/modal/apidoc_viewgroup', $data);
    }

}
