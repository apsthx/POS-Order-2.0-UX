<?php

header('Access-Control-Allow-Origin: *');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author nut
 */
class Api extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    public function index() {
        redirect('https://www.pos.apsth.com/');
    }

    public function product() {
        $token = $this->input->post('token');
        $customer_group_id = $this->input->post('customer_group_id');
        $user_id = $this->input->post('user_id');
        $shop_id_pri = $this->checktoken($token,$customer_group_id,$user_id);
        $limit = $this->input->post('limit');
        if ($shop_id_pri != 0) {
            $token = 'success';
            $count = $this->api_model->countproduct($shop_id_pri);
            $getproducts = $this->api_model->getproduct($shop_id_pri, $limit);
            if ($getproducts->num_rows() > 0) {
                $jsonproductall = $getproducts->result_object();
            }
        } else {
            $token = 'error';
        }
        $json = array(
            'data' => $token,
            'product' => $jsonproductall,
            'count' => $count,
        );
        $this->returnJSON($json);
    }

    public function productfilter() {
        $token = $this->input->post('token');
        $customer_group_id = $this->input->post('customer_group_id');
        $user_id = $this->input->post('user_id');
        $shop_id_pri = $this->checktoken($token,$customer_group_id,$user_id);
        $search = $this->input->post('search');
        $category_id = $this->input->post('category_id');
        if ($shop_id_pri != 0) {
            $token = 'success';
            $count = $this->api_model->countproduct($shop_id_pri);
            $getproducts = $this->api_model->getproductfilter($shop_id_pri, $search, $category_id);
            if ($getproducts->num_rows() > 0) {
                $jsonproductall = $getproducts->result_object();
            }
        } else {
            $token = 'error';
        }
        $json = array(
            'data' => $token,
            'product' => $jsonproductall,
            'category_id' => $category_id,
            'count' => $count,
        );
        $this->returnJSON($json);
    }

    public function productcategory() {
        $token = $this->input->post('token');
        $customer_group_id = $this->input->post('customer_group_id');
        $user_id = $this->input->post('user_id');
        $shop_id_pri = $this->checktoken($token,$customer_group_id,$user_id);
        if ($shop_id_pri != 0) {
            $token = 'success';
            $categorys = $this->api_model->getproductcategory($shop_id_pri);
            if ($categorys->num_rows() > 0) {
                $jsoncategory = $categorys->result_object();
            }
        } else {
            $token = 'error';
        }
        $json = array(
            'data' => $token,
            'category' => $jsoncategory,
        );
        $this->returnJSON($json);
    }

    public function productproperties() {
        $token = $this->input->post('token');
        $product_id_pri = $this->input->post('product_id_pri');
        $customer_group_id = $this->input->post('customer_group_id');
        $user_id = $this->input->post('user_id');
        $shop_id_pri = $this->checktoken($token,$customer_group_id,$user_id);
        if ($shop_id_pri != 0) {
            $token = 'success';
            $getproductproperties = $this->api_model->getproductproperties($product_id_pri);
            if ($getproductproperties->num_rows() > 0) {
                $getproductpropertie = $getproductproperties->result_object();
            }
        } else {
            $token = 'error';
        }
        $json = array(
            'data' => $token,
            'productpropertie' => $getproductpropertie,
        );
        $this->returnJSON($json);
    }

    public function checktoken($token,$customer_group_id,$user_id) {
        $shop = $this->api_model->getshop($token);
        if ($shop->num_rows() > 0) {
            $shop_id_pri = $shop->row()->shop_id_pri;
            if($this->api_model->getcustomergroup($shop_id_pri , $customer_group_id)->num_rows() > 0){
                if($this->api_model->getuser($shop_id_pri , $user_id)->num_rows() > 0){
                    $token = $shop->row()->shop_id_pri;
                }else{
                    $token = 0;
                }
            }else{
                $token = 0;
            }
            //$token = $shop->row()->shop_id_pri;
        } else {
            $token = 0;
        }
        return $token;
    }

    public function save() {
        $token = $this->input->post('token');
        $customer_group_id = $this->input->post('customer_group_id');
        $user_id = $this->input->post('user_id');
        $shop_id_pri = $this->checktoken($token,$customer_group_id,$user_id);
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

        $document = $this->api_model->get_document_setting($shop_id_pri);
        $run_number = $document->customer_number_default;
        $number_id = $document->customer_id_default . $run_number;
        $data_run_number = array('customer_number_default' => $document->customer_number_default + 1);
        $this->api_model->update_document_setting($data_run_number, $shop_id_pri);

        $datacustomer = array(
            'customer_id' => $number_id,
            'user_id' => $this->input->post('user_id'),
            'customer_group_id' => $this->input->post('customer_group_id'),
            'username' => $number_id,
            'password' => md5($number_id . $number_id),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'address' => $this->input->post('address'),
            'district' => $this->input->post('district'),
            'amphoe' => $this->input->post('amphoe'),
            'province' => $this->input->post('province'),
            'zipcode' => $this->input->post('zipcode'),
            'status_id' => 1,
            'role_id' => 8,
            'date_create' => $this->mics->getdate(),
            'date_modify' => $this->mics->getdate()
        );
        $this->db->insert('customer', $datacustomer);

        $document = $this->api_model->get_document_setting($shop_id_pri);
        $run_number = $document->buy_number_default + 1;
        $text = '';
        for ($j = strlen($run_number); $j < 6; $j++) {
            $text .= '0';
        }
        $text .= $run_number;
        $receipt_master_id = $document->buy_id_default . '-' . $text;
        $data_run_number = array('buy_number_default' => $text);
        $this->api_model->update_document_setting($data_run_number, $shop_id_pri);

        $data = array(
            'receipt_master_id' => $receipt_master_id,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $this->input->post('user_id'),
            'type_receipt_id' => 2,
            'sale_from_id' => 1,
            'type_tax_id' => 1,
            'customer_id' => $number_id,
            'customer_name' => $this->input->post('fullname'),
            'customer_tel' => $this->input->post('tel'),
            'customer_email' => $this->input->post('email'),
            'customer_address' => $this->input->post('address'),
            'customer_district' => $this->input->post('district'),
            'customer_amphoe' => $this->input->post('amphoe'),
            'customer_province' => $this->input->post('province'),
            'customer_zipcode' => $this->input->post('zipcode'),
            'price_product_sum' => $this->input->post('price_sum_pay'),
            'save' => 0,
            'price_befor_tax' => $this->input->post('price_sum_pay'),
            'price_tax' => 0,
            'price' => $this->input->post('price_sum_pay') + $this->api_model->get_transport_setting($shop_id_pri),
            'transport_price' => $this->api_model->get_transport_setting($shop_id_pri),
            'price_sum_pay' => number_format($this->input->post('price_sum_pay') + $this->api_model->get_transport_setting($shop_id_pri),2,'.',''),
            'status_receipt_id' => 1,
            'status_pay_id' => 2,
            'status_transfer_id' => 1,
            'status_receipt_order_id' => 1,
            'status_receipt_print_id' => 1,
            'date_receipt' => $this->mics->getDate(),
            'date_modify' => $this->mics->getDate()
        );

        $this->db->insert('receipt_master', $data);
        $receipt_master_id_pri = $this->db->insert_id();

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

        $this->api_model->log_receipt($receipt_master_id_pri, '(ขายหน้าเว็ปออนไลฯ์) Username: ' . $number_id . ' ชื่อ: ' . $this->input->post('fullname') . ' ได้สร้างใบเปิด order เลขที่รายการ ' . $receipt_master_id, $shop_id_pri);

        echo 1;
    }

}
