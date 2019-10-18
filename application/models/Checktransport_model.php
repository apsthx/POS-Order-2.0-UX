<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Checktransport_model
 *
 * @Prasan Srisopa
 */
class Checktransport_model extends CI_Model {

    //put your code here

    public function get_receipt_master($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('receipt_master');
    }

    public function get_transport_api_unready($dateunready_start = null, $dateunready_end = null, $transport_service_id = null, $transport_status_id = null) {
        $this->db->join('receipt_master', 'transport_api.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->join('ref_transport_status', 'transport_api.transport_status_id = ref_transport_status.transport_status_id');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_id', 1);
        if ($dateunready_start != null) {
            $this->db->where('receipt_master.date_transfer >=', $dateunready_start);
        }
        if ($dateunready_end != null) {
            $this->db->where('receipt_master.date_transfer <=', $dateunready_end);
        }
        if ($transport_service_id != null) {
            $this->db->where('receipt_master.transport_service_id', $transport_service_id);
        }
        if ($transport_status_id != null) {
            $this->db->where('transport_api.transport_status_id', $transport_status_id);
        }
        return $this->db->get('transport_api');
    }

    public function get_transport_api_success($datesuccess_start = null, $datesuccess_end = null, $transport_service_id = null) {
        $this->db->join('receipt_master', 'transport_api.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->join('ref_transport_status', 'transport_api.transport_status_id = ref_transport_status.transport_status_id');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_id', 1);
        if ($datesuccess_start != null) {
            $this->db->where('receipt_master.date_transfer >=', $datesuccess_start);
        }
        if ($datesuccess_end != null) {
            $this->db->where('receipt_master.date_transfer <=', $datesuccess_end);
        }
        if ($transport_service_id != null) {
            $this->db->where('receipt_master.transport_service_id', $transport_service_id);
        }
        $this->db->where('transport_api.transport_status_id', 4);
        return $this->db->get('transport_api');
    }

    public function get_process_transport() {
        $this->db->select('process_transport.date_modify,'
                . 'user.fullname');
        $this->db->join('user', 'process_transport.user_id = user.user_id');
        $this->db->where('process_transport.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('process_transport');
    }

    public function get_ems_api() {
        $this->db->select('transport_api_setting.username,
                            transport_api_setting.`password`,');
        $this->db->join('transport_setting', 'transport_api_setting.transport_setting_id = transport_setting.transport_setting_id');
        $this->db->where('transport_setting.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('transport_api_setting.transport_service_id', 1);
        return $this->db->get('transport_api_setting');
    }

}
