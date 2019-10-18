<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product_model
 *
 * @author nut
 */
class Api_model extends CI_Model {

    //put your code here
    public function getproductcategory($shop_id_pri = null) {
        $this->db->select('product_category.product_category_id AS category_id');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->where('product_category.shop_id_pri', $shop_id_pri);
        $this->db->order_by('product_category.product_category_name');
        return $this->db->get('product_category');
    }

    public function getproduct($shop_id_pri = null,$limit) {
        $this->db->select('product.product_id_pri');
        $this->db->select('product.product_id');
        $this->db->select('product.product_name');
        $this->db->select('product.product_sale_price');
        $this->db->select('image.image_name');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->join('product', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->where('product_category.shop_id_pri', $shop_id_pri);
        $this->db->order_by('product_category.product_category_name');
        $this->db->order_by('product.product_name');
        $this->db->limit($limit);
        return $this->db->get('product_category');
    }
    
    public function countproduct($shop_id_pri = null) {
        $this->db->select('product.product_id_pri');
        $this->db->select('product.product_id');
        $this->db->select('product.product_name');
        $this->db->select('product.product_sale_price');
        $this->db->select('image.image_name');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->join('product', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->where('product_category.shop_id_pri', $shop_id_pri);
        $this->db->order_by('product_category.product_category_name');
        $this->db->order_by('product.product_name');
        return $this->db->get('product_category')->num_rows();
    }
    
    public function getproductfilter($shop_id_pri = null, $search = null, $category_id = array()) {
        $this->db->select('product.product_id_pri');
        $this->db->select('product.product_id');
        $this->db->select('product.product_name');
        $this->db->select('product.product_sale_price');
        $this->db->select('image.image_name');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->join('product', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->where('product_category.shop_id_pri', $shop_id_pri);
        if ($search != '') {
            $this->db->where("product.product_name LIKE '%$search%'");
        }
        if (!empty($category_id)) {
            $this->db->where_in('product_category.product_category_id', $category_id);
        }else{
            $this->db->where('product_category.product_category_id', 0);
        }
        $this->db->order_by('product_category.product_category_name');
        $this->db->order_by('product.product_name');
        return $this->db->get('product_category');
    }
    
    public function countproductfilter($shop_id_pri = null, $search = null, $category_id = array()) {
        $this->db->select('product.product_id_pri');
        $this->db->select('product.product_id');
        $this->db->select('product.product_name');
        $this->db->select('product.product_sale_price');
        $this->db->select('image.image_name');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->join('product', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->where('product_category.shop_id_pri', $shop_id_pri);
        if ($search != '') {
            $this->db->where("product.product_name LIKE '%$search%'");
        }
        if (!empty($category_id)) {
            $this->db->where_in('product_category.product_category_id', $category_id);
        }else{
            $this->db->where('product_category.product_category_id', 0);
        }
        $this->db->order_by('product_category.product_category_name');
        $this->db->order_by('product.product_name');
        return $this->db->get('product_category')->nun_rows();
    }

    public function getshop($token = null) {
        $this->db->where('shop.token', $token);
        $this->db->where('shop.status_shop_id', 1);
        $this->db->where('shop.token_status', 1);
        $this->db->limit(1);
        return $this->db->get('shop');
    }

    public function getcustomergroup($shop_id_pri = null,$customer_group_id = null) {
        $this->db->where('customer_group.shop_id_pri', $shop_id_pri);
        $this->db->where('customer_group.customer_group_id', $customer_group_id);
        $this->db->limit(1);
        return $this->db->get('customer_group');
    }
    
    public function getuser($shop_id_pri = null,$user_id = null) {
        $this->db->where('user.shop_id_pri', $shop_id_pri);
        $this->db->where('user.user_id', $user_id);
        $this->db->where('user.type_user_id', 1);
        $this->db->limit(1);
        return $this->db->get('user');
    }
    
    public function getproductproperties($product_id_pri = null) {
        $this->db->select('product.product_id_pri');
        $this->db->select('product.product_id');
        $this->db->select('product.product_name');
        $this->db->select('product.product_brand');
        $this->db->select('product.product_gen');
        $this->db->select('product.product_unit');
        $this->db->select('product.product_sale_price');
        $this->db->select('product.product_weight');     
        $this->db->select('image.image_name');
        $this->db->select('product_properties.product_properties_name AS properties_name');
        $this->db->select('product_properties.product_properties_value AS properties_value');
        $this->db->select('product_category.product_category_name AS category_name');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('product_properties', 'product_properties.product_id_pri = product.product_id_pri', 'LEFT');
        if ($product_id_pri != null) {
            $this->db->where('product.product_id_pri', $product_id_pri);
        }
        return $this->db->get('product');
    }

    public function get_document_setting($shop_id_pri) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->limit(1);
        return $this->db->get('shop_setting_document')->row();
    }

    public function update_document_setting($data, $shop_id_pri) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->update('shop_setting_document', $data);
    }

    public function log_receipt($receipt_master_id_pri, $action_text, $shop_id_pri) {
        $data = array(
            'action_text' => $action_text,
            'receipt_master_id_pri' => $receipt_master_id_pri,
            'shop_id_pri' => $shop_id_pri,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_receipt', $data);
    }

    public function get_transport_setting($shop_id_pri) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->limit(1);
        return $this->db->get('transport_setting')->row()->transport_price;
    }
}
