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
class Category extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 13;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('category_model');
    }

    public function index() {
        $data = array(
            'shop' => $this->accesscontrol->getMyShop(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/category.js'),
        );
        $this->renderView('category_view', $data);
    }

    public function ajax() {
        $data = array(
            'shop' => $this->accesscontrol->getMyShop(),
            'datas' => $this->category_model->get_category(),
        );
        $this->load->view('ajax/category_page', $data);
    }

    public function edit_modal() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->category_model->get_category($id)->row(),
        );
        $this->load->view('modal/edit_category_modal', $data);
    }

    public function add() {
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'product_category_name' => $this->input->post('product_category_name'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('product_category', $data);
        redirect(base_url() . 'category');
    }

    public function edit() {
        $data = array(
            'product_category_id' => $this->input->post('product_category_id'),
            'product_category_name' => $this->input->post('product_category_name'),
            'date_modify' => $this->mics->getDate()
        );
        $this->category_model->update_category($data);
        redirect(base_url() . 'category');
    }

    public function checkDelete() {
        $id = $this->input->post('id');
        $count = $this->category_model->count_in_category($id);
        if ($count > 0) {
            echo '0';
        } else {
            echo '1';
        }
    }

    public function delete() {
        $id = $this->input->post('delete_id');
        $this->category_model->delete_category($id);
        redirect(base_url() . 'category');
    }

}
