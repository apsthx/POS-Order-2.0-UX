<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporttransport_model
 *
 * @author Prasan Srisopa
 */
class Reporttransport_model extends CI_Model{
    //put your code here
    public function receipt_year() {
        $this->db->select('YEAR(receipt_master.date_transfer) AS year_pay');
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_transfer !=', '');
        $this->db->group_by('YEAR(receipt_master.date_transfer)');
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_all() {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_day($dateday) {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_transfer', $dateday);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_month($datemonth) {
        $datedaystart = date("$datemonth-01");
        $datedayend = date("$datemonth-31");
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_transfer >=', $datedaystart);
        $this->db->where('receipt_master.date_transfer <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_year($dateyear) {
        $datedaystart = date("$dateyear-01-01");
        $datedayend = date("$dateyear-12-31");
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_transfer >=', $datedaystart);
        $this->db->where('receipt_master.date_transfer <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_receipt_master_dateday($datedaystart,$datedayend) {
        $this->db->where('receipt_master.type_receipt_id', 5);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_transfer >=', $datedaystart);
        $this->db->where('receipt_master.date_transfer <=', $datedayend);
        return $this->db->get('receipt_master');
    }
    
    public function get_product_amount($receipt_master_id_pri) {
        $this->db->select('SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->where('receipt_detail.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->group_by('receipt_detail.receipt_master_id_pri');
        return $this->db->get('receipt_detail');
    }
 
}
