<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shop_model
 *
 * @author Prasan Srisopa
 */
class Addshop_model extends CI_Model {

    //put your code here
    public function check_shop_id($id = null) {
        $this->db->select('shop.shop_id_pri');
        $this->db->where('shop.shop_id', $id);
        $this->db->limit(1);
        return $this->db->count_all_results('shop');
    }

    public function check_username($username = null) {
        $this->db->select('username');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->count_all_results('user');
    }
    
    public function updateshop($id, $data) {
        $this->db->where('shop_id_pri', $id);
        $this->db->update('shop', $data);
    }
    
    public function getuserpackage($user_id = null) {
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        return $this->db->get('user_package');
    }
    
     public function getshop($shop_id_pri = null) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->limit(1);
        return $this->db->get('shop');
    }

}
