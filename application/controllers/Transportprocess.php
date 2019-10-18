<?php

ini_set('memory_limit', 512000000000);
ini_set('max_execution_time', 0);
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transportprocess
 *
 * @author Prasan Srisopa
 */
class Transportprocess extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('transportprocess_model');
        $this->load->library('simple_html_dom');
        $this->db->query('SET SESSION wait_timeout = 3600');
    }

    public function process() {
        $receipts = $this->transportprocess_model->get_receipt_master();
        if ($receipts->num_rows() > 0) {
            foreach ($receipts->result() as $row) {
                $data = array();
                if ($row->transport_service_id == 2) {
                    $html = file_get_html('https://th.kerryexpress.com/en/track/?track=' . $row->transport_tracking_id);
                    $ck = 0;
                    foreach ($html->find('div .piority-success') as $element) {
                        $ck = 1;
                        foreach ($element->find('.date div') as $date) {
                            $data['date_success'] = $this->mics->getDate();
                            $data['transport_status_id'] = 4;
                            break;
                        }
                    }
                    if ($ck == 0) {
                        foreach ($html->find('div .piority-waiting') as $element) {
                            foreach ($element->find('.desc div') as $val) {
                                if (stripos($val, "Undelivered shipment return to origin") !== false) {
                                    $ck = 1;
                                    $data['date_success'] = $this->mics->getDate();
                                    $data['transport_status_id'] = 3;
                                    break;
                                }
                            }
                        }
                    }
                    if ($ck == 0) {
                        foreach ($html->find('div .piority-waiting') as $element) {
                            foreach ($element->find('.date div') as $date) {
                                if (strlen($date) > 18) {
                                    $ck = 1;
                                    break;
                                }
                            }
                        }
                        if ($ck == 0) {
                            $data['transport_status_id'] = 5;
                        }
                    }
                } elseif ($row->transport_service_id == 1) {
                    if (strlen($row->transport_tracking_id) == 13) {
                        $emsObj = $this->getEmsApi($row->transport_tracking_id);
                        if (isset($emsObj->status)) {
                            if ($emsObj->status == 4) {
                                $data['date_success'] = $this->mics->getDate();
                                $data['transport_status_id'] = 4;
                            } elseif ($emsObj->status == 45) {
                                $data['date_success'] = $this->mics->getDate();
                                $data['transport_status_id'] = 3;
                            }
                        }
                    } else {
                        $data['date_success'] = $this->mics->getDate();
                        $data['transport_status_id'] = 5;
                    }
                }
                if (sizeof($data) > 0) {
                    $this->transportprocess_model->update_receipt($data, $row->receipt_master_id_pri);
                }
            }
        }
        $data_process = array(
            'user_id' => $this->session->userdata('user_id'),
            'date_modify' => $this->mics->getDate()
        );
        $this->transportprocess_model->update_process_transport($data_process);

        redirect(base_url() . 'checktransport');
    }

    private function getEmsApi($barcode) {
        $authenEMS = $this->transportprocess_model->get_ems_api();
        if ($authenEMS->num_rows() > 0) {
            $authen = $authenEMS->row();
            $authen_encode = base64_encode($authen->username . ':' . $authen->password);
        }
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'GET',
                'header' => "Authorization: Basic $authen_encode=",
                'ignore_errors' => true
            )
        ));
        $response = file_get_contents("http://r_dservice.thailandpost.com:8080/webservice/getOrderByBarcode?barcode=$barcode", false, $context);
        $object = json_decode($response);
        return $object;
    }

}
