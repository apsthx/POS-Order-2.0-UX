<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sticker_model
 *
 * @author Prasan Srisopa
 */
class Sticker_model extends CI_Model{
    //put your code here
    public function get_sticker() {
        $this->db->select('*');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('product.status_product_id', 1);
        $this->db->order_by('product.product_id');
        return $this->db->get('product');
    }
    
    public function get_product($id) {
        $this->db->select('*');
        $this->db->where('product_id_pri',$id);
        return $this->db->get('product');
    }
}
