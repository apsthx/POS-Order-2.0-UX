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
class Order extends CI_Controller {

    public $group_id = 7;
    public $menu_id = 9;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('order_model');
    }

    public function index() {
        $data = array(
            'setting' => $this->accesscontrol->get_document_setting(),
            'Myshop' => $this->accesscontrol->getMyShop(),
            'partners' => $this->order_model->get_partners(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('jquery-ui.min.css'),
            //'plugins_js' => array('jquery.datetimepicker.js'),
            'js' => array('flash-message.js', 'jquery-ui.js', 'build/order.js'),
        );
        $this->renderView('order_view', $data);
    }

    public function get_product_by_id() {
        $product_id = $this->input->post('product_id');
        $json = array();
        $json['error'] = "";
        $product_list = $this->order_model->get_product($product_id);
        if ($product_list->num_rows() > 0) {
            $json['product'] = $product_list->row();
        } else {
            $json['error'] = "ไม่มีสินค้านี้ในคลัง กรุณาตรวจสอบสินค้าในคลังหรือสถานะของสินค้า";
        }
        echo json_encode($json);
    }

    public function customer_modal() {
        $data = array(
            'datas' => $this->order_model->get_customer(),
        );
        $this->load->view('modal/receipt_select_partners_modal', $data);
    }

    public function product_modal() {
        $data = array(
            'type_receipt' => '4',
            'product_id_arr' => $this->input->post('product_id_arr'),
        );
        $this->load->view('modal/receipt_add_product_modal', $data);
    }

    public function ajax_customer_modal() {
        $partners_group_id = $this->input->post('partners_group_id');
        $data = array(
            'datas' => $this->order_model->get_customer($partners_group_id)
        );
        $this->load->view('ajax/receipt_select_partners_modal', $data);
    }

    public function get_product_autocomplete() {
        $product_id = $this->input->post('term');
        $result = $this->order_model->getText_Product_id($product_id);
        $json = array();
        foreach ($result->result() as $row) {
            $json[] = array(
                'id' => $row->product_id
            );
        }
        echo json_encode($json);
    }

    public function save() {
        $product_id_array = $this->input->post('product_id');
        $product_name_array = $this->input->post('product_name');
        $product_amount_array = $this->input->post('product_amount');
        $product_unit_array = $this->input->post('product_unit');
        $product_price_array = $this->input->post('product_price');
        $product_save_array = $this->input->post('product_save');
        $product_price_sum_array = $this->input->post('product_price_sum');

        $product_id_arr = array();
        $product_name_arr = array();
        $product_amount_arr = array();
        $product_unit_arr = array();
        $product_price_arr = array();
        $product_save_arr = array();
        $product_price_sum_arr = array();

        $arr_stack = array();
        if (sizeof($product_id_array) > 0) {
            $arr = array_count_values($product_id_array);
        }
        for ($i = 0; $i < sizeof($product_id_array); $i++) {
            if ($product_id_array[$i] != "") {
                if ($arr[$product_id_array[$i]] > 1) {
                    if (!in_array($product_id_array[$i], $arr_stack)) {
                        $amount = 0;
                        $price_sum = 0;
                        for ($z = 0; $z < sizeof($product_id_array); $z++) {
                            if ($product_id_array[$z] == $product_id_array[$i]) {
                                $amount += $product_amount_array[$z];
                                $price_sum += $product_price_sum_array[$z];
                            }
                        }
                        $product_id_arr[] = $product_id_array[$i];
                        $product_name_arr[] = $product_name_array[$i];
                        $product_amount_arr[] = $amount;
                        $product_unit_arr[] = $product_unit_array[$i];
                        $product_price_arr[] = $product_price_array[$i];
                        $product_save_arr[] = $product_save_array[$i];
                        $product_price_sum_arr[] = $price_sum;

                        $arr_stack[] = $product_id_array[$i];
                    }
                } else {
                    $product_id_arr[] = $product_id_array[$i];
                    $product_name_arr[] = $product_name_array[$i];
                    $product_amount_arr[] = $product_amount_array[$i];
                    $product_unit_arr[] = $product_unit_array[$i];
                    $product_price_arr[] = $product_price_array[$i];
                    $product_save_arr[] = $product_save_array[$i];
                    $product_price_sum_arr[] = $product_price_sum_array[$i];
                }
            }
        }

        $shop_id_create = $this->order_model->get_shop_create()->row()->shop_id;

        $receipt_master_id = $this->input->post('receipt_master_id');
        $check_receipt_master = $this->order_model->check_receipt_master_id($receipt_master_id);
        if ($check_receipt_master > 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เลขที่รายการซ้ำ ลองทำรายการใหม่อีกครั้ง</div>');
            redirect(base_url('order'));
        } else {
            $data = array(
                'receipt_master_id' => $receipt_master_id,
                'shop_id_pri' => $this->session->userdata('shop_id_pri'),
                'user_id' => $this->session->userdata('user_id'),
                'refer' => $shop_id_create,
                'type_receipt_id' => $this->input->post('type_receipt_id'),
                'sale_from_id' => 1,
                'type_tax_id' => $this->input->post('type_tax_id'),
                'comment' => $this->input->post('comment'),
                'customer_id' => $this->input->post('customer_id'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_tel' => $this->input->post('customer_tel'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_address' => $this->input->post('customer_address'),
                'price_product_sum' => $this->input->post('price_product_sum'),
                'save' => $this->input->post('save'),
                'price_befor_tax' => $this->input->post('price_befor_tax'),
                'price_tax' => $this->input->post('price_tax'),
                'price' => $this->input->post('price'),
                'price_sum_pay' => $this->input->post('price_sum_pay'),
                'status_receipt_id' => 1,
                'status_pay_id' => 2,
                'status_transfer_id' => 1,
                'status_receipt_order_id' => 1,
                'status_receipt_print_id' => 1,
                'date_receipt' => $this->input->post('date_receipt'),
                'date_modify' => $this->mics->getDate()
            );
            if ($this->input->post('tax_customer_checkbox') == 1) {
                $data['customer_tax_id'] = $this->input->post('customer_tax_id');
                $data['customer_tax_shop'] = $this->input->post('customer_tax_shop');
                $data['customer_tax_shop_sub'] = $this->input->post('customer_tax_shop_sub');
                $data['customer_tax_address'] = $this->input->post('customer_tax_address');
            }
            if ($this->input->post('withholding_tax_checkbox') == 1) {
                $data['withholding_tax'] = $this->input->post('withholding_tax') . '%';
            }
            $this->db->insert('receipt_master', $data);
            $receipt_master_id_pri = $this->db->insert_id();


            for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                if ($product_id_arr[$i] != "" && $product_name_arr[$i] != "") {
                    $detail = array(
                        'receipt_master_id_pri' => $receipt_master_id_pri,
                        'product_id' => $product_id_arr[$i],
                        'product_name' => $product_name_arr[$i],
                        'product_amount' => $product_amount_arr[$i],
                        'product_unit' => $product_unit_arr[$i],
                        'product_price' => $product_price_arr[$i],
                        'product_save' => $product_save_arr[$i],
                        'product_price_sum' => $product_price_sum_arr[$i],
                    );
                    $this->db->insert('receipt_detail', $detail);
                }
            }

            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->order_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $data_run_number = array('order_number_default' => $text);
            $this->accesscontrol->update_document_setting($data_run_number);

            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้สร้างใบสั่งซื้อ เลขที่รายการ ' . $receipt_master_id);
            redirect(base_url() . 'receiptdetail/' . $receipt_master_id_pri);
        }
    }

    public function save_main() {
        $product_id_array = $this->input->post('product_id');
        $product_name_array = $this->input->post('product_name');
        $product_amount_array = $this->input->post('product_amount');
        $product_unit_array = $this->input->post('product_unit');
        $product_price_array = $this->input->post('product_price');
        $product_save_array = $this->input->post('product_save');
        $product_price_sum_array = $this->input->post('product_price_sum');

        $product_id_arr = array();
        $product_name_arr = array();
        $product_amount_arr = array();
        $product_unit_arr = array();
        $product_price_arr = array();
        $product_save_arr = array();
        $product_price_sum_arr = array();

        $arr_stack = array();
        if (sizeof($product_id_array) > 0) {
            $arr = array_count_values($product_id_array);
        }
        for ($i = 0; $i < sizeof($product_id_array); $i++) {
            if ($product_id_array[$i] != "") {
                if ($arr[$product_id_array[$i]] > 1) {
                    if (!in_array($product_id_array[$i], $arr_stack)) {
                        $amount = 0;
                        $price_sum = 0;
                        for ($z = 0; $z < sizeof($product_id_array); $z++) {
                            if ($product_id_array[$z] == $product_id_array[$i]) {
                                $amount += $product_amount_array[$z];
                                $price_sum += $product_price_sum_array[$z];
                            }
                        }
                        $product_id_arr[] = $product_id_array[$i];
                        $product_name_arr[] = $product_name_array[$i];
                        $product_amount_arr[] = $amount;
                        $product_unit_arr[] = $product_unit_array[$i];
                        $product_price_arr[] = $product_price_array[$i];
                        $product_save_arr[] = $product_save_array[$i];
                        $product_price_sum_arr[] = $price_sum;

                        $arr_stack[] = $product_id_array[$i];
                    }
                } else {
                    $product_id_arr[] = $product_id_array[$i];
                    $product_name_arr[] = $product_name_array[$i];
                    $product_amount_arr[] = $product_amount_array[$i];
                    $product_unit_arr[] = $product_unit_array[$i];
                    $product_price_arr[] = $product_price_array[$i];
                    $product_save_arr[] = $product_save_array[$i];
                    $product_price_sum_arr[] = $product_price_sum_array[$i];
                }
            }
        }

        $receipt_master_id = $this->input->post('receipt_master_id');
        $check_receipt_master = $this->order_model->check_receipt_master_id($receipt_master_id);
        if ($check_receipt_master > 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เลขที่รายการซ้ำ ลองทำรายการใหม่อีกครั้ง</div>');
            redirect(base_url('order'));
        } else {
            $data = array(
                'receipt_master_id' => $receipt_master_id,
                'shop_id_pri' => $this->session->userdata('shop_id_pri'),
                'user_id' => $this->session->userdata('user_id'),
                'refer' => NULL,
                'type_receipt_id' => $this->input->post('type_receipt_id'),
                'sale_from_id' => 1,
                'type_tax_id' => $this->input->post('type_tax_id'),
                'comment' => $this->input->post('comment'),
                'customer_id' => $this->input->post('customer_id'),
                'customer_name' => $this->input->post('customer_name'),
                'customer_tel' => $this->input->post('customer_tel'),
                'customer_email' => $this->input->post('customer_email'),
                'customer_address' => $this->input->post('customer_address'),
                'price_product_sum' => $this->input->post('price_product_sum'),
                'save' => $this->input->post('save'),
                'price_befor_tax' => $this->input->post('price_befor_tax'),
                'price_tax' => $this->input->post('price_tax'),
                'price' => $this->input->post('price'),
                'price_sum_pay' => $this->input->post('price_sum_pay'),
                'status_receipt_id' => 1,
                'status_pay_id' => 2,
                'status_transfer_id' => 1,
                'status_receipt_order_id' => 1,
                'status_receipt_print_id' => 1,
                'date_receipt' => $this->input->post('date_receipt'),
                'date_modify' => $this->mics->getDate()
            );
            if ($this->input->post('tax_customer_checkbox') == 1) {
                $data['customer_tax_id'] = $this->input->post('customer_tax_id');
                $data['customer_tax_shop'] = $this->input->post('customer_tax_shop');
                $data['customer_tax_shop_sub'] = $this->input->post('customer_tax_shop_sub');
                $data['customer_tax_address'] = $this->input->post('customer_tax_address');
            }
            if ($this->input->post('withholding_tax_checkbox') == 1) {
                $data['withholding_tax'] = $this->input->post('withholding_tax') . '%';
            }
            $this->db->insert('receipt_master', $data);
            $receipt_master_id_pri = $this->db->insert_id();


            for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                if ($product_id_arr[$i] != "" && $product_name_arr[$i] != "") {
                    $detail = array(
                        'receipt_master_id_pri' => $receipt_master_id_pri,
                        'product_id' => $product_id_arr[$i],
                        'product_name' => $product_name_arr[$i],
                        'product_amount' => $product_amount_arr[$i],
                        'product_unit' => $product_unit_arr[$i],
                        'product_price' => $product_price_arr[$i],
                        'product_save' => $product_save_arr[$i],
                        'product_price_sum' => $product_price_sum_arr[$i],
                    );
                    $this->db->insert('receipt_detail', $detail);
                }
            }

            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->order_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $data_run_number = array('order_number_default' => $text);
            $this->accesscontrol->update_document_setting($data_run_number);

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้สร้างใบสั่งซื้อ เลขที่รายการ ' . $receipt_master_id);

            redirect(base_url() . 'receiptdetail/' . $receipt_master_id_pri);
        }
    }

}
