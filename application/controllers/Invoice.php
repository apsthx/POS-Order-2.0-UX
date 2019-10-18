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
class Invoice extends CI_Controller {

    public $group_id = 7;
    public $menu_id = 53;

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('invoice_model');
    }

    public function index() {
        $confirm_order_id = $this->input->post('confirm_order_id');
        $receipt_master_id_pri = $this->input->post('id_pri_invoid');
        if ($confirm_order_id == 3) {
            $update = array(
                'confirm_order_id' => 3,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
            $this->db->update('receipt_master', $update);
            redirect(base_url('ordersub'));
        }
        $credit = $this->input->post('credit');
        $shop_id = $this->accesscontrol->getMyShop()->shop_id;
        $receipts = $this->invoice_model->get_receipt_master($receipt_master_id_pri, $shop_id);
        if ($receipts->num_rows() == 0) {
            redirect(base_url('ordersub'));
        } else {
            $receipt = $receipts->row();
            $shop_sub = $this->invoice_model->get_shop($receipt->shop_id_pri)->row();
        }
        $data = array(
            'receipt' => $receipt,
            'credit' => $credit,
            'shop_sub' => $shop_sub,
            'setting' => $this->accesscontrol->get_document_setting(),
            'transport' => $this->accesscontrol->get_transport_setting(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('jquery-ui.min.css'),
            'js' => array('flash-message.js', 'jquery-ui.js', 'build/invoice.js'),
        );
        $this->renderView('invoice_view', $data);
    }

    public function save() {
        // check product in stock
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
        $check_receipt_master = $this->invoice_model->check_receipt_master_id($receipt_master_id);
        if ($check_receipt_master > 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เลขที่รายการซ้ำ ลองทำรายการใหม่อีกครั้ง</div>');
            redirect(base_url('ordersub'));
        } else {
            if (sizeof($product_id_arr) > 0) {
                for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                    $sum_in_stock = $this->invoice_model->sum_in_stock($product_id_arr[$i])->row()->sum;
                    if ($sum_in_stock < $product_amount_arr[$i]) {
                        $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;สินค้าบางรายการมีไม่พอในคลังสินค้า</div>');
                        redirect(base_url('ordersub'));
                    }
                }
            }
            $data = array(
                'receipt_master_id' => $receipt_master_id,
                'shop_id_pri' => $this->session->userdata('shop_id_pri'),
                'user_id' => $this->session->userdata('user_id'),
                'type_receipt_id' => $this->input->post('type_receipt_id'),
                'refer' => $this->input->post('refer'),
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
                'transport_price' => $this->input->post('transport_price'),
                'price_sum_pay' => $this->input->post('price_sum_pay'),
                'status_receipt_id' => 1,
                'status_pay_id' => 2,
                'status_transfer_id' => 1,
                'status_receipt_order_id' => 1,
                'status_receipt_print_id' => 1,
                'confirm_order_id' => 2,
                'credit' => $this->input->post('credit'),
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

            $update = array(
                'confirm_order_id' => 2,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $this->input->post('receipt_master_id_pri'));
            $this->db->update('receipt_master', $update);


            for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                if ($product_id_arr[$i] != "") {
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
            $run_number = $document->invoice_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $data_run_number = array('invoice_number_default' => $text);
            $this->accesscontrol->update_document_setting($data_run_number);

            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้สร้างใบแจ้งหนี้ เลขที่รายการ ' . $receipt_master_id);
            redirect(base_url() . 'receiptdetail/' . $receipt_master_id_pri);
        }
    }

}
