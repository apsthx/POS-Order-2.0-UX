<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Package_model
 *
 * @author Prasan Srisopa
 */
class Package_model extends CI_Model{
    //put your code here
    public function getPackage($id = null) {
        if ($id != NULL) {
            $this->db->where('package_id', $id);
        }
        return $this->db->get('package');
    }
    
    public function add($data) {
        $this->db->insert('package', $data);
    }   
    
    public function edit($id, $data) {
        $this->db->where('package.package_id', $id);
        $this->db->update('package', $data);
    }
    
    public function getUserPackage($id = null) {
        $this->db->join('user', 'user_package.user_id = user.user_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');          
        $this->db->where('package_id', $id);
        $this->db->where("user.type_user_id", 1);
        $this->db->where("shop.type_shop_id", 1);
        return $this->db->get('user_package');
    }
    
    public function getSMS($id = null) {
        if ($id != NULL) {
            $this->db->where('sms_id', $id);
        }
        return $this->db->get('sms');
    }
    
    public function addsms($data) {
        $this->db->insert('sms', $data);
    }   
    
    public function editsms($id, $data) {
        $this->db->where('sms.sms_id', $id);
        $this->db->update('sms', $data);
    }
    
    public function get_package($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('package_id', $id);
        }
        return $this->db->get('package');
    }
    
    public function get_menu($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('menu_id', $id);
        }
        $this->db->join('group_menu','group_menu.group_menu_id = menu.group_menu_id');
        return $this->db->get('menu');
    }
    
    public function check_StetusPackage($package_id, $menu_id) {
        $this->db->where('map_menu_package.package_id', $package_id);
        $this->db->where('map_menu_package.menu_id', $menu_id);
        return $this->db->count_all_results('map_menu_package');
    }
    
    public function addpackage($data) {
        $this->db->insert('map_menu_package', $data);
        return 1;
    }

    public function deletepackage($package_id,$menu_id) {
        $this->db->where('package_id', $package_id);
        $this->db->where('menu_id', $menu_id);
        $this->db->delete('map_menu_package');
        return 1;
    }
}
