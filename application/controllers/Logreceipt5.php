<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logreceipt5
 *
 * @Prasan Srisopa
 */
class Logreceipt5 extends CI_Controller{
    //put your code here
    public $group_id = 11;
    public $menu_id = 73;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('logreceipt5_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->logreceipt5_model->logreceipt(),
        );
        $this->renderView('logreceipt5_view', $data);
    }
}
