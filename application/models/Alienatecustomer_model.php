<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alienatecustomer_model
 *
 * @Prasan Srisopa
 */
class Alienatecustomer_model extends CI_Model{
    //put your code here
    public function get_inform_payment($id = null) {
        $this->db->select('bank.bank_name,
                            bank.bank_number,
                            bank.type_bank_id,
                            inform_payment.inform_payment_id,
                            inform_payment.bank_id,
                            inform_payment.date_pay,
                            inform_payment.time_pay,
                            inform_payment.money,
                            inform_payment.image_id,
                            inform_payment.invoice,
                            inform_payment.customer_id,
                            inform_payment.customer_name,
                            inform_payment.customer_email,
                            inform_payment.customer_tel,
                            inform_payment.date_modify,
                            ref_status_inform.status_inform_name,
                            ref_status_inform.status_inform_id,
                            inform_payment.user_id,
                            image.image_name');
        $this->db->join('ref_status_inform', 'inform_payment.status_inform_id = ref_status_inform.status_inform_id');
        $this->db->join('bank', 'inform_payment.bank_id = bank.bank_id');
        $this->db->join('image', 'inform_payment.image_id = image.image_id');
        $this->db->join('customer', 'customer.customer_id = inform_payment.customer_id');
        $this->db->where('customer.customer_id_pri', $this->session->userdata('user_id'));
        if ($id != NULL) {
            $this->db->where('inform_payment.inform_payment_id', $id);
        }
        $this->db->order_by('inform_payment.date_modify', 'DESC');
        return $this->db->get('inform_payment');
    }

    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->where('type_bank_id', 2);
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('bank');
    }
    
    public function get_customer() {
        $this->db->select('*');
        $this->db->where('customer_id_pri', $this->session->userdata('user_id'));
        return $this->db->get('customer');
    }
}
