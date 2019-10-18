<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment_model
 *
 * @author Prasan Srisopa
 */
class Payment_model extends CI_Model {

    //put your code here
    public function getBank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('income_bank.income_bank_id', $id);
        }
        $this->db->where('income_bank.income_bank_active', 1);
        $this->db->order_by('income_bank.income_bank_id');
        return $this->db->get('income_bank');
    }

    public function add($data) {
        $this->db->insert('receipt', $data);
        return $this->db->insert_id();
    }

    public function edit($id, $data) {
        $this->db->where('receipt.receipt_id', $id);
        $this->db->update('receipt', $data);
    }

    public function getReceipt($id = null) {
        $this->db->select('*');
        $this->db->join('income_bank', 'receipt.income_bank_id = income_bank.income_bank_id');
        if ($id != NULL) {
            $this->db->where('receipt.receipt_id', $id);
        }
        $this->db->where('receipt.user_id', $this->session->userdata('user_id'));
        $this->db->order_by('receipt.receipt_create', 'DESC');
        return $this->db->get('receipt');
    }

    public function getPackage($id = null) {
        if ($id != NULL) {
            $this->db->where('package.package_id', $id);
        } else {
            $this->db->where('package.package_id !=', 1);
            $this->db->where('package.package_status', 1);
        }
        //$this->db->where('package.package_status', 1);
        return $this->db->get('package');
    }

    public function getSMS($id = null) {
        if ($id != NULL) {
            $this->db->where('sms.sms_id', $id);
        } else {
            $this->db->where('sms.sms_status', 1);
        }
        return $this->db->get('sms');
    }

}
