<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Serviceslist
 *
 * @author Prasan Srisopa
 */
class Serviceslist extends CI_Controller {

    //put your code here 14 90
    public $group_id = 14;
    public $menu_id = 90;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('serviceslist_model');
        $this->load->model('services_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper("file");
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('flash-message.js', 'build/serviceslist.js?v=1'),
        );
        $this->renderView('serviceslist_view', $data);
    }

    public function data() {
        $services_status = $this->input->post('services_status');
        $services_day_start = $this->input->post('services_day_start');
        $services_day_end = $this->input->post('services_day_end');
        $services_pay = $this->input->post('services_pay');
        $data = array(
            'services_status' => $services_status,
            'datas' => $this->serviceslist_model->get_services_master($services_status, $services_day_start, $services_day_end, $services_pay),
        );
        $this->load->view('ajax/serviceslist_page', $data);
    }

    public function services() {
        $event = $this->input->post('event');
        if ($event == 1) {
            $pdf = $this->pdf2->loadthaiA4();
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                //echo $services_master_id_pri.'<br>';
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
            }
            $pdf->Output('printbill.pdf', 'I');
            exit;
        } else if ($event == 2) {
            //echo $this->input->post('services_status') . '<br>';
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $services_status = $this->input->post('services_status');
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                //echo $services_master_id_pri . '<br>';
                $services_master = $this->services_model->get_servicesmaster($services_master_id_pri)->row();
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'services_status' => $services_status,
                    'date_services' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate()
                );
                $this->db->where('services_master_id_pri', $services_master_id_pri)
                        ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                        ->update('services_master', $data);
                if ($services_status == 2) {
                    $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะใบเปิดบริการ เป็น ดำเนินการเสร็จสิ้น เลขที่รายการ ' . $services_master->services_master_id);
                } else {
                    $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะใบเปิดบริการ เป็น ยกเลิก เลขที่รายการ ' . $services_master->services_master_id);
                }
            }
            redirect(base_url() . 'serviceslist');
        } else if ($event == 3) {
            //echo $this->input->post('services_status') . '<br>';
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                //echo $services_master_id_pri . '<br>';
                $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
                $services_master = $this->services_model->get_servicesmaster($services_master_id_pri)->row();
                if ($services_master->services_pay == 1) {
                    $data = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'services_status' => 3,
                        'date_services' => $this->mics->getDate(),
                        'services_pay' => 2,
                        'date_pay' => $this->mics->getDate(),
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->serviceslist_model->servicesmaster_update($data, $services_master_id_pri);
                    $bank_id = $services_master->bank_id;
                    $bank = $this->serviceslist_model->get_bank($bank_id)->row();
                    $bank_update = array(
                        'bank_id' => $bank_id,
                        'bank_money' => $bank->bank_money - $services_master->price_sum_pay,
                        'date_modify' => $this->mics->getDate()
                    );
                    $this->serviceslist_model->bank_update($bank_update);
                    $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . 'จากใบบริการ เลขที่รายการ ' . $services_master->services_master_id);
                } else {
                    $data = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'services_status' => 3,
                        'date_services' => $this->mics->getDate(),
                        'date_modify' => $this->mics->getDate()
                    );
                }
                $this->db->where('services_master_id_pri', $services_master_id_pri)
                        ->where('shop_id_pri', $this->session->userdata('shop_id_pri'))
                        ->update('services_master', $data);

                $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะใบเปิดบริการ เป็น ยกเลิก เลขที่รายการ ' . $services_master->services_master_id);
            }
            redirect(base_url() . 'serviceslist');
        } else if ($event == 4) {
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                $services_master = $this->services_model->get_servicesmaster($services_master_id_pri)->row();
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'services_pay' => 2,
                    'date_pay' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate()
                );
                $this->serviceslist_model->servicesmaster_update($data, $services_master_id_pri);
                $bank_id = $services_master->bank_id;
                $bank = $this->serviceslist_model->get_bank($bank_id)->row();
                $bank_update = array(
                    'bank_id' => $bank_id,
                    'bank_money' => $bank->bank_money - $services_master->price_sum_pay,
                    'date_modify' => $this->mics->getDate()
                );
                $this->serviceslist_model->bank_update($bank_update);
                $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . 'จากใบบริการ เลขที่รายการ ' . $services_master->services_master_id);
                $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะการส่งมอบ เป็น รอการส่งมอบ เลขที่รายการ ' . $services_master->services_master_id);
            }
            $pdf = $this->pdf2->loadthaiA4();
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                //echo $services_master_id_pri.'<br>';
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
            }
            $pdf->Output('printbill.pdf', 'I');
            exit;
        } else if ($event == 5) {
            $bank_id = $this->input->post('bank_id');
            $bank = $this->serviceslist_model->get_bank($bank_id)->row();
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                $services_master = $this->services_model->get_servicesmaster($services_master_id_pri)->row();
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'services_pay' => 1,
                    'date_pay' => $this->mics->getDate(),
                    'date_modify' => $this->mics->getDate()
                );
                $this->serviceslist_model->servicesmaster_update($data, $services_master_id_pri);

                $bank_update = array(
                    'bank_id' => $bank_id,
                    'bank_money' => $bank->bank_money + $services_master->price_sum_pay,
                    'date_modify' => $this->mics->getDate()
                );
                $this->serviceslist_model->bank_update($bank_update);
                $this->systemlog->log_bank($user->fullname . ' ได้เพิ่มเงินใน ' . $bank->bank_name . 'จากใบบริการ เลขที่รายการ ' . $services_master->services_master_id);
                $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะการส่งมอบ เป็น ส่งมอบงานแล้ว เลขที่รายการ ' . $services_master->services_master_id);
            }
            $pdf = $this->pdf2->loadthaiA4();
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
                //echo $services_master_id_pri.'<br>';
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
            }
            $pdf->Output('printbill.pdf', 'I');
            exit;
        }
    }

    public function upload() {
        $path = "./assets/upload/file/"; //server path 
        $link_part = 'assets/upload/file/';
        $config = array(
            'upload_path' => $path,
            //'overwrite' => 1, 
            'max_size' => 102400,
            //'allowed_types' => 'psd|pdf|xls|ppt|php|php4|php3|js|swf|Xhtml|zip|rar|mid|midi|gif|jpg|jpeg|png|html|htm|txt|rtf|doc|xls|docx|xlsx|word|csv|ppt|pptx|vsd|vsdx|accdb|mdb'
            'allowed_types' => 'gif|jpg|jpeg|png'
        );

        $this->load->library('upload', $config);
        $i = 0;
        $z = 0;
        foreach ($_FILES as $key) {
            $z++;
            $name_type = explode('.', $key['name']);
            //if (!(preg_match("/^[a-zA-Z0-9]+$/", $name_type[0]))) { 
            $filename = $this->input->post('services_master_id_pri') . $z . date("YmdHis") . '.' . $name_type[1];
            //} 
            //echo ($filename);
            $_FILES['upload[]']['name'] = $filename;
            $_FILES['upload[]']['type'] = $key['type'];
            $_FILES['upload[]']['tmp_name'] = $key['tmp_name'];
            $_FILES['upload[]']['size'] = $key['size'];
            //print_r($_FILES);
            $this->upload->initialize($config);
            //print_r($this->upload->initialize($config));
            if ($this->upload->do_upload('upload[]')) {
                $this->upload->data();
                //print_r($this->upload->data());
                $link = $this->upload->data('file_name');
                $data = array(
                    'files_name' => $link,
                    'files_create' => $this->mics->getDate(),
                    'user_id' => $this->session->userdata('user_id'),
                    'services_master_id_pri' => $this->input->post('services_master_id_pri'),
                );
                $this->db->insert('files', $data);
            } else {
                $i++;
                //$error = array('error' => $this->upload->display_errors());
                //print_r($error);
            }
        }
        echo $i;
    }

    public function modal_file() {
        $services_master_id_pri = $this->input->post('services_master_id_pri');
        $data = array(
            'data' => $this->serviceslist_model->get_file($services_master_id_pri),
            'services_master_id_pri' => $services_master_id_pri,
        );
        $this->load->view('modal/serviceslist_file_modal', $data);
    }
    
     public function deletefile() {
        $id = $this->input->post('id');
        $files = $this->serviceslist_model->get_file_id($id)->row();
        @unlink('./assets/upload/file/' . $files->files_name);
        $this->db->where('files_id', $id)->delete('files');
        
        $services_master_id_pri = $files->services_master_id_pri;
        $data = array(
            'data' => $this->serviceslist_model->get_file($services_master_id_pri),
            'services_master_id_pri' => $services_master_id_pri,
        );
        $this->load->view('modal/serviceslist_file_modal', $data);
    }


}
