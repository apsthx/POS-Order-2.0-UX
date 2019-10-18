<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportlogincheck
 *
 * @author Prasan Srisopa
 */
class Reportlogincheck extends CI_Controller{
    //put your code here
    public $menu_id = 10;
    public $perPage = 40;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginAdmin();
        $this->load->model('admin/reportlogincheck_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'menu_id' => $this->menu_id,
            'icon' => 'fa fa-user-secret',
            'title' => 'รายงานผู้ใช้งานระบบ',
            'css' => array(),
            'js' => array(),
        );
        $this->renderViewAdmin('reportlogincheck_view', $data);
    }

    public function loadTable() {
        $search = $this->input->post('search');
        $count = $this->reportlogincheck_model->countReport($search);
        $config['div'] = 'for_table';
        $config['additional_param'] = "{'search': '" . $search . "'}";
        $config['base_url'] = base_url('admin/reportlogincheck/loadtable');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->perPage;
        $config['num_links'] = 4;
        $config['uri_segment'] = 4;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data = array(
            'datas' => $this->reportlogincheck_model->getReport(array('start' => $segment, 'limit' => $this->perPage), $search),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links(),
            'search' => $search
        );
        $this->load->view('admin/ajax/reportlogincheck_load', $data);
    }
}
