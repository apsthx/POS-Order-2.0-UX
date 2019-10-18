<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shop_model
 *
 * @author Prasan Srisopa
 */
class Receiptdetail_model extends CI_Model {

    //put your code here
    public function get_sale_from() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_type_tax() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_receipt_master_byId($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->join('sale_from', 'receipt_master.sale_from_id = sale_from.sale_from_id');
        $this->db->join('ref_type_tax', 'receipt_master.type_tax_id = ref_type_tax.type_tax_id');
        $this->db->join('ref_type_receipt', 'receipt_master.type_receipt_id = ref_type_receipt.type_receipt_id');
        $this->db->join('ref_status_transfer', 'receipt_master.status_transfer_id = ref_status_transfer.status_transfer_id');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
//        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('receipt_master.receipt_master_id_pri', 'DESC');
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

    public function get_receipt_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_detail.receipt_master_id_pri', $receipt_master_id_pri);
        return $this->db->get('receipt_detail');
    }
    
    public function get_group_customer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('customer', 'customer.customer_group_id = customer_group.customer_group_id');
        if ($id != NULL) {
            $this->db->where('customer.customer_id', $id);
        }
        return $this->db->get('customer_group');
    }

}
