<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportsummaryproduct_model
 *
 * @author Prasan Srisopa
 */
class Reportsummaryproduct_model extends CI_Model{
    //put your code here
    public function receipt_year() {
        $this->db->select('YEAR(receipt_master.date_pay) AS year_pay');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay !=', '');
        $this->db->group_by('YEAR(receipt_master.date_pay)');
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_all() {
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_day($dateday) {
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay', $dateday);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_month($datemonth) {
        $datedaystart = date("$datemonth-01");
        $datedayend = date("$datemonth-31");
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $datedaystart);
        $this->db->where('receipt_master.date_pay <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_year($dateyear) {
        $datedaystart = date("$dateyear-01-01");
        $datedayend = date("$dateyear-12-31");
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $datedaystart);
        $this->db->where('receipt_master.date_pay <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_dateday($datedaystart,$datedayend) {
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $datedaystart);
        $this->db->where('receipt_master.date_pay <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
     public function get_customer_group($customer_id, $customer_group_id = null) {
        $this->db->select('customer_group.customer_group_name');
        $this->db->where('customer.customer_id', $customer_id);
        if ($customer_group_id != null) {
            $this->db->where('customer.customer_group_id', $customer_group_id);
        }
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        return $this->db->get('customer');
    }

    public function ref_customer_group() {
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('customer_group');
    }
}
