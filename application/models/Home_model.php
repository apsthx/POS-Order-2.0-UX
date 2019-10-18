<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author Prasan Srisopa
 */
class Home_model extends CI_Model {
    //put your code here
    public function sum_receipt_today() {
        $today = date('Y-m-d');
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay', $today);
        return $this->db->get('receipt_master');
    }

    public function sum_receipt_month() {
        $start = date('Y-m-01');
        $end = date('Y-m-31');
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $start);
        $this->db->where('receipt_master.date_pay <=', $end);
        return $this->db->get('receipt_master');
    }

    public function sum_receipt_year() {
        $start = date('Y-01-01');
        $end = date('Y-12-31');
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $start);
        $this->db->where('receipt_master.date_pay <=', $end);
        return $this->db->get('receipt_master');
    }

    public function count_customer() {
        $this->db->select('customer.customer_id_pri');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('customer.status_id', 1);
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->count_all_results('customer');
    }

    public function count_order() {
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 2);
        $this->db->where('status_pay_id', 2);
        $this->db->where('status_receipt_order_id', 1);
        $this->db->where('status_sticker_transport_id', 1);
        $this->db->where('status_pack_id', 1);
        $this->db->where('status_transfer_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->count_all_results('receipt_master');
    }

    public function count_sticker_transport() {
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 3);
        $this->db->where('status_pay_id', 1);
        $this->db->where('status_receipt_order_id', 2);
        $this->db->where('status_sticker_transport_id', 1);
        $this->db->where('status_pack_id', 1);
        $this->db->where('status_transfer_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->count_all_results('receipt_master');
    }

    public function count_pack() {
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 3);
        $this->db->where('status_pay_id', 1);
        $this->db->where('status_receipt_order_id', 2);
        $this->db->where('status_sticker_transport_id', 2);
        $this->db->where('status_pack_id', 1);
        $this->db->where('status_transfer_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->count_all_results('receipt_master');
    }

    public function count_transfer() {
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 3);
        $this->db->where('status_pay_id', 1);
        $this->db->where('status_receipt_order_id', 2);
        $this->db->where('status_sticker_transport_id', 2);
        $this->db->where('status_pack_id', 2);
        $this->db->where('status_transfer_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->count_all_results('receipt_master');
    }

    public function hit_product() {
        $this->db->select('receipt_detail.product_id,
                        receipt_detail.product_name,
                        SUM(receipt_detail.product_amount) AS product_amount');
        $this->db->join('receipt_master', 'receipt_detail.receipt_master_id_pri = receipt_master.receipt_master_id_pri');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('receipt_detail.product_id');
        $this->db->group_by('receipt_detail.product_name');
        $this->db->order_by('SUM(receipt_detail.product_amount)','DESC');
        return $this->db->get('receipt_detail', 10);
    }
    
    public function order() {
        $this->db->where('status_receipt_id', 1);
        $this->db->where('type_receipt_id', 2);
        $this->db->where('status_pay_id', 2);
        $this->db->where('status_receipt_order_id', 1);
        $this->db->where('status_sticker_transport_id', 1);
        $this->db->where('status_pack_id', 1);
        $this->db->where('status_transfer_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('receipt_master_id_pri','DESC');
        return $this->db->get('receipt_master',10);
    }
    
    public function charts_year_month($year,$month) {
        $start = date("$year-$month-01");
        $end = date("$year-$month-31");
        $this->db->select('SUM(receipt_master.price_sum_pay) AS price_sum_pay');
        $this->db->where_in('receipt_master.type_receipt_id', array(1,3));
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.date_pay >=', $start);
        $this->db->where('receipt_master.date_pay <=', $end);
        return $this->db->get('receipt_master');
    }

}
