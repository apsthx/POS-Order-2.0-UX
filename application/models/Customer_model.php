<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer_model
 *
 * @author Prasan Srisopa
 */
class Customer_model extends CI_Model {

    //put your code here
    public function get_customer($customer_group_id, $status_id, $id = null) {
        $this->db->select('*');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->join('ref_status', 'customer.status_id = ref_status.status_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('customer_id_pri', $id);
        }
        if ($status_id == 1) {
            $this->db->where('customer.status_id', 1);
        }
        if ($customer_group_id != 0) {
            $this->db->where('customer_group.customer_group_id',$customer_group_id);
        }
        $this->db->order_by('customer_id_pri','DESC');
        return $this->db->get('customer');
    }

    public function checkcustomer($customer_id) {
        $this->db->from('customer');
        $this->db->where('customer.customer_id', $customer_id);
        return $this->db->count_all_results();
    }

    public function add($data) {
        $this->db->insert('customer', $data);
        return $this->db->insert_id();
    }

    public function edit($id, $data) {
        $this->db->where('customer.customer_id_pri', $id);
        $this->db->update('customer', $data);
    }

    public function get_groupcustomer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('ref_type_save', 'ref_type_save.type_save_id = customer_group.type_save_id');
        if ($id != NULL) {
            $this->db->where('customer_group_id', $id);
        }
        $this->db->order_by('customer_group_id');
        return $this->db->get('customer_group');
    }

    public function get_maxcustomer() {
        $this->db->select('MAX(customer.customer_id_pri) AS MAX');
        $MAX = $this->db->get('customer')->row()->MAX;
        if ($MAX == null) {
            return 0;
        } else {
            return $MAX;
        }
    }
    
    public function check_id($id = null) {
        if ($id != NULL) {
            $this->db->where('customer_id', $id);
        }
        return $this->db->get('customer');
    }   
    
    public function get_shop_setting_document($id = null) {
        if ($id != NULL) {
            $this->db->where('shop_setting_document.shop_id_pri', $id);
        }
        return $this->db->get('shop_setting_document');
    }
    
    public function transport($customer_id,$datestart = null,$dateend = null) {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 3);
        $this->db->where('status_transfer_id', 2);
        if($datestart != null){
            $this->db->where('receipt_master.date_transfer >=', $datestart);     
        }
        if($dateend != null){
            $this->db->where('receipt_master.date_transfer <=', $dateend);     
        }
        $this->db->order_by('receipt_master_id_pri','DESC');
        return $this->db->get('receipt_master');
    }
    
    public function bill($customer_id,$datestart = null,$dateend = null) {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 3);
        //$this->db->where('status_transfer_id', 1);
        if($datestart != null){
            $this->db->where('receipt_master.date_pay >=', $datestart);     
        }
        if($dateend != null){
            $this->db->where('receipt_master.date_pay <=', $dateend);     
        }
        $this->db->order_by('receipt_master_id_pri','DESC');
        return $this->db->get('receipt_master');
    }
    
    public function order($customer_id,$datestart = null,$dateend = null) {
        $this->db->where('customer_id', $customer_id);
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 2);
        $this->db->where('status_receipt_order_id', 1);
        if($datestart != null){
            $this->db->where('receipt_master.date_receipt >=', $datestart);     
        }
        if($dateend != null){
            $this->db->where('receipt_master.date_receipt <=', $dateend);     
        }
        $this->db->order_by('receipt_master_id_pri','DESC');
        return $this->db->get('receipt_master');
    }
    
    
}
