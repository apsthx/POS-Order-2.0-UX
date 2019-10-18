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
class Stock extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 14;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('stock_model');
    }

    public function index() {
        $shop = $this->accesscontrol->getMyShop();
        $data = array(
            'setting' => $this->accesscontrol->get_document_setting(),
            'shop' => $shop,
            'datas' => $this->stock_model->get_stock(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/stock.js'),
        );
        $this->renderView('stock_view', $data);
    }

    public function manage($stock_id_pri = null) {
        if ($stock_id_pri == NULL) {
            redirect('stock');
        } else {
            $stock = $this->stock_model->get_stock($stock_id_pri);
            if ($stock->num_rows() == 0) {
                redirect('stock');
            }
        }
        $data = array(
            'stock_id_pri' => $stock_id_pri,
            'stock' => $stock->row(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => 'จัดการสินค้าในคลัง ' . ' (' . $stock->row()->stock_name . ')',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/stock.js'),
        );
        $this->renderView('stock_manage_view', $data);
    }

    public function check_stock_id() {
        $stock_id = $this->input->post('stock_id');
        if ($this->stock_model->check_stock_id($stock_id) > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function ajax() {
        $stock_id_pri = $this->input->post('stock_id_pri');
        $data = array(
            'datas' => $this->stock_model->get_product_stock($stock_id_pri),
        );
        $this->load->view('ajax/stock_product_page', $data);
    }

    public function edit_modal() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->stock_model->get_stock($id)->row(),
        );
        $this->load->view('modal/edit_stock_modal', $data);
    }

    public function add_product_modal() {
        $data = array(
            'data' => $this->stock_model->get_stock()->row(),
        );
        $this->load->view('modal/stock_add_product_modal', $data);
    }

    public function ajax_modal_add() {
        $product_category_id = $this->input->post('product_category_id');
        $data = array(
            'datas' => $this->stock_model->get_product($product_category_id)
        );
        $this->load->view('ajax/stock_add_product_modal', $data);
    }

    public function add_product() {
        $stock_id_pri = $this->input->post('stock_id_pri');
        $product_id_pri_arr = $this->input->post('product_id_pri_arr');
        $amount_add_arr = $this->input->post('amount_add_arr');
        for ($i = 0; $i < sizeof($product_id_pri_arr); $i++) {
            if ($product_id_pri_arr[$i] != "" && $amount_add_arr[$i] != "") {
                $count_product = $this->stock_model->count_product_in_stock($stock_id_pri, $product_id_pri_arr[$i]);
                if ($count_product > 0) {
                    $sum_amount = $this->stock_model->sum_product_in_stock($stock_id_pri, $product_id_pri_arr[$i]);
                    $data = array(
                        'stock_id_pri' => $stock_id_pri,
                        'product_id_pri' => $product_id_pri_arr[$i],
                        'map_product_amount' => $sum_amount + $amount_add_arr[$i],
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->stock_model->update_map($data);
                } else {
                    $data = array(
                        'stock_id_pri' => $stock_id_pri,
                        'product_id_pri' => $product_id_pri_arr[$i],
                        'map_product_amount' => $amount_add_arr[$i],
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->db->insert('map_product_stock', $data);
                }
            }
        }
    }

    public function change_amount_product() {
        $stock_id_pri = $this->input->post('stock_id_pri');
        $product_id_pri = $this->input->post('product_id_pri');
        $value_add = $this->input->post('value_add');
        $data = array(
            'stock_id_pri' => $stock_id_pri,
            'product_id_pri' => $product_id_pri,
            'map_product_amount' => $value_add,
            'date_modify' => $this->mics->getDate()
        );
        $this->stock_model->update_map($data);
    }

    public function add() {
        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->stock_number_default;
        $number_id = $document->stock_id_default.$run_number;
        $data_run_number = array('stock_number_default' => $document->stock_number_default + 1);
        $this->accesscontrol->update_document_setting($data_run_number);
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'stock_id' => $number_id,
            'stock_name' => $this->input->post('stock_name'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('stock', $data);      
        redirect(base_url() . 'stock');
    }

    public function edit() {
        $data = array(
            'stock_id_pri' => $this->input->post('stock_id_pri'),
            'stock_name' => $this->input->post('stock_name'),
            'date_modify' => $this->mics->getDate()
        );
        $this->stock_model->update_stock($data);
        redirect(base_url() . 'stock');
    }

    public function checkDelete() {
        $id = $this->input->post('id');
        $count = $this->stock_model->count_in_map($id);
        if ($count > 0) {
            echo '0';
        } else {
            echo '1';
        }
    }

    public function delete() {
        $id = $this->input->post('delete_id');
        $this->stock_model->delete_stock($id);
        redirect(base_url() . 'stock');
    }

    public function delete_product() {
        $map_product_stock_id = $this->input->post('map_product_stock_id');
        $this->stock_model->delete_product_in_stock($map_product_stock_id);
    }

}
