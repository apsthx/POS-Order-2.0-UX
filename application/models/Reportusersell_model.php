<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportusersell_model
 *
 * @Prasan Srisopa
 */
class Reportusersell_model extends CI_Model{
    
    public function get_user($user_id = null) {
        $this->db->where('user.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if($user_id != null){
            $this->db->where('user_id', $user_id);     
        }
        return $this->db->get('user');
    }
    
     public function get_role($role_id = null) {
        if($role_id != null){
            $this->db->where('role_id', $role_id);     
        }
        return $this->db->get('role');
    }
    
    public function get_receipt_master($date_start = null,$date_end = null,$user_id = null) {
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay,
            receipt_master.user_id');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        if($user_id != null){
            $this->db->where('receipt_master.user_id', $user_id);     
        }
        $this->db->group_by('receipt_master.user_id');
        $this->db->order_by('Sum(receipt_master.price_sum_pay)','DESC');
        return $this->db->get('receipt_master');
    }
}
