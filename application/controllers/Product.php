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
class Product extends CI_Controller {

    public $group_id = 6;
    public $menu_id = 10;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('product_model');
    }

    public function index() {
        $data = array(
            'product_category_id' => $this->input->get('category'),
            'shop' => $this->accesscontrol->getMyShop(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/product.js'),
        );
        $this->renderView('product_view', $data);
    }

    public function ajax() {
        $filter = array(
            'product_category_id' => $this->input->post('product_category_id'),
            'status_product_id' => $this->input->post('status_product_id')
        );
        $data = array(
            'shop' => $this->accesscontrol->getMyShop(),
            'datas' => $this->product_model->get_product(NULL, $filter),
        );
        $this->load->view('ajax/product_page', $data);
    }

    public function addProduct() {
        $data = array(
            'setting' => $this->accesscontrol->get_document_setting(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id) . ' (เพิ่ม)',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array(),
        );
        $this->renderView('product_add_view', $data);
    }

    public function change($id = null) {
        if ($id == NULL) {
            redirect('product');
        } else {
            $product = $this->product_model->get_product_by_id($id);
            if ($product->num_rows() == 0) {
                redirect('product');
            } else {
                $properties = $this->product_model->get_properties_by_id_product($id);
            }
        }
        $data = array(
            'data' => $product->row(),
            'properties' => $properties,
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id) . ' (แก้ไข)',
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array(),
        );
        $this->renderView('product_edit_view', $data);
    }

    public function check_product_id() {
        $product_id = $this->input->post('product_id');
        if ($this->product_model->check_product_id($product_id) > 0) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function add() {
        //$product_id = $this->input->post('product_id');
        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->product_number_default;
        $number_id = $document->product_id_default . $run_number;
        $data_run_number = array('product_number_default' => $document->product_number_default + 1);
        $this->accesscontrol->update_document_setting($data_run_number);

        $product_properties_name = $this->input->post('product_properties_name');
        $product_properties_value = $this->input->post('product_properties_value');

        $this->input->post('product_category_id');
        $data = array(
            'product_category_id' => $this->input->post('product_category_id'),
            'product_id' => $number_id,
            'product_name' => $this->input->post('product_name'),
            'product_brand' => $this->input->post('product_brand'),
            'product_gen' => $this->input->post('product_gen'),
            'product_buy_price' => $this->input->post('product_buy_price'),
            'product_sale_price' => $this->input->post('product_sale_price'),
            'product_amount' => $this->input->post('product_amount'),
            'product_unit' => $this->input->post('product_unit'),
            'product_weight' => $this->input->post('product_weight'),
            'product_barcode' => $this->input->post('product_barcode'),
            'status_product_id' => 1,
            'date_modify' => $this->mics->getDate()
        );
        $data['image_id'] = $this->upload_pic($number_id);
        $this->db->insert('product', $data);
        $product_id_pri = $this->db->insert_id();

        $i = 0;
        for ($i = 0; $i < sizeof($product_properties_name); $i++) {
            if ($product_properties_name[$i] != "" && $product_properties_value[$i] != "") {
                $data_prop = array(
                    'product_id_pri' => $product_id_pri,
                    'product_properties_name' => $product_properties_name[$i],
                    'product_properties_value' => $product_properties_value[$i],
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->insert('product_properties', $data_prop);
            }
        }

        redirect(base_url() . 'product');
    }

    public function edit() {
        $product_id_pri = $this->input->post('product_id_pri');
        $product_id = $this->input->post('product_id');

        $product_properties_id = $this->input->post('product_properties_id');
        $product_properties_name = $this->input->post('product_properties_name');
        $product_properties_value = $this->input->post('product_properties_value');

        $data = array(
            'product_category_id' => $this->input->post('product_category_id'),
            'product_name' => $this->input->post('product_name'),
            'product_brand' => $this->input->post('product_brand'),
            'product_gen' => $this->input->post('product_gen'),
            'product_buy_price' => $this->input->post('product_buy_price'),
            'product_sale_price' => $this->input->post('product_sale_price'),
//            'product_amount' => $this->input->post('product_amount'),
            'product_unit' => $this->input->post('product_unit'),
            'product_weight' => $this->input->post('product_weight'),
            'product_barcode' => $this->input->post('product_barcode'),
            'status_product_id' => $this->input->post('status_product_id'),
            'date_modify' => $this->mics->getDate()
        );
        $up_image = $this->upload_pic($product_id);
        if ($up_image != 2) {
            $data['image_id'] = $up_image;
        }
        $this->product_model->update_product($product_id, $data);

        $i = 0;
        for ($i = 0; $i < sizeof($product_properties_name); $i++) {
            if ($product_properties_name[$i] != "" && $product_properties_value[$i] != "") {
                if ($product_properties_id[$i] != "") {
                    $data_prop = array(
                        'product_properties_name' => $product_properties_name[$i],
                        'product_properties_value' => $product_properties_value[$i],
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->db->where('product_properties_id', $product_properties_id[$i])->update('product_properties', $data_prop);
                } else {
                    $data_prop = array(
                        'product_id_pri' => $product_id_pri,
                        'product_properties_name' => $product_properties_name[$i],
                        'product_properties_value' => $product_properties_value[$i],
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->db->insert('product_properties', $data_prop);
                }
            }
        }

        redirect(base_url() . 'product');
    }

    private function upload_pic($product_id) {
        $path = "./assets/upload/img/"; //server path
        $file_name_up = 'product-' . $product_id;
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name_up;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 8192;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = array(
                'image_name' => $this->upload->data('file_name'),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('image', $data);
            return $this->db->insert_id();
        } else {
            return 2;
        }
    }

    public function pull() {
        $shop_create_id = $this->accesscontrol->getMyShop()->shop_create_id;
        $category = $this->product_model->get_category_pull($shop_create_id);
        $product_list = $this->product_model->get_product_pull($shop_create_id);
        $product_props_list = $this->product_model->get_product_props_pull($shop_create_id);
        if ($category->num_rows() > 0) {
            foreach ($category->result() as $row) {
                $product_category_id = $this->product_model->pull_category($row);
                if ($product_list->num_rows() > 0) {
                    foreach ($product_list->result() as $product) {
                        if ($product->product_category_id == $row->product_category_id) {
                            $product_id_pri = $this->product_model->pull_product($product, $product_category_id);
                            $this->product_model->delete_props($product_id_pri);
                            if ($product_props_list->num_rows() > 0) {
                                foreach ($product_props_list->result() as $props) {
                                    if ($product->product_id_pri == $props->product_id_pri) {
                                        $this->product_model->pull_product_props($props, $product_id_pri);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        redirect(base_url() . 'product');
    }

    public function checkDelete() {
        $id = $this->input->post('id');
        $count = $this->product_model->count_in_map($id);
        if ($count > 0) {
            echo '0';
        } else {
            echo '1';
        }
    }

    public function delete() {
        $id = $this->input->post('delete_id');
        $this->product_model->delete_product($id);
        redirect(base_url() . 'product');
    }

    public function modal_props() {
        $id = $this->input->post('id');
        $data = array(
            'id' => $id,
            'datas' => $this->product_model->get_properties_by_id_product($id)
        );
        $this->load->view('modal/product_properties_modal', $data);
    }

    public function buy_price_edit() {
        $product_id = $this->input->post('product_id');
        $data = array(
            'product_buy_price' => $this->input->post('buy_price_edit'),
            'date_modify' => $this->mics->getDate()
        );
        $this->product_model->update_product($product_id, $data);
    }

    public function sale_price_edit() {
        $product_id = $this->input->post('product_id');
        $data = array(
            'product_sale_price' => $this->input->post('sale_price_edit'),
            'date_modify' => $this->mics->getDate()
        );
        $this->product_model->update_product($product_id, $data);
    }

    public function product_amount_edit() {
        $product_id = $this->input->post('product_id');
        $data = array(
            'product_amount' => $this->input->post('product_amount_edit'),
            'date_modify' => $this->mics->getDate()
        );
        $this->product_model->update_product($product_id, $data);
    }

    public function import() {
        $lines = explode("\r\n", file_get_contents($_FILES["file"]["tmp_name"]));
        $data = array();
        $error = array();
        $i = 0;
        foreach ($lines as $line) {
            $explode = explode(",", $line);
            if ($i != 0) {
                if (sizeof($explode) > 1) {
                    $data[] = array(
                        'product_name' => $explode[0],
                        'product_brand' => $explode[1],
                        'product_gen' => $explode[2],
                        'product_buy_price' => $explode[3],
                        'product_sale_price' => $explode[4],
                        'product_weight' => $explode[5],
                        'product_unit' => $explode[6]
                    );
                }
            }
            $i++;
        }
        foreach ($data as $row) {
            if ($row['product_name'] == '') {
                $error[] = array('massage' => 'มีบางรายการข้อมูลชื่อสินค้าไม่มี');
            } else {
//                if (!$this->check_product_id_import($row['product_id'])) {
//                    $error[] = array('massage' => 'รหัสสินค้า ' . $row['product_id'] . ' นี้ซ้ำ');
//                }
            }
        }
        if (sizeof($error) > 0) {
            $this->error($error);
        } else {
            foreach ($data as $row) {
                $document = $this->accesscontrol->get_document_setting();
                $run_number = $document->product_number_default;
                $number_id = $document->product_id_default . $run_number;
                $data_run_number = array('product_number_default' => $document->product_number_default + 1);
                $this->accesscontrol->update_document_setting($data_run_number);
                $add = array(
                    'product_category_id' => $this->input->post('product_category_id'),
                    'product_id' => $number_id,
                    'product_name' => $row['product_name'],
                    'product_brand' => $row['product_brand'],
                    'product_gen' => $row['product_gen'],
                    'product_buy_price' => $row['product_buy_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_amount' => 0,
                    'product_unit' => $row['product_unit'],
                    'product_weight' => $row['product_weight'],
                    'image_id' => 2,
                    'status_product_id' => 1,
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->insert('product', $add);
            }
            redirect(base_url('product'));
        }
    }

    private function check_product_id_import($product_id) {
        if ($this->product_model->check_product_id($product_id) > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function error($error) {
        $data = array(
            'error' => $error,
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id)
        );
        $this->renderView('product_error_view', $data);
    }

}
