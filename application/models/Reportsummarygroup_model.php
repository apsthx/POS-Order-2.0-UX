<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportsummarygroup_model
 *
 * @author Prasan Srisopa
 */
class Reportsummarygroup_model extends CI_Model {

    //put your code here
    public function get_user() {
        $this->db->where('user.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('user');
    }

//    public function get_product_category() {
//        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
//        return $this->db->get('product_category');
//    }

    public function get_customer_group() {
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('customer_group');
    }

    public function get_receipt_master($date_start = null, $date_end = null, $user_id = null, $customer_group_id = null) {
        $this->db->select('user.fullname,
                role.role_name,
                customer_group.customer_group_name,
                Sum(receipt_master.price_sum_pay) AS price_sum_pay');
        $this->db->join('user', 'receipt_master.user_id = `user`.user_id');
        $this->db->join('role', 'user.role_id = role.role_id');
        $this->db->join('customer', 'receipt_master.customer_id = customer.customer_id');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('user.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where_in('receipt_master.type_receipt_id', array(1, 3));
        $this->db->where('receipt_master.status_pay_id', 1);
        if ($date_start != null) {
            $this->db->where('receipt_master.date_pay >=', $date_start);
        }
        if ($date_end != null) {
            $this->db->where('receipt_master.date_pay <=', $date_end);
        }
        if ($user_id != null) {
            $this->db->where('receipt_master.user_id', $user_id);
        }
        if ($customer_group_id != null) {
            $this->db->where('customer_group.customer_group_id', $customer_group_id);
        }
        $this->db->group_by('receipt_master.user_id');
        $this->db->group_by('customer_group.customer_group_id');
        $this->db->order_by('receipt_master.user_id', 'ASC');
        $this->db->order_by('customer_group.customer_group_id', 'ASC');
        return $this->db->get('receipt_master');
    }

}
