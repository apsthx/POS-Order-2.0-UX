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
class Stock_model extends CI_Model {

    //put your code here
    public function get_stock($id = null) {
        $this->db->select('*');
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('stock.stock_id_pri', $id);
        }
        $this->db->order_by('stock.stock_id_pri', 'DESC');
        return $this->db->get('stock');
    }

    public function get_product_stock($id = null) {
        $this->db->select('map_product_stock.map_product_stock_id,
                            map_product_stock.stock_id_pri,
                            product.product_id_pri,
                            product.product_id,
                            product.product_category_id,
                            product_category.product_category_name,
                            product.product_name,
                            product.product_amount,
                            map_product_stock.map_product_amount');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        if ($id != NULL) {
            $this->db->where('map_product_stock.stock_id_pri', $id);
        }
        $this->db->order_by('map_product_stock.map_product_stock_id', 'DESC');
        return $this->db->get('map_product_stock');
    }

    public function get_product_category() {
        $this->db->select('product_category_id,
                            product_category_name');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('product_category_name');
        return $this->db->get('product_category');
    }

    public function get_product($product_category_id) {
        $this->db->select('product.product_id_pri,
                            product.product_id,
                            product.product_name,
                            product.product_unit,
                            product.product_amount,');
        $this->db->where('product.product_category_id', $product_category_id);
        $this->db->order_by('product.product_id_pri', 'DESC');
        return $this->db->get('product');
    }

    public function amount_can_add($product_id_pri, $product_amount) {
        $this->db->select('SUM(map_product_stock.map_product_amount) AS sum');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('map_product_stock.product_id_pri', $product_id_pri);
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $sum = $this->db->get('map_product_stock')->row()->sum;
        return $product_amount - $sum;
    }

    public function count_product_in_stock($stock_id_pri, $product_id_pri) {
        $this->db->select('map_product_stock.stock_id_pri');
        $this->db->where('map_product_stock.stock_id_pri', $stock_id_pri);
        $this->db->where('map_product_stock.product_id_pri', $product_id_pri);
        return $this->db->count_all_results('map_product_stock');
    }

    public function sum_product_in_stock($stock_id_pri, $product_id_pri = null) {
        $this->db->select('SUM(map_product_stock.map_product_amount) AS sum');
        $this->db->where('map_product_stock.stock_id_pri', $stock_id_pri);
        if ($product_id_pri != NULL) {
            $this->db->where('map_product_stock.product_id_pri', $product_id_pri);
        }
        return $this->db->get('map_product_stock')->row()->sum;
    }

    public function check_stock_id($stock_id = null) {
        $this->db->select('stock_id');
        $this->db->where('stock_id', $stock_id);
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('stock');
    }

    public function update_stock($data) {
        $this->db->where('stock_id_pri', $data['stock_id_pri']);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('stock', $data);
    }

    public function update_map($data) {
        $this->db->where('stock_id_pri', $data['stock_id_pri']);
        $this->db->where('product_id_pri', $data['product_id_pri']);
        $this->db->update('map_product_stock', $data);
    }

    public function count_in_map($stock_id_pri = null) {
        $this->db->select('stock_id_pri');
        $this->db->where('stock_id_pri', $stock_id_pri);
        $this->db->limit(1);
        return $this->db->count_all_results('map_product_stock');
    }

    public function delete_stock($stock_id_pri) {
        $this->db->where('stock_id_pri', $stock_id_pri);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->delete('stock');
    }

    public function delete_product_in_stock($map_product_stock_id) {
        $this->db->where('map_product_stock_id', $map_product_stock_id);
        $this->db->delete('map_product_stock');
    }

}
