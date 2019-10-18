<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportinvoicesub_model
 *
 * @author Prasan Srisopa
 */
class Reportinvoicesub_model extends CI_Model{
    //put your code here
    public function receipt_year($shop_id) {
        $this->db->select('YEAR(receipt_master.date_receipt) AS year_pay');
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.date_receipt !=', '');
        $this->db->group_by('YEAR(receipt_master.date_receipt)');
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_all($shop_id) {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_day($dateday,$shop_id) {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.date_receipt', $dateday);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_month($datemonth,$shop_id) {
        $datedaystart = date("$datemonth-01");
        $datedayend = date("$datemonth-31");
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.date_receipt >=', $datedaystart);
        $this->db->where('receipt_master.date_receipt <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_year($dateyear,$shop_id) {
        $datedaystart = date("$dateyear-01-01");
        $datedayend = date("$dateyear-12-31");
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.date_receipt >=', $datedaystart);
        $this->db->where('receipt_master.date_receipt <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_dateday($datedaystart,$datedayend,$shop_id) {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.date_receipt >=', $datedaystart);
        $this->db->where('receipt_master.date_receipt <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function ref_status_pay($status_pay_id) {
        $this->db->where('status_pay_id', $status_pay_id);
        return $this->db->get('ref_status_pay');
    }
    
    public function ref_status_transfer($status_transfer_id) {
        $this->db->where('status_transfer_id', $status_transfer_id);
        return $this->db->get('ref_status_transfer');
    }
    
    public function ref_status_receipt_order($status_receipt_order_id) {
        $this->db->where('status_receipt_order_id', $status_receipt_order_id);
        return $this->db->get('ref_status_receipt_order');
    }
}
