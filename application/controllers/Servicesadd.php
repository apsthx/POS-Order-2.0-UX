<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicesadd
 *
 * @author Prasan Srisopa
 */
class Servicesadd extends CI_Controller {

    //put your code here 14 92
    public $group_id = 14;
    public $menu_id = 92;
    public $perPage = 40;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('servicesadd_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
        );
        $this->renderView('servicesadd_view', $data);
    }

    public function loadTable() {
        $search = $this->input->post('search');
        $count = $this->servicesadd_model->countServices($search);
        $config['div'] = 'for_table';
        $config['additional_param'] = "{'search': '" . $search . "'}";
        $config['base_url'] = base_url('servicesadd/loadtable');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->perPage;
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->servicesadd_model->getServices(array('start' => $segment, 'limit' => $this->perPage), $search),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links(),
            'search' => $search
        );
        $this->load->view('ajax/servicesadd_load', $data);
    }

    public function modalAdd() {
        $this->load->view('modal/servicesadd_add');
    }

    public function add() {
        $data = array(
            'services_name' => $this->input->post('services_name'),
            'services_cost' => $this->input->post('services_cost'),
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
        );
        $this->servicesadd_model->insert($data);
        redirect(base_url('servicesadd'));
    }
    
     public function modalEdit() {
        $id = $this->input->post('services_id');
        $data = array(
            'data' => $this->servicesadd_model->getServices1Row($id)->row(),
        );
        $this->load->view('modal/servicesadd_edit', $data);
    }
    
    public function edit() {
        $data = array(
            'services_name' => $this->input->post('services_name'),
            'services_cost' => $this->input->post('services_cost'),
        );
        $this->servicesadd_model->edit($this->input->post('services_id'),$data);
        redirect(base_url('servicesadd'));
    }
    
    public function modalDelete() {
        $this->load->view('modal/delete_modal', array('id' => $this->input->post('services_id'), 'link' => base_url() . 'servicesadd/delete'));
    }

    public function delete() {
        $this->servicesadd_model->delete($this->input->post('id'));
        redirect(base_url('servicesadd'));
    }

}
