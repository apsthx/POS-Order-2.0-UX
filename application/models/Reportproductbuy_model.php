<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportproductbuy_model
 *
 * @Prasan Srisopa
 */
class Reportproductbuy_model extends CI_Model{
  
    public function hit_product($date_start = null,$date_end = null,$search = null) {
        $this->db->select('receipt_detail.product_id,
                        receipt_detail.product_name, 
                        receipt_detail.product_unit,
                        product.product_brand,
                        product.product_gen,
                        SUM(receipt_detail.product_amount) AS product_amount,SUM(receipt_detail.product_price_sum) AS product_price_sum');
        $this->db->join('receipt_master', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->join('product', 'product.product_id = receipt_detail.product_id');
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if($date_start != null){
            $this->db->where('receipt_master.date_pay >=', $date_start);     
        }
        if($date_end != null){
            $this->db->where('receipt_master.date_pay <=', $date_end);     
        }
        if ($search != null) {
            $this->db->where(" (
                product.product_name LIKE '%$search%'
                or product.product_brand LIKE '%$search%' 
                or product.product_gen LIKE '%$search%' 
           ) ");
        }
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->group_by('receipt_detail.product_unit');
        $this->db->group_by('product.product_brand');
        $this->db->group_by('product.product_gen');
        $this->db->order_by('SUM(receipt_detail.product_amount)','DESC');
        return $this->db->get('receipt_detail');
    }
}
