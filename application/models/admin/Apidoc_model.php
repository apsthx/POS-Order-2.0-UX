<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Apidoc_model
 *
 * @author Prasan Srisopa
 */
class Apidoc_model extends CI_Model{
    //put your code here
    public function shop($id = null) {
        $this->db->join('user', 'user.shop_id_pri = shop.shop_id_pri');
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        $this->db->where('user.type_user_id', 1);
        return $this->db->get('shop');
    }
    
    public function editshop($id, $data) {
        $this->db->where('shop.shop_id_pri', $id);
        $this->db->update('shop', $data);
    }
    
    public function customergroup($id = null) {
        if ($id != NULL) {
            $this->db->where('customer_group.shop_id_pri', $id);
        }
        return $this->db->get('customer_group');
    }
}
