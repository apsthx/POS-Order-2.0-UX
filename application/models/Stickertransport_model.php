<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transport_model
 *
 * @author Prasan Srisopa
 */
class Stickertransport_model extends CI_Model {

    //put your code here
    public function get_receipt_master_unready($dateunready_start = null, $dateunready_end = null) {
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_order_id', 2);
        $this->db->where('receipt_master.type_receipt_id', 3);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.status_sticker_transport_id', 1);
        if ($dateunready_start != null) {
            $this->db->where('receipt_master.date_pay >=', $dateunready_start);
        }
        if ($dateunready_end != null) {
            $this->db->where('receipt_master.date_pay <=', $dateunready_end);
        }
        $this->db->order_by('receipt_master.date_pay', 'DESC');
        $this->db->order_by('receipt_master.receipt_master_id', 'DESC');
        return $this->db->get('receipt_master');
    }

    public function get_receipt_master_success($datesuccess_start = null, $datesuccess_end = null, $transport_service_id = null) {
        $this->db->where('receipt_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('receipt_master.status_receipt_order_id', 2);
        $this->db->where('receipt_master.type_receipt_id', 3);
        $this->db->where('receipt_master.status_receipt_id', 1);
        $this->db->where('receipt_master.status_pay_id', 1);
        $this->db->where('receipt_master.status_sticker_transport_id', 2);
        if ($datesuccess_start != null) {
            $this->db->where('receipt_master.date_sticker >=', $datesuccess_start);
        }
        if ($datesuccess_end != null) {
            $this->db->where('receipt_master.date_sticker <=', $datesuccess_end);
        }
        if ($transport_service_id != null) {
            $this->db->where('receipt_master.transport_service_id', $transport_service_id);
        }
        $this->db->order_by('receipt_master.date_sticker', 'DESC');
        $this->db->order_by('receipt_master.receipt_master_id', 'DESC');
        return $this->db->get('receipt_master');
    }

    public function get_receipt_master_id($id = null) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('receipt_master.receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_master');
    }

    public function get_receipt_detail($id = null) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('receipt_detail.receipt_master_id_pri', $id);
        }
        return $this->db->get('receipt_detail');
    }

    public function ref_status_sticker_transport($id = null) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('status_sticker_transport_id', $id);
        }
        return $this->db->get('ref_status_sticker_transport');
    }

    public function get_user($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('user_id', $id);
        }
        return $this->db->get('user');
    }

    public function get_transport_setting() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('transport_setting');
    }

    public function edit($id, $data) {
        $this->db->where('receipt_master_id_pri', $id);
        $this->db->update('receipt_master', $data);
    }

    public function ref_transport_service($id = null) {
        $this->db->select('*');
        if ($id != null) {
            $this->db->where('transport_service_id', $id);
        }
        return $this->db->get('ref_transport_service');
    }

    public function get_customer_group($customer_id, $customer_group_id = null) {
        $this->db->select('customer_group.customer_group_name');
        $this->db->where('customer.customer_id', $customer_id);
        if ($customer_group_id != null) {
            $this->db->where('customer.customer_group_id', $customer_group_id);
        }
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        return $this->db->get('customer');
    }

    public function ref_customer_group() {
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('customer_group');
    }

}
