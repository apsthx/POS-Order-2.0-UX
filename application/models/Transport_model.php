<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receipt
 *
 * @author Prasan Srisopa
 */
class Transport_model extends CI_Model {

    //put your code here
    public function get_receipt_master($status_transfer_id = NULL, $dateunready_start = NULL, $dateunready_end = NULL, $transport_service_id = NULL) {
        $this->db->select('*');
        $this->db->join('user', 'receipt_master.user_id = `user`.user_id');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($status_transfer_id != NULL) {
            $this->db->where('receipt_master.status_transfer_id', $status_transfer_id);
        }
        if ($dateunready_start != null) {
            if ($status_transfer_id == 1) {
                $this->db->where('receipt_master.date_pack >=', $dateunready_start);
            } else {
                $this->db->where('receipt_master.date_transfer >=', $dateunready_start);
            }
        }
        if ($dateunready_end != null) {
            if ($status_transfer_id == 1) {
                $this->db->where('receipt_master.date_pack <=', $dateunready_end);
            } else {
                $this->db->where('receipt_master.date_transfer <=', $dateunready_end);
            }
        }
        if ($transport_service_id != null) {
            $this->db->where('receipt_master.transport_service_id', $transport_service_id);
        }
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.type_receipt_id', 3);
        $this->db->where('receipt_master.status_pack_id', 2);
        $this->db->order_by('receipt_master.date_receipt', 'DESC');
        $this->db->order_by('receipt_master.date_modify', 'DESC');
        return $this->db->get('receipt_master');
    }

    public function ref_status_receipt($id = null) {
        if ($id != NULL) {
            $this->db->where('status_receipt_id', $id);
        }
        return $this->db->get('ref_status_receipt');
    }

    public function ref_type_receipt($id = null) {
        //$this->db->where('type_receipt_id !=', 4);
        if ($id != NULL) {
            $this->db->where('type_receipt_id', $id);
        }
        return $this->db->get('ref_type_receipt');
    }

    public function ref_status_pay($id = null) {
        if ($id != NULL) {
            $this->db->where('status_pay_id', $id);
        }
        return $this->db->get('ref_status_pay');
    }

    public function ref_status_transfer($id = null) {
        if ($id != NULL) {
            $this->db->where('status_transfer_id', $id);
        }
        return $this->db->get('ref_status_transfer');
    }

    public function edit($id, $data) {
        $this->db->where('receipt_master_id_pri', $id);
        $this->db->update('receipt_master', $data);
    }

    public function get_receipt_master_id($id) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $id);
        $this->db->limit(1);
        return $this->db->get('receipt_master');
    }

    public function get_transport_setting() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('transport_setting');
    }

    public function get_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->order_by('receipt_detail_id');
        return $this->db->get('receipt_detail');
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

    public function get_product($product_id = null) {
        $this->db->select('product.product_id_pri,  
                            product.product_id,
                            product.product_category_id,
                            product.product_name,
                            product.product_unit,
                            product.product_sale_price,
                            product.product_amount,
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

    public function map_stock_update($data) {
        $this->db->where('map_product_stock.stock_id_pri', $data['stock_id_pri']);
        $this->db->where('map_product_stock.product_id_pri', $data['product_id_pri']);
        $this->db->update('map_product_stock', $data);
    }

    public function product_update($data) {
        $this->db->where('product.product_id_pri', $data['product_id_pri']);
        $this->db->update('product', $data);
    }

    public function get_stock($product_id = null) {
        $this->db->select('stock.stock_id_pri, map_product_stock.map_product_amount');
        $this->db->join('product', 'map_product_stock.product_id_pri = product.product_id_pri');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('map_product_stock.map_product_amount >', 0);
        if ($product_id != NULL) {
            $this->db->where('product.product_id', $product_id);
        }
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('map_product_stock.map_product_amount', 'DESC');
        return $this->db->get('map_product_stock');
    }

    public function get_map_product_stock($id = null) {
        $this->db->select('*');
        $this->db->join('stock', 'map_product_stock.stock_id_pri = stock.stock_id_pri');
        $this->db->where('stock.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('product_id_pri', $id);
        }
        return $this->db->get('map_product_stock');
    }
    
    public function get_head_sms($id = null) {
        if ($id != NULL) {
            $this->db->where('head_sms_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('head_sms');
    }
    
     public function get_sms($id = null, $shop_id_pri = null) {
        $this->db->select('*');
        $this->db->join('shop', 'setting_sms.shop_id_pri = shop.shop_id_pri');
        if ($shop_id_pri != NULL) {
            $this->db->where('setting_sms.shop_id_pri', $shop_id_pri);
        }
        if ($id != NULL) {
            $this->db->where('setting_sms.setting_sms_id', $id);
        }
        $this->db->order_by('setting_sms_id');
        return $this->db->get('setting_sms');
    }


    public function editsms($id, $data) {
        $this->db->where('setting_sms.setting_sms_id', $id);
        $this->db->update('setting_sms', $data);
    }

}
