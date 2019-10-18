<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicescheck
 *
 * @author Prasan Srisopa
 */
class Servicescheck extends CI_Controller{
    //put your code here 14 91
    public $group_id = 14;
    public $menu_id = 91;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('servicescheck_model');
        $this->load->model('serviceslist_model');
        $this->load->model('services_model');
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('flash-message.js', 'build/servicescheck.js?v=1'),
        );
        $this->renderView('servicescheck_view', $data);
    }

    public function data() {
        $data = array(
            'datas' => $this->servicescheck_model->get_services_master(),
        );
        $this->load->view('ajax/servicescheck_page', $data);
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
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            $services_status = $this->input->post('services_status');
            foreach ($this->input->post('select_services_checkbox') as $services_master_id_pri) {
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
                if($services_status == 2){
                    $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะใบเปิดบริการ เป็น ดำเนินการเสร็จสิ้น เลขที่รายการ ' . $services_master->services_master_id);
                }else{
                    $this->systemlog->log_services($services_master_id_pri, $user->fullname . ' ได้ปรับสถานะใบเปิดบริการ เป็น ยกเลิก เลขที่รายการ ' . $services_master->services_master_id);
                }
            }
            redirect(base_url() . 'servicescheck');
        } 
    }
}
