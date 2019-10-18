<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logreceipt1
 *
 * @Prasan Srisopa
 */
class Logreceipt1 extends CI_Controller{
    //put your code here
    public $group_id = 11;
    public $menu_id = 37;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('logreceipt1_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->logreceipt1_model->logreceipt(),
        );
        $this->renderView('logreceipt1_view', $data);
    }
}
