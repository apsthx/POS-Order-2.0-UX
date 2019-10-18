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
class Ordersub_model extends CI_Model {

    //put your code here
    public function get_receipt_master($confirm_order_id, $shop_id) {
        $this->db->select('*');
        $this->db->join('ref_confirm_order', 'ref_confirm_order.confirm_order_id = receipt_master.confirm_order_id');
        $this->db->join('shop', 'receipt_master.shop_id_pri = shop.shop_id_pri');
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.status_receipt_id', 1);
        if ($confirm_order_id == 2) {
            $this->db->where('receipt_master.confirm_order_id', 1);
        }
        $this->db->order_by('receipt_master.date_receipt', 'DESC');
        $this->db->order_by('receipt_master.date_modify', 'DESC');
        return $this->db->get('receipt_master');
    }

    public function get_receipt_master_detail($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_detail');
    }

    public function sum_in_stock($product_id = null) {
        $this->db->select('SUM(map_product_amount) AS sum');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('map_product_stock');
    }

    public function get_receipt_cancel($receipt_master_id_pri, $shop_id) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->where('receipt_master.confirm_order_id', 1);
        $this->db->where('receipt_master.refer', $shop_id);
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

}
