<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Purchase_model
 *
 * @author Prasan Srisopa
 */
class Invoicesub_model extends CI_Model {

    //put your code here
    public function get_sale_from() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_receipt_master($status_pay_id) {
        $this->db->select('*');
        $this->db->join('ref_status_receipt_order', 'receipt_master.status_receipt_order_id = ref_status_receipt_order.status_receipt_order_id');
        $this->db->join('ref_status_pay', 'receipt_master.status_pay_id = ref_status_pay.status_pay_id');
        $this->db->join('ref_status_transfer', 'receipt_master.status_transfer_id = ref_status_transfer.status_transfer_id');
        $this->db->join('shop', 'receipt_master.shop_id_pri = shop.shop_id_pri');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.type_receipt_id', 5);
        if ($status_pay_id == 1) {
            $this->db->where('receipt_master.status_transfer_id', 1);
        }
        $this->db->order_by('receipt_master.date_receipt', 'DESC');
        $this->db->order_by('receipt_master.date_modify', 'DESC');
        return $this->db->get('receipt_master');
    }

    public function get_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->order_by('receipt_detail_id');
        return $this->db->get('receipt_detail');
    }

    public function get_receipt_master_by_id($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

    public function get_receipt_master_detail($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_detail');
    }

    public function get_receipt_cancel($receipt_master_id_pri, $shop_id) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->where('receipt_master.confirm_order_id', 1);
        $this->db->where('receipt_master.refer', $shop_id);
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->order_by('bank_id', 'ASC');
        return $this->db->get('bank');
    }

    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }

}
