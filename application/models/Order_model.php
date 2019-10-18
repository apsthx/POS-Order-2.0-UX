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
class Order_model extends CI_Model {

    //put your code here
    public function get_sale_from() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_shop_create() {
        $this->db->select('shop.shop_id_pri,
                            karn.shop_id');
        $this->db->join('shop AS karn', 'shop.shop_create_id = karn.shop_id_pri');
        $this->db->where('shop.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('shop');
    }

    public function get_type_tax() {
        $this->db->select('*');
        $this->db->where('sale_from.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('sale_from');
    }

    public function get_partners() {
        $this->db->select('shop_create_id');
        $this->db->where('shop.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where_in('shop.type_shop_id', array(2, 3));
        $this->db->limit(1);
        $data = $this->db->get('shop');
        if ($data->num_rows() > 0) {
            $shop_create_id = $data->row()->shop_create_id;
            if ($shop_create_id != "") {
                $this->db->select('*');
                $this->db->where('shop.shop_id_pri', $shop_create_id);
                $this->db->limit(1);
                return $this->db->get('shop')->row();
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function get_product($product_id = null) {
        $this->db->select('product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_buy_price,
                            product.status_product_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('product.product_id');
        return $this->db->get('product');
    }

    public function get_customer($partners_group_id = null) {
        $this->db->select('partners.partners_id_pri,
                            partners.partners_id,
                            partners.partners_group_id,
                            partners.fullname,
                            partners.email,
                            partners.tel,
                            partners.facebook,
                            partners.line,
                            partners.instagram,
                            partners.address,
                            partners.status_id,
                            partners.tax_id,
                            partners.tax_shop,
                            partners.tax_shop_sub,
                            partners.tax_address,
                            partners.date_create,
                            partners.date_modify,');
        $this->db->join('partners_group', 'partners.partners_group_id = partners_group.partners_group_id');
        if ($partners_group_id != null) {
            $this->db->where('partners.partners_group_id', $partners_group_id);
        }
        $this->db->where('partners_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('partners.partners_id');
        return $this->db->get('partners');
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
//        $this->db->where('product.status_product_id', 1);
        if ($product_category_id != NULL) {
            $this->db->where('product.product_category_id', $product_category_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('product.product_id');
        return $this->db->get('map_product_stock');
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

    public function get_product_out_stock($product_id = null) {
        $this->db->select('product.product_id_pri,
                            product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_sale_price,
                            product.product_amount,
                            product.status_product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('product');
    }

    public function update_product($data) {
        $this->db->where('product.product_id_pri', $data['product_id_pri']);
        $this->db->update('product', $data);
    }

}
