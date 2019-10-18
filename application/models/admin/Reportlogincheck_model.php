<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_model
 *
 * @author Prasan Srisopa
 */
class reportlogincheck_model extends CI_Model{
    //put your code here
    public function countreport($search) {
        $this->db->join('user', 'log_user_login.user_id = user.user_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or user.fullname LIKE '%$search%'  
           ) ");
        }
        return $this->db->count_all_results('log_user_login');
    }
    
    public function getReport($params = array(),$search) {
        $this->db->join('user', 'log_user_login.user_id = user.user_id');
        $this->db->join('shop', 'user.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or user.fullname LIKE '%$search%'  
           ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_user_login.log_time', 'DESC');
        return $this->db->get('log_user_login');
    }
}
