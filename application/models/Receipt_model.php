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
class Receipt_model extends CI_Model {

    //put your code here
    public function get_receipt_master($status_receipt_id, $status_receipt_order_id, $date_select) {
        $this->db->select('*');
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.type_receipt_id !=', 4);
        if ($status_receipt_id == 1) {
            $this->db->where('receipt_master.status_receipt_id', 1);
        }
        if ($status_receipt_order_id == 1) {
            $this->db->where('receipt_master.status_receipt_order_id', 1);
        }
        if ($date_select != NULL) {
            $this->db->where('receipt_master.date_receipt', $date_select);
        }
        $this->db->where('receipt_master.type_receipt_id', 2);
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

    public function ref_status_receipt_order($id = null) {
        if ($id != NULL) {
            $this->db->where('status_receipt_order_id', $id);
        }
        return $this->db->get('ref_status_receipt_order');
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

    public function get_detail($receipt_master_id_pri) {
        $this->db->select('*');
        $this->db->where('receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->order_by('receipt_detail_id');
        return $this->db->get('receipt_detail');
    }

    public function check_receipt_master_id($receipt_master_id) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id', $receipt_master_id);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('receipt_master');
    }

    public function get_receipt_cancel($receipt_master_id_pri) {
        $this->db->select('receipt_master_id');
        $this->db->where('receipt_master.receipt_master_id_pri', $receipt_master_id_pri);
        $this->db->where('receipt_master.status_receipt_order_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('receipt_master');
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

    public function get_transport_setting() {
        $this->db->select('*');
        $this->db->join('ref_transport_service', 'transport_setting.transport_service_id = ref_transport_service.transport_service_id');
        $this->db->where('transport_setting.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('transport_setting');
    }

    public function get_shop($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        return $this->db->get('shop');
    }

    public function get_image($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('image.image_id', $id);
        }
        return $this->db->get('image');
    }

    public function get_sale_from($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('sale_from_id', $id);
        }
        return $this->db->get('sale_from');
    }

    public function ref_type_tax($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('type_tax_id', $id);
        }
        return $this->db->get('ref_type_tax');
    }

    public function editbank($id, $data) {
        $this->db->where('bank_id', $id);
        $this->db->update('bank', $data);
    }

    public function get_receipt_master_detail($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_detail');
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

    public function editproduct($id, $data) {
        $this->db->where('product_id_pri', $id);
        $this->db->update('product', $data);
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

    public function editmapproductstock($id, $data) {
        $this->db->where('map_product_stock_id', $id);
        $this->db->update('map_product_stock', $data);
    }

    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('bank');
    }

    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }

    public function get_receipt_detail($id = null, $id2 = null, $limit = 1000, $start = 0) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('receipt_detail_id', $id);
            return $this->db->get('receipt_detail');
        }
        if ($id2 != NULL) {
            $this->db->where('receipt_master_id_pri', $id2);

            $this->db->order_by('receipt_detail_id');
            return $this->db->get('receipt_detail', $limit, $start);
        }
    }

    public function get_user($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('user_id', $id);
        }
        return $this->db->get('user');
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

    public function getCustomer($customer_id) {
        $this->db->join('customer_group', 'customer_group.customer_group_id = customer.customer_group_id');
        $this->db->where('customer_id', $customer_id);
        $this->db->limit(1);
        return $this->db->get('customer')->row()->customer_group_name;
    }

}
