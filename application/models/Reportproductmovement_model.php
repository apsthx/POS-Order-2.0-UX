<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportproductmovement_model
 *
 * @Prasan Srisopa
 */
class Reportproductmovement_model extends CI_Model{
    
    public function product($search = null) {
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        if ($search != null) {
            $this->db->where(" (
                product.product_name LIKE '%$search%'
                or product.product_brand LIKE '%$search%' 
                or product.product_gen LIKE '%$search%' 
           ) ");
        }
        $this->db->where('product.status_product_id', 1);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('product.product_id');
        return $this->db->get('product');
    }
    
    //แม่เข้า 1
    public function in_product($product_id ,$date_start = null) {
        $this->db->select('SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_detail.product_id', $product_id);
        if($date_start != null){
            $this->db->where('receipt_master.date_transfer <', $date_start);     
        }
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->group_by('receipt_detail.product_unit');
        $this->db->order_by('receipt_detail.product_id');
        return $this->db->get('receipt_master');
    }
    //แม่ออก 1
    public function out_product($product_id ,$date_start = null) {
        $this->db->select('SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 2);
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_detail.product_id', $product_id);
        if($date_start != null){
            $this->db->where('receipt_master.date_transfer <', $date_start);     
        }
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->group_by('receipt_detail.product_unit');
        $this->db->order_by('receipt_detail.product_id');
        return $this->db->get('receipt_master');
    }
    
    //แม่เข้า 2
    public function product_in($product_id ,$date_start = null,$date_end = null) {
        $this->db->select('SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 3);
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_detail.product_id', $product_id);
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->group_by('receipt_detail.product_unit');
        $this->db->order_by('receipt_detail.product_id');
        return $this->db->get('receipt_master');
    }
    
    //แม่ออก 3
    public function product_out($product_id ,$date_start = null,$date_end = null) {
        $this->db->select('SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->join('receipt_detail', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_transfer_id', 2);
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_detail.product_id', $product_id);
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->group_by('receipt_detail.product_unit');
        $this->db->order_by('receipt_detail.product_id');
        return $this->db->get('receipt_master');
    }
}
