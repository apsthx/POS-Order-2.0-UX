<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receipt_model
 *
 * @author Prasan Srisopa
 */
class Receipt_model extends CI_Model {

    //put your code here
    public function getUserReceiptEvidence($datestart = null, $dateend = null, $check = null) {
        $this->db->join('receipt', 'receipt.user_id = user.user_id');
        $this->db->join('income_bank', 'receipt.income_bank_id = income_bank.income_bank_id');
        if ($datestart != null) {
            $this->db->where("receipt.receipt_modify >=", $datestart . ' 00:00:00');
        }
        if ($dateend != null) {
            $this->db->where("receipt.receipt_modify <=", $dateend . ' 23:59:59');
        }
        if ($check != '') {
            $this->db->where("receipt.receipt_check", $check);
        }
        $this->db->where("user.status_id", 1);
        $this->db->order_by('receipt.receipt_modify', 'DESC');
        return $this->db->get('user');
    }

    public function edit($id, $data) {
        $this->db->where('receipt_id', $id);
        $this->db->update('receipt', $data);
    }

    public function getPackage($package_id = null) {
        if ($package_id != null) {
            $this->db->where("package.package_id", $package_id);
        }
        $this->db->limit(1);
        return $this->db->get('package')->row();
    }

    public function getSMS($sms_id = null) {
        if ($sms_id != null) {
            $this->db->where("sms.sms_id", $sms_id);
        }
        $this->db->limit(1);
        return $this->db->get('sms')->row();
    }
    
    public function getreceipt($receipt_id) {
        $this->db->join('user', 'receipt.user_id = user.user_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');
        $this->db->where("receipt.receipt_id", $receipt_id);
        $this->db->limit(1);
        return $this->db->get('receipt')->row();
    }
}
