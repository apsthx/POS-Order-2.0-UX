<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settingsms_model
 *
 * @author Prasan Srisopa
 */
class Settingsms_model extends CI_Model{
    //put your code here
    public function get_settingsms($id = null) {
        $this->db->select('*');
        $this->db->join('shop', 'setting_sms.shop_id_pri = shop.shop_id_pri');
        if ($id != NULL) {
            $this->db->where('setting_sms.setting_sms_id', $id);
        }
        $this->db->order_by('setting_sms_id');
        return $this->db->get('setting_sms');
    }
    
    public function check_settingsms($id = null) {
        if ($id != NULL) {
            $this->db->where('setting_sms.shop_id_pri', $id);
        }
        return $this->db->get('setting_sms');
    }
    
    public function get_shop($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        $this->db->order_by('shop_id_pri');
        return $this->db->get('shop');
    }
    
    public function add($data) {
        $this->db->insert('setting_sms', $data);
    }
    
    public function edit($id, $data) {
        $this->db->where('setting_sms.setting_sms_id', $id);
        $this->db->update('setting_sms', $data);
    }
    
    public function delete($id) {
        $this->db->where('setting_sms.setting_sms_id', $id);
        $this->db->delete('setting_sms');
    } 
}
