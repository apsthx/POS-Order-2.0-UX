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
class Sell_model extends CI_Model {

    //put your code here

    public function get_type_tax() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_product($product_id = null) {
        $this->db->select('product.product_id_pri,  
                            product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_sale_price,
                            product.product_amount,
                            product.status_product_id');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('product.status_product_id', 1);
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('product.product_id');
        return $this->db->get('map_product_stock');
    }

    public function get_product_by_category($product_category_id = null) {
        $this->db->select('product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_sale_price,
                            product.status_product_id');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('product.status_product_id', 1);
        if ($product_category_id != NULL) {
            $this->db->where('product.product_category_id', $product_category_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('product.product_id');
        return $this->db->get('map_product_stock');
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

    public function get_stock($product_id = null) {
        $this->db->select('stock.stock_id_pri, map_product_stock.map_product_amount');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('map_product_stock.map_product_amount >', 0);
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('map_product_stock.map_product_amount', 'DESC');
        return $this->db->get('map_product_stock');
    }

    public function get_product_category() {
        $this->db->select('product_category_id,
                            product_category_name');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('product_category_name');
        return $this->db->get('product_category');
    }

    public function check_receipt_master_id($receipt_master_id) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id', $receipt_master_id);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('receipt_master');
    }

    public function map_stock_update($data) {
        $this->db->where('map_product_stock.stock_id_pri', $data['stock_id_pri']);
        $this->db->where('map_product_stock.product_id_pri', $data['product_id_pri']);
        $this->db->update('map_product_stock', $data);
    }

    public function product_update($data) {
        $this->db->where('product.product_id_pri', $data['product_id_pri']);
        $this->db->update('product', $data);
    }

    public function get_bank() {
        $this->db->select('*');
        $this->db->where('type_bank_id', 1);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('bank');
    }

    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }

}
