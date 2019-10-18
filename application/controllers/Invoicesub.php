<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Invoicesub
 *
 * @author Prasan Srisopa
 */
class Invoicesub extends CI_Controller {

    //put your code here
    public $group_id = 7;
    public $menu_id = 61;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('invoicesub_model');
        $this->load->model('receipt_model');
        $this->load->model('quotation_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css', 'jquery-ui.min.css'),
            'plugins_js' => array('parsley.min.js'),
            'js' => array('jquery-ui.js', 'build/invoicesub.js'),
        );
        $this->renderView('invoicesub_view', $data);
    }

    public function data() {
        $status_pay_id = $this->input->post('status_pay_id');
        $myshop = $this->accesscontrol->getMyShop();
        $data = array(
            'datas' => $this->invoicesub_model->get_receipt_master($status_pay_id, $myshop->shop_id),
        );
        $this->load->view('ajax/invoicesub_page', $data);
    }

    public function receipt_sand() {
        $receipt_master_id_pri_array = $this->input->post('receipt_master_id_pri_arr');
        $select_receipt_checkbox_array = $this->input->post('select_receipt_checkbox_send');

        $receipt_master_id_pri_arr = array();

        for ($i = 1; $i <= sizeof($receipt_master_id_pri_array); $i++) {
            if (isset($select_receipt_checkbox_array[$i])) {
                if ($select_receipt_checkbox_array[$i] == 'on') {
                    $receipt_master_id_pri_arr[$i] = $receipt_master_id_pri_array[$i];
                }
            }
        }
        foreach ($receipt_master_id_pri_arr as $receipt_master_id_pri) {

            $data_order = array(
                'status_transfer_id' => 2,
                'date_transfer' => $this->mics->getDate(),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                    ->update('receipt_master', $data_order);


            $product_id_arr = array();
            $product_name_arr = array();
            $product_amount_arr = array();
            $product_unit_arr = array();
            $product_price_arr = array();
            $product_save_arr = array();
            $product_price_sum_arr = array();

            $receipt_detail = $this->receipt_model->get_detail($receipt_master_id_pri);
            if ($receipt_detail->num_rows() > 0) {
                foreach ($receipt_detail->result() as $detail) {
                    $product_id_arr[] = $detail->product_id;
                    $product_name_arr[] = $detail->product_name;
                    $product_amount_arr[] = $detail->product_amount;
                    $product_unit_arr[] = $detail->product_unit;
                    $product_price_arr[] = $detail->product_price;
                    $product_save_arr[] = $detail->product_save;
                    $product_price_sum_arr[] = $detail->product_price_sum;
                }
            }

            $this->delete_in_stock($product_id_arr, $product_amount_arr);
        }

        redirect(base_url() . 'invoicesub');
    }

    public function receipt_process() {
        $print_order = $this->input->post('print_order');
        $receipt_master_id_pri_array = $this->input->post('receipt_master_id_pri_arr');
        $status_receipt_id_array = $this->input->post('status_receipt_id_arr');
        $status_receipt_order_id_array = $this->input->post('status_receipt_order_id_arr');
        $select_receipt_checkbox_array = $this->input->post('select_receipt_checkbox');

        $bank_id = $this->input->post('bank_id');
        $print = $this->input->post('print');

        $receipt_master_id_pri_arr = array();

        for ($i = 1; $i <= sizeof($receipt_master_id_pri_array); $i++) {
            if (isset($select_receipt_checkbox_array[$i])) {
                if ($select_receipt_checkbox_array[$i] == 'on' && $status_receipt_id_array[$i] == 1 && $status_receipt_order_id_array[$i] == 1) {
                    $receipt_master_id_pri_arr[$i] = $receipt_master_id_pri_array[$i];
                }
            }
        }

        if ($print_order != "") {
            if ($print_order == 'a4') {
                $url = base_url() . 'receipt/printbillA4';
            } else {
                $url = base_url() . 'receipt/printbillA5';
            }
            echo "<form id='print-submit' action='" . $url . "' method='post' >";
            foreach ($receipt_master_id_pri_arr as $receipt_master_id_pri) {
                echo "<input type='hidden' name='receipt_master_id_pri_arr[]' value='" . $receipt_master_id_pri . "' />";
            }
            echo "</form>";
            echo "<script>document.getElementById('print-submit').submit();window.history.back();</script>";
        } else {
            $id_pri_print_arr = array();
            foreach ($receipt_master_id_pri_arr as $receipt_master_id_pri) {
                $id_pri = $this->save($receipt_master_id_pri, $bank_id, $print);
                if ($id_pri != "") {
                    $id_pri_print_arr[] = $id_pri;
                }
            }

            $url = "";
            if ($print != 'none') {
                if ($print == 'a4') {
                    $url = base_url() . 'receipt/printbillA4';
                } elseif ($print == 'a5') {
                    $url = base_url() . 'receipt/printbillA5';
                }
            } else {
                redirect(base_url() . 'bill');
            }

            echo "<form id='print-submit' action='" . $url . "' method='post' >";
            foreach ($id_pri_print_arr as $id_pri) {
                echo "<input type='hidden' name='receipt_master_id_pri_arr[]' value='" . $id_pri . "' />";
            }
            echo "</form>";
            echo "<script>document.getElementById('print-submit').submit();window.history.back();</script>";
        }
    }

    private function save($receipt_master_id_pri, $bank_id, $print) {

        $receipt_master = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
        $transport = $this->receipt_model->get_transport_setting()->row();

        $product_id_arr = array();
        $product_name_arr = array();
        $product_amount_arr = array();
        $product_unit_arr = array();
        $product_price_arr = array();
        $product_save_arr = array();
        $product_price_sum_arr = array();

        $receipt_detail = $this->receipt_model->get_detail($receipt_master_id_pri);
        if ($receipt_detail->num_rows() > 0) {
            foreach ($receipt_detail->result() as $detail) {
                $product_id_arr[] = $detail->product_id;
                $product_name_arr[] = $detail->product_name;
                $product_amount_arr[] = $detail->product_amount;
                $product_unit_arr[] = $detail->product_unit;
                $product_price_arr[] = $detail->product_price;
                $product_save_arr[] = $detail->product_save;
                $product_price_sum_arr[] = $detail->product_price_sum;
            }
        }

        $document = $this->accesscontrol->get_document_setting();
        $check_receipt_master = $this->receipt_model->check_receipt_master_id($document->sale_id_default . '-' . $document->sale_number_default);
        if ($check_receipt_master > 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;เลขที่รายการซ้ำ ลองทำรายการใหม่อีกครั้ง</div>');
            redirect(base_url('receipt'));
        } else {
            if (sizeof($product_id_arr) > 0) {
                for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                    $sum_in_stock = $this->receipt_model->sum_in_stock($product_id_arr[$i])->row()->sum;
                    if ($sum_in_stock < $product_amount_arr[$i]) {
                        $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;สินค้า ' . $product_name_arr[$i] . ' มีไม่พอในคลังสินค้า</div>');
                        redirect(base_url('receipt'));
                    }
                }
            }
            $data = array(
                'receipt_master_id' => $document->sale_id_default . '-' . $document->sale_number_default,
                'shop_id_pri' => $this->session->userdata('shop_id_pri'),
                'user_id' => $this->session->userdata('user_id'),
                'type_receipt_id' => 3,
                'refer' => $receipt_master->receipt_master_id,
                'sale_from_id' => $receipt_master->sale_from_id,
                'type_tax_id' => $receipt_master->type_tax_id,
                'comment' => $receipt_master->comment,
                'customer_id' => $receipt_master->customer_id,
                'customer_name' => $receipt_master->customer_name,
                'customer_tel' => $receipt_master->customer_tel,
                'customer_email' => $receipt_master->customer_email,
                'customer_address' => $receipt_master->customer_address,
                'price_product_sum' => $receipt_master->price_product_sum,
                'save' => $receipt_master->save,
                'price_befor_tax' => $receipt_master->price_befor_tax,
                'price_tax' => $receipt_master->price_tax,
                'price' => $receipt_master->price,
                'transport_service_name' => $transport->transport_service_name,
                'transport_send_name' => $transport->send_name,
                'transport_send_tel' => $transport->transport_tel,
                'transport_send_address' => $transport->send_address,
                'transport_customer' => $receipt_master->customer_name,
                'transport_customer_tel' => $receipt_master->customer_tel,
                'transport_customer_address' => $receipt_master->customer_address,
                'price_sum_pay' => $receipt_master->price_sum_pay,
                'status_receipt_id' => 1,
                'status_pay_id' => 1,
                'status_receipt_order_id' => 2,
                'status_transfer_id' => 2,
                'status_pack_id' => 2,
                'status_sticker_transport_id' => 2,
                'bank_id' => $bank_id,
                'status_receipt_print_id' => ($print != 'none') ? 2 : 1,
                'date_receipt' => $this->mics->getDate(),
                'date_pay' => $this->mics->getDate(),
                'date_transfer' => $this->mics->getDate(),
                'date_modify' => $this->mics->getDate()
            );
            $data['customer_tax_id'] = $receipt_master->customer_tax_id;
            $data['customer_tax_shop'] = $receipt_master->customer_tax_shop;
            $data['customer_tax_shop_sub'] = $receipt_master->customer_tax_shop_sub;
            $data['customer_tax_address'] = $receipt_master->customer_tax_address;

            $data['withholding_tax'] = $receipt_master->withholding_tax;

            $data['transport_price'] = $receipt_master->transport_price;
            $this->db->insert('receipt_master', $data);
            $receipt_master_id_pri_add = $this->db->insert_id();

            if ($receipt_detail->num_rows() > 0) {
                foreach ($receipt_detail->result() as $detail) {
                    $detail_add = array(
                        'receipt_master_id_pri' => $receipt_master_id_pri_add,
                        'product_id' => $detail->product_id,
                        'product_name' => $detail->product_name,
                        'product_amount' => $detail->product_amount,
                        'product_unit' => $detail->product_unit,
                        'product_price' => $detail->product_price,
                        'product_save' => $detail->product_save,
                        'product_price_sum' => $detail->product_price_sum,
                    );
                    $this->db->insert('receipt_detail', $detail_add);
                }
            }

            $data_order = array(
                'status_receipt_order_id' => 2,
                'date_pay' => $this->mics->getDate(),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                    ->update('receipt_master', $data_order);


            $run_number = $document->sale_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $data_run_number = array('sale_number_default' => $text);
            $this->accesscontrol->update_document_setting($data_run_number);

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri_add, $user->fullname . ' ได้ออกใบเสร็จรับเงิน เลขที่รายการ ' . $document->sale_id_default . '-' . $document->sale_number_default);

            $bank = $this->receipt_model->get_bank($bank_id)->row();
            $bank_update = array(
                'bank_id' => $this->input->post('bank_id'),
                'bank_money' => $bank->bank_money + $receipt_master->price_sum_pay,
                'date_modify' => $this->mics->getDate()
            );
            $this->receipt_model->bank_update($bank_update);
            $this->systemlog->log_bank($user->fullname . ' ได้เพิ่มเงินใน ' . $bank->bank_name . 'จากใบเสร็จ เลขที่รายการ ' . $document->sale_id_default . '-' . $document->sale_number_default);

            return $receipt_master_id_pri_add;
        }

        return "";
    }

    private function delete_in_stock($product_id_arr, $product_amount_arr) {
        for ($i = 0; $i < sizeof($product_id_arr); $i++) {
            if ($product_id_arr[$i] != "") {

                $product_row = $this->receipt_model->get_product($product_id_arr[$i])->row();
                $stocks = $this->receipt_model->get_stock($product_id_arr[$i]);
                $amount_all = intval($product_amount_arr[$i]);

                $update_product = array(
                    'product_id_pri' => $product_row->product_id_pri,
                    'product_amount' => $product_row->product_amount - $amount_all,
                    'date_modify' => $this->mics->getDate()
                );
                $this->receipt_model->product_update($update_product);

                foreach ($stocks->result() as $stock) {
                    if ($stock->map_product_amount >= $amount_all) {
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => $stock->map_product_amount - $amount_all,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->receipt_model->map_stock_update($update);
                        break;
                    } else {
                        $amount_all = $amount_all - $stock->map_product_amount;
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => 0,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->receipt_model->map_stock_update($update);
                    }
                }
            }
        }
    }

}
