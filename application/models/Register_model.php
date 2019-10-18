<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register_model
 *
 * @Prasan Srisopa
 */
class Register_model extends CI_Model{
    //put your code here
    public function getusertel($tel = null) {
        $this->db->select('*');
        if ($tel != NULL) {
            $this->db->where('user.tel', $tel);
        }
        return $this->db->get('user');
    }
    
    public function checkUsername($username = null) {
        $this->db->select('username');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }
    
    public function checkEmail($email) {
        $this->db->select('email');
        $this->db->where('email', $email);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }
    
    public function addUser($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    
    public function addShop($data) {
        $this->db->insert('shop', $data);
        return $this->db->insert_id();
    }
    
    public function editShop($id, $data) {
        $this->db->where('shop.shop_id_pri', $id);
        $this->db->update('shop', $data);
    }
    
    public function addUserPackage($data){
        $this->db->insert('user_package', $data);
    }
}
