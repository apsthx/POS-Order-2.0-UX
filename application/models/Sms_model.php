<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sms_model
 *
 * @author Prasan Srisopa
 */
class Sms_model extends CI_Model {

    //put your code here
    public function get_sms($id = null, $shop_id_pri = null) {
        $this->db->select('*');
        $this->db->join('shop', 'setting_sms.shop_id_pri = shop.shop_id_pri');
        if ($shop_id_pri != NULL) {
            $this->db->where('setting_sms.shop_id_pri', $shop_id_pri);
        }
        if ($id != NULL) {
            $this->db->where('setting_sms.setting_sms_id', $id);
        }
        $this->db->order_by('setting_sms_id');
        return $this->db->get('setting_sms');
    }

    public function get_receipt_master_id($id) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_master');
    }

    public function edit($id, $data) {
        $this->db->where('setting_sms.setting_sms_id', $id);
        $this->db->update('setting_sms', $data);
    }

    public function get_head_sms($id = null) {
        if ($id != NULL) {
            $this->db->where('head_sms_id', $id);
        }
        return $this->db->get('head_sms');
    }

    public function get_sms_email() {
        $this->db->join('customer', 'advt.customer_id_pri = customer.customer_id_pri');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('advt.date_modify','desc');
        return $this->db->get('advt');
    }

    public function getText($term) {
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        //$this->db->where('customer_group.shop_id_pri =', $this->session->userdata('shop_id_pri'));
        $this->db->where("customer.status_id = 1 AND customer_group.shop_id_pri = ".$this->session->userdata('shop_id_pri')." AND ( customer.customer_id LIKE '%$term%' OR customer.fullname LIKE '%$term%' OR customer.tel LIKE '%$term%')");    
        $this->db->order_by('customer.customer_id');
        return $this->db->get('customer');
    }

    public function get_groupcustomer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('customer_group_id', $id);
        }
        $this->db->order_by('customer_group_id');
        return $this->db->get('customer_group');
    }

    public function get_customer($id = null) {
        $this->db->where('customer_id_pri', $id);
        $this->db->where('customer.status_id', 1);
        return $this->db->get('customer');
    }

    public function get_group_customer($id, $date_start = null, $date_end = null) {
        $this->db->select('*');
        $this->db->join('customer', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('customer.status_id', 1);
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
    
    public function get_tel($username) {
        $this->db->select('tel');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->get('user')->row()->tel;
    }
    
    public function edituser($username, $data) {
        $this->db->where('username', $username);
        $this->db->update('user', $data);
    }

}
