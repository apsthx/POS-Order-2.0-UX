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
class Transportprocess_model extends CI_Model {

    //put your code here
    public function get_receipt_master() {
        $this->db->select('*');
        $this->db->join('transport_api', 'transport_api.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.transport_service_id !=', 99);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.type_receipt_id', 3);
        $this->db->where('receipt_master.status_transfer_id', 2);
        $this->db->where('transport_api.transport_status_id != ', 3);
        $this->db->where('transport_api.transport_status_id != ', 4);
        $this->db->where('transport_api.transport_status_id != ', 5);
        $this->db->where('transport_api.date_success is NULL');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('receipt_master.transport_service_id');
        return $this->db->get('receipt_master');
    }

    public function update_receipt($data, $receipt_master_id_pri) {
        $this->db->where('transport_api.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->update('transport_api', $data);
    }

    public function update_receiptBytrackingId($data, $transport_tracking_id) {
        $this->db->where('transport_api.receipt_master_id_pri', $transport_tracking_id);
        $this->db->update('transport_api', $data);
    }

    public function update_process_transport($data) {
        $this->db->where('process_transport.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('process_transport', $data);
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
