<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Prasan Srisopa
 */
class Receiptdetail extends CI_Controller {

    public $group_id = 8;
    public $menu_id = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('receiptdetail_model');
    }

    public function index($receipt_master_id_pri = null) {
        $receipt_masters = $this->receiptdetail_model->get_receipt_master_byId($receipt_master_id_pri);
        if ($receipt_masters->num_rows() > 0) {
            $receipt_master = $receipt_masters->row();
            if ($receipt_master->type_receipt_id == 4) {
                $this->group_id = 7;
                $this->menu_id = 9;
            }
            $receipt_detail = $this->receiptdetail_model->get_receipt_detail($receipt_master_id_pri);
            $data = array(
                'receipt_master' => $receipt_master,
                'receipt_detail' => $receipt_detail,
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => 'รายละเอียดรายการบิล',
                'css' => array(),
                'plugins_js' => array(),
                'js' => array('flash-message.js', 'build/receiptdetail.js'),
            );
            $this->renderView('receiptdetail_view', $data);
        } else {
            redirect(base_url('receipt'));
        }
    }

}
