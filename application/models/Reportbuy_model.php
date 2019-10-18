<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportbuy_model
 *
 * @Prasan Srisopa
 */
class Reportbuy_model extends CI_Model{
    //put your code here
    public function receipt_year() {
        $this->db->select('YEAR(receipt_master.date_receipt) AS year_pay');
        $this->db->where('receipt_master.type_receipt_id',4);
        $this->db->where('receipt_master.status_receipt_id', 1);    
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_receipt !=', '');
        $this->db->group_by('YEAR(receipt_master.date_receipt)');
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_all() {
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);       
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_day($dateday) {
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);        
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_receipt', $dateday);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_month($datemonth) {
        $datedaystart = date("$datemonth-01");
        $datedayend = date("$datemonth-31");
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);    
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_receipt >=', $datedaystart);
        $this->db->where('receipt_master.date_receipt <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_year($dateyear) {
        $datedaystart = date("$dateyear-01-01");
        $datedayend = date("$dateyear-12-31");
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_receipt >=', $datedaystart);
        $this->db->where('receipt_master.date_receipt <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_dateday($datedaystart,$datedayend) {
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
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
    
}
