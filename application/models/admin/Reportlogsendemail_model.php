<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportlogsendemail_model
 *
 * @author Prasan Srisopa
 */
class Reportlogsendemail_model extends CI_Model{
    //put your code here
    public function countreport($search) {
        $this->db->join('user', 'log_sendemail.user_id = user.user_id');
        $this->db->join('shop', 'log_sendemail.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or user.fullname LIKE '%$search%'  
                or action_text LIKE '%$search%'  
           ) ");
        }
        return $this->db->count_all_results('log_sendemail');
    }
    
    public function getReport($params = array(),$search) {
        $this->db->select('log_sendemail.action_text,
                        user.fullname,
                        shop.shop_name,
                        log_sendemail.date_modify');
        $this->db->join('user', 'log_sendemail.user_id = user.user_id');
        $this->db->join('shop', 'log_sendemail.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or user.fullname LIKE '%$search%'  
                or action_text LIKE '%$search%'  
           ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_sendemail.date_modify', 'DESC');
        return $this->db->get('log_sendemail');
    }
}
