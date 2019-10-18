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
class Invoice_model extends CI_Model {

    //put your code here
    //put your code here
    public function get_sale_from() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_type_tax() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_product($product_id = null) {
        $this->db->select('product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_sale_price,
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

    public function get_receipt_master($receipt_master_id_pri, $shop_id) {
        $this->db->select('*');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->where('receipt_master.customer_id', $shop_id);
        $this->db->where('receipt_master.confirm_order_id', 1);
        $this->db->where('receipt_master.type_receipt_id', 4);
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

    public function get_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->order_by('receipt_detail_id');
        return $this->db->get('receipt_detail');
    }

    public function get_customer($customer_group_id = null) {
        $this->db->select('customer.customer_id,
                            customer_group.customer_group_save,
                            customer_group.type_save_id,
                            customer.fullname,
                            customer.email,
                            customer.tel,
                            customer.address,
                            customer.tax_id,
                            customer.tax_shop,
                            customer.tax_shop_sub,
                            customer.tax_address');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        if ($customer_group_id != null) {
            $this->db->where('customer.customer_group_id', $customer_group_id);
        }
        $this->db->where('customer.status_id', 1);
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('customer.customer_id');
        return $this->db->get('customer');
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

    public function get_product_by_category_all($product_category_id = null) {
        $this->db->select('product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_buy_price,
                            product.product_sale_price,
                            product.status_product_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        if ($product_category_id != NULL) {
            $this->db->where('product_category.product_category_id', $product_category_id);
        }
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('product.product_id');
        return $this->db->get('product');
    }

    public function get_product_category() {
        $this->db->select('product_category_id,
        product_category_name');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('product_category_name');
        return $this->db->get('product_category');
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

    public function getText_Product_id($product_id) {
        $this->db->select('product.product_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->like("product.product_id", $product_id);
        return $this->db->get('product');
    }

    public function check_receipt_master_id($receipt_master_id) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id', $receipt_master_id);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('receipt_master');
    }

    public function get_maxcustomer() {
        $this->db->select('MAX(customer.customer_id_pri) AS MAX');
        $MAX = $this->db->get('customer')->row()->MAX;
        if ($MAX == null) {
            return 0;
        } else {
            return $MAX;
        }
    }

    public function get_shop($id = null) {
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        $this->db->limit(1);
        return $this->db->get('shop');
    }

    public function get_shop_setting_document($id = null) {
        if ($id != NULL) {
            $this->db->where('shop_setting_document.shop_id_pri', $id);
        }
        return $this->db->get('shop_setting_document');
    }

    public function get_groupcustomer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('ref_type_save', 'ref_type_save.type_save_id = customer_group.type_save_id');
        if ($id != NULL) {
            $this->db->where('customer_group_id', $id);
        }
        $this->db->order_by('customer_group_id');
        return $this->db->get('customer_group');
    }

}
