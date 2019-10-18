<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Selleasy
 *
 * @Prasan Srisopa
 */
class Selleasy extends CI_Controller {

    //put your code here 8 89
    public $group_id = 8;
    public $menu_id = 89;
    public $perPage = 18;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('selleasy_model');
        $this->load->library('ajax_pagination');
    }

    public function index() {
        $data = array(
            'setting' => $this->accesscontrol->get_document_setting(),
            'transport_setting' => $this->accesscontrol->get_transport_setting(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('jquery-ui.min.css'),
            'js' => array('flash-message.js', 'jquery-ui.js'),
        );
        $this->renderView('selleasy_view', $data);
    }

    public function loadTable() {
        $product_category_id = $this->input->post('product_category_id');
        $search = $this->input->post('search');
        $count = $this->selleasy_model->countProduct($product_category_id, $search);
        $config['div'] = 'for_table';
        $config['additional_param'] = "{'product_category_id': '" . $product_category_id . "','search': '" . $search . "'}";
        $config['base_url'] = base_url('selleasy/loadtable');
        $config['total_rows'] = $count;
        $config['per_page'] = $this->perPage;
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;
        $this->ajax_pagination->initialize($config);
        $segment = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = array(
            'datas' => $this->selleasy_model->getProduct(array('start' => $segment, 'limit' => $this->perPage), $product_category_id, $search),
            'count' => $count,
            'segment' => $segment,
            'links' => $this->ajax_pagination->create_links(),
            'search' => $search
        );
        $this->load->view('ajax/selleasy_page', $data);
    }

    public function get_product_by_id() {
        $product_id = $this->input->post('product_id');
        $json = array();
        $json['error'] = "";
        $product_list = $this->selleasy_model->get_product($product_id);
        if ($product_list->num_rows() > 0) {
            $json['product'] = $product_list->row();
        } else {
            $json['error'] = "ไม่มีสินค้านี้ในคลัง กรุณาตรวจสอบสินค้าในคลังหรือสถานะของสินค้า";
        }
        echo json_encode($json);
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
            if ($product_id_array[$i] != "" && $product_name_array[$i] != "") {
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
        $check_receipt_master = $this->selleasy_model->check_receipt_master_id($receipt_master_id);
        if ($check_receipt_master > 0) {
            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->sell_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $receipt_master_id = $document->sell_id_default . '-' . $text;
        }
        if (sizeof($product_id_arr) > 0) {
            for ($i = 0; $i < sizeof($product_id_arr); $i++) {
                $sum_in_stock = $this->selleasy_model->sum_in_stock($product_id_arr[$i])->row()->sum;
                if ($sum_in_stock < $product_amount_arr[$i]) {
                    $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;สินค้าบางรายการมีไม่พอในคลังสินค้า</div>');
                    redirect(base_url('sell'));
                }
            }
        }
        $bank = $this->selleasy_model->get_bank()->row();
        $data = array(
            'receipt_master_id' => $receipt_master_id,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'user_id' => $this->session->userdata('user_id'),
            'type_receipt_id' => 1,
            'sale_from_id' => 1,
            'type_tax_id' => $this->input->post('type_tax_id'),
            'price_product_sum' => $this->input->post('price_product_sum'),
            'save' => $this->input->post('save'),
            'price_befor_tax' => $this->input->post('price_befor_tax'),
            'price_tax' => $this->input->post('price_tax'),
            'price' => $this->input->post('price'),
            'price_sum_pay' => $this->input->post('price_sum_pay'),
            'bank_id' => $bank->bank_id,
            'status_receipt_id' => 1,
            'status_pay_id' => 1,
            'status_transfer_id' => 2,
            'status_receipt_print_id' => 2,
            'status_receipt_order_id' => 2,
            'status_sticker_transport_id' => 2,
            'status_pack_id' => 2,
            'date_transfer' => $this->mics->getDate(),
            'date_receipt_print' => $this->mics->getDate(),
            'date_sticker' => $this->mics->getDate(),
            'date_pack' => $this->mics->getDate(),
            'date_receipt' => $this->input->post('date_receipt'),
            'date_pay' => $this->mics->getDate(),
            'date_modify' => $this->mics->getDate()
        );

        $this->db->insert('receipt_master', $data);
        $receipt_master_id_pri = $this->db->insert_id();

        for ($i = 0; $i < sizeof($product_id_arr); $i++) {
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

        $this->delete_in_stock($product_id_arr, $product_amount_arr);

        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->sell_number_default + 1;
        $text = '';
        for ($j = strlen($run_number); $j < 6; $j++) {
            $text .= '0';
        }
        $text .= $run_number;
        $data_run_number = array('sell_number_default' => $text);
        $this->accesscontrol->update_document_setting($data_run_number);

//        -- add log --
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้สร้างใบเสร็จขายหน้าร้าน เลขที่รายการ ' . $receipt_master_id);

        $bank_update = array(
            'bank_id' => $bank->bank_id,
            'bank_money' => $bank->bank_money + $this->input->post('price_sum_pay'),
            'date_modify' => $this->mics->getDate()
        );
        $this->selleasy_model->bank_update($bank_update);
        $this->systemlog->log_bank($user->fullname . ' ได้เพิ่มเงินใน ' . $bank->bank_name . ' จากใบเสร็จ รายการที่ ' . $receipt_master_id);
        //redirect(base_url() . 'receipt/billiv/' . $receipt_master_id_pri);
        //echo "<script type='text/javascript'> window.open('" . base_url() . "receipt/billiv/" . $receipt_master_id_pri . "','print_popup','width=200,height=100');</script>";
        //redirect(base_url() . 'selleasy');
        echo $receipt_master_id_pri;
    }

    private function delete_in_stock($product_id_arr, $product_amount_arr) {
        for ($i = 0; $i < sizeof($product_id_arr); $i++) {
            if ($product_id_arr[$i] != "" && $product_amount_arr[$i] != "") {

                $product_row = $this->selleasy_model->get_product($product_id_arr[$i])->row();
                $stocks = $this->selleasy_model->get_stock($product_id_arr[$i]);
                $amount_all = intval($product_amount_arr[$i]);

                $update_product = array(
                    'product_id_pri' => $product_row->product_id_pri,
                    'product_amount' => $product_row->product_amount - $amount_all,
                    'date_modify' => $this->mics->getDate()
                );
                $this->selleasy_model->product_update($update_product);

                foreach ($stocks->result() as $stock) {
                    if ($stock->map_product_amount >= $amount_all) {
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => $stock->map_product_amount - $amount_all,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->selleasy_model->map_stock_update($update);
                        break;
                    } else {
                        $amount_all = $amount_all - $stock->map_product_amount;
                        $update = array(
                            'stock_id_pri' => $stock->stock_id_pri,
                            'product_id_pri' => $product_row->product_id_pri,
                            'map_product_amount' => 0,
                            'date_modify' => $this->mics->getDate()
                        );
                        $this->selleasy_model->map_stock_update($update);
                    }
                }
            }
        }
    }

    public function checkbill() {
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
            if ($product_id_array[$i] != "" && $product_name_array[$i] != "") {
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

        $this->selleasy_model->deletereceipttemp();
        
        for ($i = 0; $i < sizeof($product_id_arr); $i++) {
            $detail = array(
                'shop_id_pri' => $this->session->userdata('shop_id_pri'),
                'user_id' => $this->session->userdata('user_id'),
                'product_id' => $product_id_arr[$i],
                'product_name' => $product_name_arr[$i],
                'product_amount' => $product_amount_arr[$i],
                'product_unit' => $product_unit_arr[$i],
                'product_price' => $product_price_arr[$i],
            );
            $this->db->insert('receipt_temp', $detail);
        }

        echo 1;
    }
    
    public function deletecheckbill() {
        $this->selleasy_model->deletereceipttemp();
        echo 1;
    }

    public function showcheckbill($price_sum_pay,$get_pay_money,$status) {
        $data = array(
            'price_sum_pay' => $price_sum_pay,
            'get_pay_money' => $get_pay_money,
            'status' => $status
        );
        $this->load->view('ajax/selleasy_checkbill', $data);
    }

}
