<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logreceipt1_model
 *
 * @Prasan Srisopa
 */
class Logreceipt1_model extends CI_Model {

    //put your code here
    public function logreceipt() {
        $this->db->join('receipt_master', 'log_receipt.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('log_receipt.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.type_receipt_id', 1);
        $this->db->order_by('log_receipt.date_modify','DESC');
        return $this->db->get('log_receipt');
    }
}
