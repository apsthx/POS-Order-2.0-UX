<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receipt
 *
 * @author Prasan Srisopa
 */
class Receipt extends CI_Controller {

    //put your code here
    public $group_id = 8;
    public $menu_id = 20;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('receipt_model');
        $this->load->library('pdf2');
        $this->load->library('thsms');
        //$this->load->model('sms_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            //'css' => array('parsley.css'),
            //'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('flash-message.js', 'build/receipt.js'),
        );
        $this->renderView('receipt_view', $data);
    }

    public function data() {
        $date_select = $this->input->post('date_select');
        $status_receipt_id = $this->input->post('status_receipt_id');
        $status_receipt_order_id = $this->input->post('status_receipt_order_id');
        $data = array(
            'datas' => $this->receipt_model->get_receipt_master($status_receipt_id, $status_receipt_order_id, $date_select),
        );
        $this->load->view('ajax/receipt_page', $data);
    }

    public function receipt_process() {
        $print_order = $this->input->post('print_order');
        $receipt_master_id_pri_array = $this->input->post('receipt_master_id_pri_arr');
        $status_receipt_id_array = $this->input->post('status_receipt_id_arr');
        $status_receipt_order_id_array = $this->input->post('status_receipt_order_id_arr');
        $select_receipt_checkbox_array = $this->input->post('select_receipt_checkbox');

        $bank_id = $this->input->post('bank_id');
        $print = $this->input->post('print');
        $send_sms = $this->input->post('send_sms');

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
                $id_pri = $this->save($receipt_master_id_pri, $bank_id, $send_sms, $print);
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
                redirect(base_url() . 'receipt');
            }

            echo "<form id='print-submit' action='" . $url . "' method='post' >";
            foreach ($id_pri_print_arr as $id_pri) {
                echo "<input type='hidden' name='receipt_master_id_pri_arr[]' value='" . $id_pri . "' />";
            }
            echo "</form>";
            echo "<script>document.getElementById('print-submit').submit();window.history.back();</script>";
        }
    }

    private function save($receipt_master_id_pri, $bank_id, $send_sms, $print) {

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
                'customer_district' => $receipt_master->customer_district,
                'customer_amphoe' => $receipt_master->customer_amphoe,
                'customer_province' => $receipt_master->customer_province,
                'customer_zipcode' => $receipt_master->customer_zipcode,
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
                'transport_customer_district' => $receipt_master->customer_district,
                'transport_customer_amphoe' => $receipt_master->customer_amphoe,
                'transport_customer_province' => $receipt_master->customer_province,
                'transport_customer_zipcode' => $receipt_master->customer_zipcode,
                'price_sum_pay' => $receipt_master->price_sum_pay,
                'status_receipt_id' => 1,
                'status_pay_id' => 1,
                'status_receipt_order_id' => 2,
                'status_transfer_id' => 1,
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

//            $this->delete_in_stock($product_id_arr, $product_amount_arr);

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


            if ($send_sms == 'on') {
                $res_receipt = $this->sendSMSreceipt($receipt_master_id_pri_add);
                if ($res_receipt == 0) {
                    $this->session->set_flashdata('flash_message', '<div><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;ไม่สามารถส่ง SMS เลขที่ใบเสร็จได้</div>');
                }
            }

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

    public function cancel() {
        $receipt_master_id_pri = $this->input->post('id_pri_cancel');
        $comment = $this->input->post('comment');
        $receipt_master = $this->receipt_model->get_receipt_cancel($receipt_master_id_pri);
        if ($receipt_master->num_rows() == 0) {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;การยกเลิกเกิดข้อผิดพลาด</div>');
            redirect(base_url('receipt'));
        } else {
            $master = $receipt_master->row();
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'status_receipt_id' => 2,
                'comment' => $comment,
                'date_modify' => $this->mics->getDate()
            );
            $this->db->where('receipt_master_id_pri', $receipt_master_id_pri)
                    ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                    ->update('receipt_master', $data);

//        -- add log --
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $this->systemlog->log_receipt($receipt_master_id_pri, $user->fullname . ' ได้ยกเลิกใบเปิด Order เลขที่รายการ ' . $master->receipt_master_id);
            redirect(base_url('receipt'));
        }
    }

    private function sand_sms() {
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri');
        $res = file_get_contents(base_url() . 'sms/sendSMStransport/' . $receipt_master_id_pri);
        echo $res;
    }

    public function printbillA4() {
        $pdf = $this->pdf2->loadthaiA4();
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri_arr');

        for ($x = 0; $x < sizeof($receipt_master_id_pri); $x++) {
            $data_detail = $this->receipt_model->get_receipt_detail(null, $receipt_master_id_pri[$x]);
            $num_detail = $data_detail->num_rows();
            $limit = 14;
            $pageall = $num_detail / $limit;
            $pageall = ceil($pageall);

            for ($i = 0; $i < $pageall; $i++) {
                $start = $i * $limit;
                $data = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri[$x],
                    'limit' => $limit,
                    'start' => $start,
                    'page' => ($i + 1),
                    'pageall' => $pageall,
                );
                $pdf->AddPage('', '', '', '', '', 10, 10, 3, 3, 0, 0);
                $html1 = $this->load->view('ajax/printbill1_view', $data, true);
                $pdf->WriteHTML($html1);
                $html2 = $this->load->view('ajax/printbill2_view', $data, true);
                $pdf->WriteHTML($html2);
                $html3 = $this->load->view('ajax/printbill3_view', $data, true);
                $pdf->WriteHTML($html3);
                $html4 = $this->load->view('ajax/printbill4_view', $data, true);
                $pdf->WriteHTML($html4);
                $html5 = $this->load->view('ajax/printbill5_view', $data, true);
                $pdf->WriteHTML($html5);
            }
        }
        $pdf->Output('printbill.pdf', 'I');
        exit;
    }

    public function printbillA5() {
        $pdf = $this->pdf2->loadthaiA5();
        $receipt_master_id_pri = $this->input->post('receipt_master_id_pri_arr');

        for ($x = 0; $x < sizeof($receipt_master_id_pri); $x++) {
            $data_detail = $this->receipt_model->get_receipt_detail(null, $receipt_master_id_pri[$x]);
            $num_detail = $data_detail->num_rows();
            $limit = 10;
            $pageall = $num_detail / $limit;
            $pageall = ceil($pageall);

            for ($i = 0; $i < $pageall; $i++) {
                $start = $i * $limit;
                $data = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri[$x],
                    'limit' => $limit,
                    'start' => $start,
                    'page' => ($i + 1),
                    'pageall' => $pageall,
                );
                $pdf->AddPage('', '', '', '', '', 2, 2, 1, 1, 0, 0);
                $html1 = $this->load->view('ajax/printbilla51_view', $data, true);
                $pdf->WriteHTML($html1);
                $html2 = $this->load->view('ajax/printbilla52_view', $data, true);
                $pdf->WriteHTML($html2);
                $html3 = $this->load->view('ajax/printbilla53_view', $data, true);
                $pdf->WriteHTML($html3);
                $html4 = $this->load->view('ajax/printbilla54_view', $data, true);
                $pdf->WriteHTML($html4);
            }
        }
        $pdf->Output('printbill.pdf', 'I');
        exit;
    }

    public function billiv($receipt_master_id_pri) {
        $data = array(
            'receipt_master_id_pri' => $receipt_master_id_pri,
        );
        $this->load->view('ajax/printiv_view', $data);
    }

    private function sendSMSreceipt($receipt_master_id_pri) {
        $sms = new thsms();

        $datareceipt = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $datasms = $this->receipt_model->get_sms(null, $shop_id_pri)->row();
        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        $tel = $datareceipt->customer_tel;
        $text = 'ได้รับการชำระเงินแล้ว -> เลขใบเสร็จ : ' . $datareceipt->receipt_master_id;
        if ($datasms->credit_balance > 0) {
            $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
            if ($creditsend[1] == 'OK') {
                $data = array(
                    'credit_sum' => $datasms->credit_sum + 1,
                    'credit_balance' => $datasms->credit_balance - 1,
                    'credit_all' => $creditsend[3],
                );
                $this->receipt_model->editsms($datasms->setting_sms_id, $data);
                $action_text = $text . ' ส่งไปยัง ' . $tel;
                $user_id = $this->session->userdata('user_id');
                $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
