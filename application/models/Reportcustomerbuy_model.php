<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportcustomerbuy_model
 *
 * @Prasan Srisopa
 */
class Reportcustomerbuy_model extends CI_Model{
    //put your code here
    public function get_customer($customer_id = null) {
        $this->db->join('customer_group', 'customer_group.customer_group_id = customer.customer_group_id');
        $this->db->where('customer.status_id', 1);
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if($customer_id != null){
            $this->db->where('customer.customer_id', $customer_id);     
        }
        return $this->db->get('customer');
    }
    
    public function get_receipt_master($date_start = null,$date_end = null,$customer_id = null) {
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay,
            receipt_master.customer_id,
            receipt_master.customer_name');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        if($customer_id != null){
            $this->db->where('receipt_master.customer_id', $customer_id);     
        }
        $this->db->group_by('receipt_master.customer_id');
        $this->db->order_by('Sum(receipt_master.price_sum_pay)','DESC');
        return $this->db->get('receipt_master');
    }
}
