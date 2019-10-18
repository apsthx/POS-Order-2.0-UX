<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parterssub
 *
 * @author Prasan Srisopa
 */
class Partnerssub extends CI_Controller {

    public $group_id = 7;
    public $menu_id = 52;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('partnerssub_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->partnerssub_model->get_partners(),
        );
        $this->renderView('partnerssub_view', $data);
    }

}
