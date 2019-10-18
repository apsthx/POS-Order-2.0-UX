<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport
 *
 * @author Prasan Srisopa
 */
class Stickertransport extends CI_Controller {

    //put your code here
    public $group_id = 12;
    public $menu_id = 44;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('stickertransport_model');
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/stickertransport.js'),
        );
        $this->renderView('stickertransport_view', $data);
    }

    public function dataunready() {
        $dateunready_start = $this->input->post('dateunready_start');
        $dateunready_end = $this->input->post('dateunready_end');
        $customer_group_id = $this->input->post('customer_group_id');
        $data = array(
            'datas' => $this->stickertransport_model->get_receipt_master_unready($dateunready_start, $dateunready_end),
            'customer_group_id' => $customer_group_id,
        );
        $this->load->view('ajax/stickertransport_unready', $data);
    }

    public function datasuccess() {
        $datesuccess_start = $this->input->post('datesuccess_start');
        $datesuccess_end = $this->input->post('datesuccess_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'datas' => $this->stickertransport_model->get_receipt_master_success($datesuccess_start, $datesuccess_end, $transport_service_id),
        );
        $this->load->view('ajax/stickertransport_success', $data);
    }

    public function printtransportunready() {
        $receipt_master_id_pri = $this->input->post('unready_master_id_pri_arr');
        $unready_checkbox = $this->input->post('select_unready_checkbox');

//        print_r($receipt_master_id_pri) ;
//        print_r($unready_checkbox) ;
//        for ($i = 1; $i <= sizeof($receipt_master_id_pri); $i++) {
//            if (isset($unready_checkbox[$i]) && $unready_checkbox[$i] == 'on') {
//                echo $receipt_master_id_pri[$i];
//            }
//        }

        $pdf = $this->pdf2->loadthaicustom(100, 50);
        for ($i = 1; $i <= sizeof($receipt_master_id_pri); $i++) {
            if (isset($unready_checkbox[$i]) && $unready_checkbox[$i] == 'on') {

                $data_master = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri[$i]
                );

                if ($this->input->post('transport_service_id') == 3) {
                    $data_edit = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'transport_service_id' => $this->input->post('transport_service_id'),
                        'transport_service_name' => $this->stickertransport_model->ref_transport_service($this->input->post('transport_service_id'))->row()->transport_service_name,
                        'status_sticker_transport_id' => 2,
                        'date_sticker' => $this->mics->getDate(),
                        'status_pack_id' => 2,
                        'date_pack' => $this->mics->getDate(),
                    );
                }else{
                    $data_edit = array(
                        'user_id' => $this->session->userdata('user_id'),
                        'transport_service_id' => $this->input->post('transport_service_id'),
                        'transport_service_name' => $this->stickertransport_model->ref_transport_service($this->input->post('transport_service_id'))->row()->transport_service_name,
                        'status_sticker_transport_id' => 2,
                        'date_sticker' => $this->mics->getDate(),
                    );
                }
                $this->stickertransport_model->edit($receipt_master_id_pri[$i], $data_edit);


                $this->systemlog->log_receipt($receipt_master_id_pri[$i], $this->stickertransport_model->get_user($this->session->userdata('user_id'))->row()->fullname . ' ได้ทำการพิมพ์สติ๊กเกอร์ เลขที่รายการ ' . $this->stickertransport_model->get_receipt_master_id($receipt_master_id_pri[$i])->row()->receipt_master_id);
//            $pdf->AddPage('', '', '', '', '', 3, 2, 2, 1, 0, 0);
//
//            $html1 = $this->load->view('ajax/printtransportfrom_view', $data, true);
//            $pdf->WriteHTML($html1);

                $pdf->AddPage('', '', '', '', '', 3, 2, 2, 1, 0, 0);

                $html2 = $this->load->view('ajax/printtransportto_view', $data_master, true);
                $pdf->WriteHTML($html2);
            }
        }
        $pdf->Output('พิมพ์สติ๊กเกอร์คงค้าง' . date('YmdHis') . '.pdf', 'I');
        exit;
    }

    public function printtransportsuccess() {
        $receipt_master_id_pri = $this->input->post('success_master_id_pri_arr');
        $success_checkbox = $this->input->post('select_success_checkbox');

        $pdf = $this->pdf2->loadthaicustom(100, 50);
        for ($i = 1; $i <= sizeof($receipt_master_id_pri); $i++) {
            if (isset($success_checkbox[$i]) && $success_checkbox[$i] == 'on') {

                $data = array(
                    'receipt_master_id_pri' => $receipt_master_id_pri[$i]
                );

                $data_edit = array(
                    'date_sticker' => $this->mics->getDate(),
                );
                $this->stickertransport_model->edit($receipt_master_id_pri[$i], $data_edit);

                $pdf->AddPage('', '', '', '', '', 3, 2, 2, 1, 0, 0);

                $html2 = $this->load->view('ajax/printtransportto_view', $data, true);
                $pdf->WriteHTML($html2);
            }
        }
        $pdf->Output('พิมพ์สติ๊กเกอร์เสร็จสิน' . date('YmdHis') . '.pdf', 'I');
        exit;
    }

}
