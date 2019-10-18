<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Prasan Srisopa
 */
class Home extends CI_Controller {

    public $menu_id = 1;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/home_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'title' => 'ภาพรวม',
            'css' => array(),
            'js' => array(),
            'datas' => $this->home_model->getUserReceiptEvidence(),
        );
        $this->renderViewAdmin('home_view', $data);
    }

}
