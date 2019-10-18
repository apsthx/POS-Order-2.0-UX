<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transportcustomer_model
 *
 * @author Prasan Srisopa
 */
class Transportcustomer_model extends CI_Model{
    //put your code here
    public function get_receipt_master($customer_id,$date_start = null,$date_end = null) {
        $this->db->where('receipt_master.customer_id', $customer_id);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_order_id', 2);
        $this->db->where('receipt_master.type_receipt_id', 3);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1); 
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        $this->db->order_by('receipt_master.receipt_master_id','DESC');
        return $this->db->get('receipt_master');
    }
    
    public function get_customer() {
        $this->db->where('customer_id_pri', $this->session->userdata('user_id'));
        return $this->db->get('customer');
    }
    
    public function ref_status_transfer($id = null) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('status_transfer_id', $id);
        }
        return $this->db->get('ref_status_transfer');
    }
    
    
}
