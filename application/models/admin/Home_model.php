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
    public function getshop() {
        $this->db->where("shop.type_shop_id", 1);
        $this->db->where("shop.status_shop_id", 1);
        return $this->db->get('shop')->num_rows();
    }

    public function getshopbranch() {
        $this->db->where("shop.type_shop_id", 2);
        $this->db->where("shop.status_shop_id", 1);
        return $this->db->get('shop');
    }

    public function getshopagent() {
        $this->db->where("shop.type_shop_id", 3);
        $this->db->where("shop.status_shop_id", 1);
        return $this->db->get('shop');
    }

    public function getshopsms() {
        $this->db->select('min(setting_sms.credit_all) AS credit_all');
        $this->db->join('setting_email', 'setting_email.sms_username = setting_sms.setting_sms_username AND setting_email.sms_password = setting_sms.setting_sms_password AND setting_email.sms_tel = setting_sms.setting_sms_number');
        $this->db->where("setting_sms.credit_all >", 0);
        return $this->db->get('setting_sms')->row();
    }
    
    public function getUserReceiptEvidence() {
        $this->db->join('receipt', 'receipt.user_id = user.user_id');
        $this->db->join('income_bank', 'receipt.income_bank_id = income_bank.income_bank_id');
        $this->db->where("user.status_id", 1);
        $this->db->where("receipt.receipt_check", 0);
        $this->db->order_by('receipt.receipt_modify', 'DESC');
        $this->db->limit(15);
        return $this->db->get('user');
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
    
    public function checkShop($shop_id_pri) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->limit(1);
        return $this->db->get('shop')->row()->status_shop_id;
    }
}
