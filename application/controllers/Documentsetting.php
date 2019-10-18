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
class Documentsetting extends CI_Controller {

    public $group_id = 4;
    public $menu_id = 25;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('documentsetting_model');
    }

    public function index() {
        $data = array(
            'data' => $this->documentsetting_model->get_data()->row(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array(),
            'plugins_js' => array(),
            'js' => array('build/documentsetting.js'),
        );
        $this->renderView('documentsetting_view', $data);
    }

    public function edit() {
        $data_shop = array(
            'type_tax_id' => $this->input->post('type_tax_id'),
            'receipt_print_small' => $this->input->post('receipt_print_small'),
//            'sell_id_default' => $this->input->post('sell_id_default'),
//            'sell_number_default' => $this->input->post('sell_number_default'),
//            'buy_id_default' => $this->input->post('buy_id_default'),
//            'buy_number_default' => $this->input->post('buy_number_default'),
//            'sale_id_default' => $this->input->post('sale_id_default'),
//            'sale_number_default' => $this->input->post('sale_number_default'),
//            'order_id_default' => $this->input->post('order_id_default'),
//            'order_number_default' => $this->input->post('order_number_default'),
//            'invoice_id_default' => $this->input->post('invoice_id_default'),
//            'invoice_number_default' => $this->input->post('invoice_number_default'),
////            'tranfer_id_default' => $this->input->post('tranfer_id_default'),
////            'get_return_id_default' => $this->input->post('get_return_id_default'),
////            'return_id_default' => $this->input->post('return_id_default'),
//            'product_id_default' => $this->input->post('product_id_default'),
//            'stock_id_default' => $this->input->post('stock_id_default'),
//            'product_id_default' => $this->input->post('product_id_default'),
//            'customer_id_default' => $this->input->post('customer_id_default'),
//            'partners_id_default' => $this->input->post('partners_id_default'),
            'date_modify' => $this->mics->getDate()
        );
        $this->documentsetting_model->update_setting($data_shop);
        redirect('documentsetting');
    }

    public function upload_image() {
        $json = array();
        $this->load->library('image_lib');

        $path = "./assets/upload/img/"; //server path
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|png',
            'overwrite' => 1,
            'max_size' => 8192
        );

        $this->load->library('upload', $config);
        foreach ($_FILES as $key) {
            $name_type = explode('.', $key['name']);
            if (!(preg_match("/^[a-zA-Z0-9\_\-]+$/", $name_type[0]))) {
                $key['name'] = "abc." . $name_type[1];
            }
            $_FILES['image']['name'] = $key['name'];
            $_FILES['image']['type'] = $key['type'];
            $_FILES['image']['tmp_name'] = $key['tmp_name'];
            $_FILES['image']['size'] = $key['size'];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $data = array(
                    'image_name' => $this->upload->data('file_name'),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->insert('image', $data);
                $image_id = $this->db->insert_id();
                $data_shop = array(
                    'image_id' => $image_id,
                    'date_modify' => $this->mics->getDate()
                );
                $this->documentsetting_model->update_setting($data_shop);
                $json['image_id'] = $image_id;
                $json['file_name'] = $this->upload->data('file_name');
                $json['error'] = FALSE;
            } else {
                $json['image_id'] = '';
                $json['file_name'] = '';
                $json['error'] = TRUE;
            }
        }
        echo json_encode($json);
    }

    public function delete_image() {
        $data_shop = array(
            'image_id' => NULL,
            'date_modify' => $this->mics->getDate()
        );
        $this->documentsetting_model->update_setting($data_shop);
    }

}
