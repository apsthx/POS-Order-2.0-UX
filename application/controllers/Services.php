<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Services
 *
 * @author Prasan Srisopa
 */
class Services extends CI_Controller {

    //put your code here 14 88
    public $group_id = 14;
    public $menu_id = 88;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('services_model');
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'setting' => $this->accesscontrol->get_document_setting(),
            'transport' => $this->accesscontrol->get_transport_setting(),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('jquery-ui.min.css'),
            'js' => array('flash-message.js', 'jquery-ui.js', 'build/services.js?v=1'),
        );
        $this->renderView('services_view', $data);
    }

    //ลูกค้า
    public function customer_add_modal() {
        $this->load->view('modal/services_add_customer_modal');
    }

    public function get_customer_group_json() {
        $customer_group_id = $this->input->post('customer_group_id');
        $data = $this->services_model->get_customer($customer_group_id)->row();
        echo json_encode($data);
    }

    public function get_custome_autocomplete() {
        $json = array();
        $datas = $this->services_model->get_customer();
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $row) {
                $json[] = $row;
            }
        }
        echo json_encode($json);
    }

    //services
    public function services_modal() {
        $data = array(
            'services_id_arr' => $this->input->post('services_id_arr'),
        );
        $this->load->view('modal/services_add_services_modal', $data);
    }

    public function ajax_services_modal() {
        $services_id_arr = $this->input->post('services_id_arr');
        $data = array(
            'services_id_arr' => $services_id_arr,
            'datas' => $this->services_model->get_services(),
        );
        $this->load->view('ajax/services_add_services_modal', $data);
    }

    public function save() {
        // check services in stock
        $services_id_array = $this->input->post('services_id');
        $services_name_array = $this->input->post('services_name');
        $services_detail_number_array = $this->input->post('services_detail_number');
        $services_amount_array = $this->input->post('services_amount');
        $services_cost_array = $this->input->post('services_cost');
        $services_save_array = $this->input->post('services_save');
        $services_price_sum_array = $this->input->post('services_price_sum');

        $services_id_arr = array();
        $services_name_arr = array();
        $services_detail_number_arr = array();
        $services_amount_arr = array();
        $services_cost_arr = array();
        $services_save_arr = array();
        $services_price_sum_arr = array();

        $arr_stack = array();
        if (sizeof($services_id_array) > 0) {
            $arr = array_count_values($services_id_array);
        }
        for ($i = 0; $i < sizeof($services_id_array); $i++) {
            if ($services_id_array[$i] != "") {
                if ($arr[$services_id_array[$i]] > 1) {
                    if (!in_array($services_id_array[$i], $arr_stack)) {
                        $check_id = 0;
                        for ($z = 0; $z < sizeof($services_id_array) && $check_id == 0; $z++) {
                            if ($services_id_array[$z] == $services_id_array[$i]) {
                                if ($services_detail_number_array[$z] == "") {
                                    $check_id = 1;
                                }
                            }
                        }
                        if ($check_id == 1) {
                            for ($z = 0; $z < sizeof($services_id_array); $z++) {
                                if ($services_id_array[$z] == $services_id_array[$i]) {
                                    if ($services_detail_number_array[$z] != "") {
                                        //echo $i . '/' . $services_id_array[$i] . '/' . $services_detail_number_array[$i] . '=' . $z . '/' . $services_id_array[$z] . '/' . $services_detail_number_array[$z] . '</br>';
                                        $services_detail_number_array[$z] = '#' . ($i + 1);
                                        $services_id_arr[] = $services_id_array[$z];
                                        $services_name_arr[] = $services_name_array[$z];
                                        $services_detail_number_arr[] = $services_detail_number_array[$z];
                                        $services_amount_arr[] = $services_amount_array[$z];
                                        $services_cost_arr[] = $services_cost_array[$z];
                                        $services_save_arr[] = $services_save_array[$z];
                                        $services_price_sum_arr[] = $services_price_sum_array[$z];
                                    } else {
                                        $services_id_arr[] = $services_id_array[$z];
                                        $services_name_arr[] = $services_name_array[$z];
                                        $services_detail_number_arr[] = $services_detail_number_array[$z];
                                        $services_amount_arr[] = $services_amount_array[$z];
                                        $services_cost_arr[] = $services_cost_array[$z];
                                        $services_save_arr[] = $services_save_array[$z];
                                        $services_price_sum_arr[] = $services_price_sum_array[$z];
                                    }
                                }
                            }
                        }
                        $arr_stack[] = $services_id_array[$i];
                    }
                } else {
                    if ($services_detail_number_array[$i] == '') {
                        $services_id_arr[] = $services_id_array[$i];
                        $services_name_arr[] = $services_name_array[$i];
                        $services_detail_number_arr[] = $services_detail_number_array[$i];
                        $services_amount_arr[] = $services_amount_array[$i];
                        $services_cost_arr[] = $services_cost_array[$i];
                        $services_save_arr[] = $services_save_array[$i];
                        $services_price_sum_arr[] = $services_price_sum_array[$i];
                    }
                }
            }
        }
        //print_r($services_id_arr);echo '<br/>';print_r($services_name_arr);echo '<br/>';print_r($services_detail_number_arr);
        $services_master_id = $this->input->post('services_master_id');
        $check_services_master = $this->services_model->check_services_master_id($services_master_id);
        if ($check_services_master > 0) {
            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->services_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $services_master_id = $document->services_id_default . '-' . $text;
        }

        $data = array(
            'services_master_id' => $services_master_id,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'user_id' => $this->session->userdata('user_id'),
            'type_tax_id' => $this->input->post('type_tax_id'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_tel' => $this->input->post('customer_tel'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_district' => $this->input->post('customer_district'),
            'customer_amphoe' => $this->input->post('customer_amphoe'),
            'customer_province' => $this->input->post('customer_province'),
            'customer_zipcode' => $this->input->post('customer_zipcode'),
            'price_services_sum' => $this->input->post('price_services_sum'),
            'save' => $this->input->post('save'),
            'price_befor_tax' => $this->input->post('price_befor_tax'),
            'price_tax' => $this->input->post('price_tax'),
            'price' => $this->input->post('price'),
            //'transport_price' => $this->input->post('transport_price'),
            'price_sum_pay' => $this->input->post('price_sum_pay'),
            'comment' => $this->input->post('comment'),
            'services_start' => $this->input->post('services_start'),
            'services_end' => $this->input->post('services_end'),
            'services_day_num' => $this->input->post('services_day_num'),
            'services_day' => $this->input->post('services_day'),
            'services_alertday_num' => $this->input->post('services_alertday_num'),
            'services_alertday' => $this->input->post('services_alertday'),
            'services_status' => 1, //สถานะบริการ 1 รอดำเนินการ, 2 ดำเนินการแล้ว, 3 ยกเลิก
            'services_pay' => 2, //สถานะชำระ 1 ชำระเงินแล้ว , 2 รอชำระเงินแล้ว
            'date_create' => $this->input->post('date_create'),
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
        $this->db->insert('services_master', $data);
        $services_master_id_pri = $this->db->insert_id();

        for ($i = 0; $i < sizeof($services_id_arr); $i++) {
            if ($services_id_arr[$i] != "") {
                $detail = array(
                    'services_master_id_pri' => $services_master_id_pri,
                    'services_id' => $services_id_arr[$i],
                    'services_name' => $services_name_arr[$i],
                    'services_detail_number' => $services_detail_number_arr[$i],
                    'services_amount' => $services_amount_arr[$i],
                    'services_price' => $services_cost_arr[$i],
                    'services_save' => $services_save_arr[$i],
                    'services_price_sum' => $services_price_sum_arr[$i],
                );
                $this->db->insert('services_detail', $detail);
            }
        }
        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->services_number_default + 1;
        $text = '';
        for ($j = strlen($run_number); $j < 6; $j++) {
            $text .= '0';
        }
        $text .= $run_number;
        $data_run_number = array('services_number_default' => $text);
        $this->accesscontrol->update_document_setting($data_run_number);

        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้สร้างใบเปิดบริการ เลขที่รายการ ' . $services_master_id);
        
        redirect(base_url() . 'services/detail/' . $services_master_id_pri . '/1');
    }

    public function detail($services_master_id_pri = null, $active = null) {
        if ($this->services_model->check_services_master_id_pri($services_master_id_pri) == 1) {
            $data = array(
                'setting' => $this->accesscontrol->get_document_setting(),
                'transport' => $this->accesscontrol->get_transport_setting(),
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'icon' => $this->accesscontrol->getIcon($this->group_id),
                'title' => $this->accesscontrol->getNameTitle($this->menu_id),
                'css' => array( 'jquery-ui.min.css'),
                'js' => array('flash-message.js', 'jquery-ui.js', 'build/services.js?v=1'),
                'services_master_id_pri' => $services_master_id_pri,
                'active' => $active
            );
            $this->renderView('servicesdetail_view', $data);
        } else {
            redirect(base_url() . 'services');
        }
    }

    public function edit() {
        // check services in stock
        $services_id_array = $this->input->post('services_id');
        $services_name_array = $this->input->post('services_name');
        $services_detail_number_array = $this->input->post('services_detail_number');
        $services_amount_array = $this->input->post('services_amount');
        $services_cost_array = $this->input->post('services_cost');
        $services_save_array = $this->input->post('services_save');
        $services_price_sum_array = $this->input->post('services_price_sum');

        $services_id_arr = array();
        $services_name_arr = array();
        $services_detail_number_arr = array();
        $services_amount_arr = array();
        $services_cost_arr = array();
        $services_save_arr = array();
        $services_price_sum_arr = array();

        $arr_stack = array();
        if (sizeof($services_id_array) > 0) {
            $arr = array_count_values($services_id_array);
        }
        for ($i = 0; $i < sizeof($services_id_array); $i++) {
            if ($services_id_array[$i] != "") {
                if ($arr[$services_id_array[$i]] > 1) {
                    if (!in_array($services_id_array[$i], $arr_stack)) {
                        $check_id = 0;
                        for ($z = 0; $z < sizeof($services_id_array) && $check_id == 0; $z++) {
                            if ($services_id_array[$z] == $services_id_array[$i]) {
                                if ($services_detail_number_array[$z] == "") {
                                    $check_id = 1;
                                }
                            }
                        }
                        if ($check_id == 1) {
                            for ($z = 0; $z < sizeof($services_id_array); $z++) {
                                if ($services_id_array[$z] == $services_id_array[$i]) {
                                    if ($services_detail_number_array[$z] != "") {
                                        //echo $i . '/' . $services_id_array[$i] . '/' . $services_detail_number_array[$i] . '=' . $z . '/' . $services_id_array[$z] . '/' . $services_detail_number_array[$z] . '</br>';
                                        $services_detail_number_array[$z] = '#' . ($i + 1);
                                        $services_id_arr[] = $services_id_array[$z];
                                        $services_name_arr[] = $services_name_array[$z];
                                        $services_detail_number_arr[] = $services_detail_number_array[$z];
                                        $services_amount_arr[] = $services_amount_array[$z];
                                        $services_cost_arr[] = $services_cost_array[$z];
                                        $services_save_arr[] = $services_save_array[$z];
                                        $services_price_sum_arr[] = $services_price_sum_array[$z];
                                    } else {
                                        $services_id_arr[] = $services_id_array[$z];
                                        $services_name_arr[] = $services_name_array[$z];
                                        $services_detail_number_arr[] = $services_detail_number_array[$z];
                                        $services_amount_arr[] = $services_amount_array[$z];
                                        $services_cost_arr[] = $services_cost_array[$z];
                                        $services_save_arr[] = $services_save_array[$z];
                                        $services_price_sum_arr[] = $services_price_sum_array[$z];
                                    }
                                }
                            }
                        }
                        $arr_stack[] = $services_id_array[$i];
                    }
                } else {
                    if ($services_detail_number_array[$i] == '') {
                        $services_id_arr[] = $services_id_array[$i];
                        $services_name_arr[] = $services_name_array[$i];
                        $services_detail_number_arr[] = $services_detail_number_array[$i];
                        $services_amount_arr[] = $services_amount_array[$i];
                        $services_cost_arr[] = $services_cost_array[$i];
                        $services_save_arr[] = $services_save_array[$i];
                        $services_price_sum_arr[] = $services_price_sum_array[$i];
                    }
                }
            }
        }
        //print_r($services_id_arr);echo '<br/>';print_r($services_name_arr);echo '<br/>';print_r($services_detail_number_arr);
        $services_master_id_pri = $this->input->post('services_master_id_pri');
        $services_master_id = $this->input->post('services_master_id');
        $check_services_master = $this->services_model->check_services_master_id($services_master_id);
        if ($check_services_master > 0) {
            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->services_number_default + 1;
            $text = '';
            for ($j = strlen($run_number); $j < 6; $j++) {
                $text .= '0';
            }
            $text .= $run_number;
            $services_master_id = $document->services_id_default . '-' . $text;
        }

        $data = array(
            'services_master_id' => $services_master_id,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'user_id' => $this->session->userdata('user_id'),
            'type_tax_id' => $this->input->post('type_tax_id'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_tel' => $this->input->post('customer_tel'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_address' => $this->input->post('customer_address'),
            'customer_district' => $this->input->post('customer_district'),
            'customer_amphoe' => $this->input->post('customer_amphoe'),
            'customer_province' => $this->input->post('customer_province'),
            'customer_zipcode' => $this->input->post('customer_zipcode'),
            'price_services_sum' => $this->input->post('price_services_sum'),
            'save' => $this->input->post('save'),
            'price_befor_tax' => $this->input->post('price_befor_tax'),
            'price_tax' => $this->input->post('price_tax'),
            'price' => $this->input->post('price'),
            //'transport_price' => $this->input->post('transport_price'),
            'price_sum_pay' => $this->input->post('price_sum_pay'),
            'comment' => $this->input->post('comment'),
            'services_start' => $this->input->post('services_start'),
            'services_end' => $this->input->post('services_end'),
            'services_day_num' => $this->input->post('services_day_num'),
            'services_day' => $this->input->post('services_day'),
            'services_alertday_num' => $this->input->post('services_alertday_num'),
            'services_alertday' => $this->input->post('services_alertday'),
            'services_status' => 1, //สถานะบริการ 1 รอดำเนินการ, 2 ดำเนินการแล้ว, 3 ยกเลิก
            'services_pay' => 2, //สถานะชำระ 1 ชำระเงินแล้ว , 2 รอชำระเงินแล้ว
            'date_create' => $this->input->post('date_create'),
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

        $this->db->where('services_master_id_pri', $services_master_id_pri)->update('services_master', $data);

        $this->db->where('services_master_id_pri', $services_master_id_pri)->delete('services_detail');

        for ($i = 0; $i < sizeof($services_id_arr); $i++) {
            if ($services_id_arr[$i] != "") {
                $detail = array(
                    'services_master_id_pri' => $services_master_id_pri,
                    'services_id' => $services_id_arr[$i],
                    'services_name' => $services_name_arr[$i],
                    'services_detail_number' => $services_detail_number_arr[$i],
                    'services_amount' => $services_amount_arr[$i],
                    'services_price' => $services_cost_arr[$i],
                    'services_save' => $services_save_arr[$i],
                    'services_price_sum' => $services_price_sum_arr[$i],
                );
                $this->db->insert('services_detail', $detail);
            }
        }
        
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้แก้ไขใบเปิดบริการ เลขที่รายการ ' . $services_master_id);
        
        redirect(base_url() . 'services/detail/' . $services_master_id_pri . '/1');
    }

    public function printservicesA4($services_master_id_pri) {
        $pdf = $this->pdf2->loadthaiA4();
        //$services_master_id_pri = $this->input->post('services_master_id');

        $data_detail = $this->services_model->get_services_detail($services_master_id_pri);
        $num_detail = $data_detail->num_rows();
        $limit = 14;
        $pageall = $num_detail / $limit;
        $pageall = ceil($pageall);

        for ($i = 0; $i < $pageall; $i++) {
            $start = $i * $limit;
            $data = array(
                'services_master_id_pri' => $services_master_id_pri,
                'limit' => $limit,
                'start' => $start,
                'page' => ($i + 1),
                'pageall' => $pageall,
            );
            $pdf->AddPage('', '', '', '', '', 10, 10, 3, 3, 0, 0);
            $html1 = $this->load->view('ajax/printservices1_view', $data, true);
            $pdf->WriteHTML($html1);
            $html2 = $this->load->view('ajax/printservices2_view', $data, true);
            $pdf->WriteHTML($html2);
            $html3 = $this->load->view('ajax/printservices3_view', $data, true);
            $pdf->WriteHTML($html3);
            $html4 = $this->load->view('ajax/printservices4_view', $data, true);
            $pdf->WriteHTML($html4);
            $html5 = $this->load->view('ajax/printservices5_view', $data, true);
            $pdf->WriteHTML($html5);
        }
        
        $pdf->Output('printservices.pdf', 'I');
        exit;
    }

}
