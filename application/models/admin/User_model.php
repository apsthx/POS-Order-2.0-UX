<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User_model
 *
 * @author Prasan Srisopa
 */
class User_model extends CI_Model{
    //put your code here
    public function countUser($package,$search) {
        $this->db->join('user', 'user_package.user_id = user.user_id');
        $this->db->join('package', 'user_package.package_id = package.package_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                user.tel LIKE '%$search%'
                or user.username LIKE '%$search%' 
                or user.fullname LIKE '%$search%' 
                or user.email LIKE '%$search%'    
                or shop.shop_name LIKE '%$search%'  
           ) ");
        }
        if ($package != '') {
            $this->db->where("user_package.package_id", $package);
        }
        $this->db->where("user.type_user_id", 1);
        $this->db->where("shop.type_shop_id", 1);
        return $this->db->count_all_results('user_package');
    }

    public function getUser($params = array(), $package,$search) {
        $this->db->join('user', 'user_package.user_id = user.user_id');
        $this->db->join('package', 'user_package.package_id = package.package_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                user.tel LIKE '%$search%'
                or user.username LIKE '%$search%' 
                or user.fullname LIKE '%$search%' 
                or user.email LIKE '%$search%'    
                or shop.shop_name LIKE '%$search%'  
           ) ");
        }
        if ($package != '') {
            $this->db->where("user_package.package_id", $package);
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where("user.type_user_id", 1);
        $this->db->where("shop.type_shop_id", 1);
        $this->db->order_by('user.date_create', 'DESC');
        return $this->db->get('user_package');
    }

    public function getUser1Row($id = null) {
        $this->db->join('user_package', 'user_package.user_id = user.user_id');
        $this->db->where('user.user_id', $id);
        return $this->db->get('user');
    }

    public function getUserPackage($id = null) {
        $this->db->where('user_id', $id);
        $this->db->limit(1);
        return $this->db->get('user_package')->row();
    }

   
    public function package($id = null) {
        if ($id != NULL) {
            $this->db->where('package_id', $id);
        }else{
            $this->db->where('package_id !=', 1);
        }
        return $this->db->get('package');
    }

    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }
    
    public function editUserPackage($id, $data) {
        $this->db->where('user_package.package_shop_id_pri', $id);
        $this->db->update('user_package', $data);
    }
    
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
    
    public function getshopcreate($id) {
        $this->db->join('user', 'user.shop_id_pri = shop.shop_id_pri');
        $this->db->where('shop.shop_create_id', $id);
        $this->db->where('user.type_user_id', 1);
        return $this->db->get('shop');
    }
    
}
