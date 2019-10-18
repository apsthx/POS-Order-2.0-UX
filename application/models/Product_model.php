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
class Product_model extends CI_Model {

    //put your code here
    public function get_product($id = null, $filter = array()) {
        $this->db->select('product.product_id_pri,
                            product.product_id,
                            product_category.product_category_id,
                            product_category.product_category_name,
                            product.product_name,
                            product_brand,
                            product_gen,
                            product.product_buy_price,
                            product.product_sale_price,
                            product.product_weight,
                            product.product_unit,
                            product.product_amount,
                            product.product_barcode,
                            product.image_id,
                            product.date_modify,
                            image.image_name,
                            ref_status_product.status_product_id,
                            ref_status_product.status_product_name');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('ref_status_product', 'product.status_product_id = ref_status_product.status_product_id');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('product.product_id_pri', $id);
        }
        if ($filter['product_category_id'] != NULL) {
            $this->db->where('product.product_category_id', $filter['product_category_id']);
        }
        if ($filter['status_product_id'] != NULL) {
            $this->db->where('product.status_product_id', $filter['status_product_id']);
        }
        $this->db->order_by('product.product_id_pri', 'DESC');
        $this->db->group_by('product.product_id_pri');
        return $this->db->get('product');
    }

    public function get_category_pull($shop_create = null) {
        $this->db->select('*');
        if ($shop_create != NULL) {
            $this->db->where('product_category.shop_id_pri', $shop_create);
        }
        return $this->db->get('product_category');
    }

    public function get_product_pull($shop_create) {
        $this->db->select('*');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->where('product_category.shop_id_pri', $shop_create);
        $this->db->where('product.status_product_id', 1);
        $this->db->order_by('product.product_id_pri', 'DESC');
        return $this->db->get('product');
    }

    public function get_product_props_pull($shop_create) {
        $this->db->select('product_properties.product_properties_id,
                            product_properties.product_id_pri,
                            product_properties.product_properties_name,
                            product_properties.product_properties_value,
                            product_properties.date_modify');
        $this->db->join('product', 'product_properties.product_id_pri = product.product_id_pri');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->where('product_category.shop_id_pri', $shop_create);
        return $this->db->get('product_properties');
    }

    public function pull_category($category = array()) {
        $this->db->select('transfer_id,product_category_id');
        $this->db->where('product_category.transfer_id', $category->product_category_id);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        $cat = $this->db->get('product_category');
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'product_category_name' => $category->product_category_name,
            'transfer_id' => $category->product_category_id,
            'date_modify' => $this->mics->getDate()
        );
        if ($cat->num_rows() > 0) {
            $product_category_id = $cat->row()->product_category_id;
            $this->db->where('product_category.product_category_id', $product_category_id);
            $this->db->update('product_category', $data);
            return $product_category_id;
        } else {
            $this->db->insert('product_category', $data);
            return $this->db->insert_id();
        }
    }

    public function pull_product($product = array(), $product_category_id = null) {
        $this->db->select('product.transfer_id , product.product_id_pri');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->where('product.transfer_id', $product->product_id_pri);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        $pro = $this->db->get('product');
        $data = array(
            'product_id' => $product->product_id,
            'product_category_id' => $product_category_id,
            'product_name' => $product->product_name,
            'product_brand' => $product->product_brand,
            'product_gen' => $product->product_gen,
            'product_buy_price' => 0,
            'product_sale_price' => 0,
            'product_amount' => 0,
            'product_weight' => $product->product_weight,
            'product_unit' => $product->product_unit,
            'product_barcode' => $product->product_barcode,
            'image_id' => $product->image_id,
            'status_product_id' => 1,
            'transfer_id' => $product->product_id_pri,
            'date_modify' => $this->mics->getDate()
        );
        if ($pro->num_rows() > 0) {
            $product_id_pri = $pro->row()->product_id_pri;
            $this->db->where('product.product_id_pri', $product_id_pri);
            $this->db->update('product', $data);
            return $product_id_pri;
        } else {
            $this->db->insert('product', $data);
            return $this->db->insert_id();
        }
    }

    public function delete_props($product_id_pri = null) {
        $this->db->where('product_properties.product_id_pri', $product_id_pri);
        $this->db->delete('product_properties');
    }

    public function pull_product_props($props = array(), $product_id_pri = null) {
        $data = array(
            'product_id_pri' => $product_id_pri,
            'product_properties_name' => $props->product_properties_name,
            'product_properties_value' => $props->product_properties_value,
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('product_properties', $data);
        return $this->db->insert_id();
    }

    public function get_product_by_id($id = null) {
        $this->db->select('product.product_id_pri,
                            product.product_id,
                            product_category.product_category_id,
                            product_category.product_category_name,
                            product.product_name,
                            product_brand,
                            product_gen,
                            product.product_buy_price,
                            product.product_sale_price,
                            product.product_weight,
                            product.product_unit,
                            product.product_amount,
                            product.product_barcode,
                            product.image_id,
                            product.date_modify,
                            image.image_name,
                            ref_status_product.status_product_id,
                            ref_status_product.status_product_name');
        $this->db->join('image', 'product.image_id = image.image_id');
        $this->db->join('product_category', 'product.product_category_id = product_category.product_category_id');
        $this->db->join('ref_status_product', 'product.status_product_id = ref_status_product.status_product_id');
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('product.product_id_pri', $id);
        }
        $this->db->order_by('product.product_id_pri', 'DESC');
        return $this->db->get('product');
    }

    public function get_properties_by_id_product($id = null) {
        $this->db->select('product_properties.product_properties_id,
                            product_properties.product_properties_name,
                            product_properties.product_properties_value');
        $this->db->where('product_properties.product_id_pri', $id);
        $this->db->order_by('product_properties.date_modify');
        return $this->db->get('product_properties');
    }

    public function check_product_id($product_id = null) {
        $this->db->select('product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('product');
    }

    public function update_product($product_id, $data) {
        $this->db->select('product_id_pri');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('product_id', $product_id);
        $this->db->where('product_category.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        $product_id_pri = $this->db->get('product')->row()->product_id_pri;

        $this->db->where('product_id_pri', $product_id_pri);
        $this->db->update('product', $data);
    }

    public function count_in_map($product_id_pri = null) {
        $this->db->select('product_id_pri');
        $this->db->where('product_id_pri', $product_id_pri);
        $this->db->limit(1);
        return $this->db->count_all_results('map_product_stock');
    }

    public function delete_product($product_id_pri) {
        $this->db->where('product_id_pri', $product_id_pri);
        $this->db->delete('product_properties');

        $this->db->where('product_id_pri', $product_id_pri);
        $this->db->delete('product');
    }

}
