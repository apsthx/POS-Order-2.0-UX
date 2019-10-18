<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report
 *
 * @author Prasan Srisopa
 */
class Report extends CI_Controller {

    //put your code here
    public $menu_id = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/report_model');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-list-ul',
            'title' => 'รายงาน ประวัติการใช้งาน',
            'css' => array(),
            'js' => array(),
        );
        $this->renderViewAdmin('report_view', $data);
    }

}
