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
class Documentsetting_model extends CI_Model {

    //put your code here
    public function get_data() {
        $this->db->select('*');
        $this->db->join('image', 'image.image_id = shop_setting_document.image_id', 'left');
        $this->db->where('shop_setting_document.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('shop_setting_document');
    }

    public function update_setting($data) {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('shop_setting_document', $data);
    }

    public function check_product_id($product_id = null) {
        $this->db->select('product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('product');
    }

    public function update_category($data) {
        $this->db->where('product_category_id', $data['product_category_id']);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('product_category', $data);
    }

    public function count_in_category($product_category_id = null) {
        $this->db->select('product_category_id');
        $this->db->where('product_category_id', $product_category_id);
        $this->db->limit(1);
        return $this->db->count_all_results('product');
    }

    public function delete_category($product_category_id) {
        $this->db->where('product_category_id', $product_category_id);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->delete('product_category');
    }
    
    public function get_data_shop() {
        $this->db->where('shop.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('shop')->row()->shop_id;
    }

}
