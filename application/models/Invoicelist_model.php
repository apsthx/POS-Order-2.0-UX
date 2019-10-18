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
class Invoicelist_model extends CI_Model {

    //put your code here
    public function get_receipt_master($status_transfer_id, $shop_id) {
        $this->db->select('*');
        $this->db->join('ref_status_pay', 'receipt_master.status_pay_id = ref_status_pay.status_pay_id');
        $this->db->join('ref_status_transfer', 'receipt_master.status_transfer_id = ref_status_transfer.status_transfer_id');
        $this->db->join('ref_status_receipt_order', 'receipt_master.status_receipt_order_id = ref_status_receipt_order.status_receipt_order_id');
        $this->db->join('shop', 'receipt_master.shop_id_pri = shop.shop_id_pri');
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.type_receipt_id', 5);
        if ($status_transfer_id == 1) {
            $this->db->where_in('receipt_master.status_pay_id', array(2, 3, 4));
        }
        $this->db->order_by('receipt_master.date_receipt', 'DESC');
        $this->db->order_by('receipt_master.date_modify', 'DESC');
        return $this->db->get('receipt_master');
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

    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        return $this->db->get('bank');
    }

    public function get_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->order_by('receipt_detail_id');
        return $this->db->get('receipt_detail');
    }

    public function get_product_by_id($product_id = null) {
        $this->db->select('product.product_id_pri,  
                            product.product_amount');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('product');
    }

    public function edit($id, $data) {
        $this->db->where('receipt_master_id_pri', $id);
        $this->db->update('receipt_master', $data);
    }

    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }

}
