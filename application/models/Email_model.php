<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email_model
 *
 * @author Prasan Srisopa
 */
class Email_model extends CI_Model{
    //put your code here
    public function get_customer($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('customer_id_pri', $id);
        }
        $this->db->order_by('customer_id_pri');
        return $this->db->get('customer');
    }
    
    public function get_setting_email() {
        return $this->db->get('setting_email')->row();
    }
    
    public function edit($data) {
        $this->db->update('setting_email', $data);
    }

    public function get_group_customer($id, $date_start = null, $date_end = null) {
        $this->db->select('*');
        $this->db->join('customer', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != 0) {
            $this->db->where('customer_group.customer_group_id', $id);
        }
        if ($date_start != null) {
            $this->db->where('customer.date_create >=', $date_start);
        }
        if ($date_end != null) {
            $this->db->where('customer.date_create <=', $date_end);
        }
        return $this->db->get('customer_group');
    }
    
    public function addadvt($data) {
        $this->db->insert('advt', $data);
    }
    
}
