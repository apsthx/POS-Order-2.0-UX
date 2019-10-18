<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporttransportdelivery_model
 *
 * @Prasan Srisopa
 */
class Reporttransportdelivery_model extends CI_Model{
    //put your code here
     public function get_transport_api($date_start = null,$date_end = null,$transport_service_id = null) {
        $this->db->join('receipt_master', 'transport_api.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->join('ref_transport_status', 'transport_api.transport_status_id = ref_transport_status.transport_status_id');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_id', 1);
        if($date_start != null){
            $this->db->where('receipt_master.date_transfer >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_transfer <=', $date_end);     
        }
        if($transport_service_id != null){
            $this->db->where('receipt_master.transport_service_id', $transport_service_id);     
        }
        $this->db->where('transport_api.transport_status_id', 4);
        return $this->db->get('transport_api');
    }
    
    public function get_province($zipcode_id) {       
        $this->db->where('zipcode.zipcode', $zipcode_id);
        return $this->db->get('zipcode');
    }
    
    public function get_receipt_detail($receipt_master_id_pri) {
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        return $this->db->get('receipt_master');
    }
}
