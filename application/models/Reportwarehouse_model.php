<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportwarehouse_model
 *
 * @Prasan Srisopa
 */
class Reportwarehouse_model extends CI_Model{
    //put your code here
    
    public function get_stock($stock_id_pri = null) {
        if($stock_id_pri != null){
            $this->db->where('stock_id_pri', $stock_id_pri);     
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('stock_id_pri');
        return $this->db->get('stock');
    }
    
    public function get_map_product_stock($stock_id_pri = null) {
        if($stock_id_pri != null){
            $this->db->where('stock_id_pri', $stock_id_pri);     
        }
        return $this->db->get('map_product_stock');
    }   
    
    public function get_stock_amount($stock_id_pri = null,$product_id_pri = null) {
        $this->db->select('Sum(map_product_amount) AS stock_amount');
        if($stock_id_pri != null){
            $this->db->where('stock_id_pri', $stock_id_pri);     
        }
        if($product_id_pri != null){
            $this->db->where('product_id_pri', $product_id_pri);     
        }
        $this->db->group_by('stock_id_pri');
        return $this->db->get('map_product_stock');
    }   
    
    public function get_product($product_id_pri = null) {
        if($product_id_pri != null){
            $this->db->where('product_id_pri', $product_id_pri);     
        }
        return $this->db->get('product');
    }
}
