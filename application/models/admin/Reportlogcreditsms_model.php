<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportlogcreditsms_model
 *
 * @author Prasan Srisopa
 */
class Reportlogcreditsms_model extends CI_Model {

    //put your code here
    public function countreport($search) {
        $this->db->join('shop', 'log_creditsms.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%' 
                or action_text LIKE '%$search%'  
           ) ");
        }
        return $this->db->count_all_results('log_creditsms');
    }

    public function getReport($params = array(), $search) {
        $this->db->select('log_creditsms.action_text,
                        shop.shop_name,
                        log_creditsms.date_modify');
        $this->db->join('shop', 'log_creditsms.shop_id_pri = shop.shop_id_pri');
        if ($search != '') {
            $this->db->where(" (
                shop.shop_name LIKE '%$search%'
                or action_text LIKE '%$search%'  
           ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->order_by('log_creditsms.date_modify', 'DESC');
        return $this->db->get('log_creditsms');
    }

}
