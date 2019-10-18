<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicesadd_model
 *
 * @author Prasan Srisopa
 */
class Servicesadd_model extends CI_Model{
    //put your code here
    public function countServices($search) {
        if ($search != '') {
            $this->db->where(" (
                services.services_name LIKE '%$search%'
           ) ");
        }
        $this->db->where('services.shop_id_pri', $this->session->userdata('shop_id_pri'));      
        return $this->db->count_all_results('services');
    }

    public function getServices($params = array(),$search) {
        if ($search != '') {
            $this->db->where(" (
                services.services_name LIKE '%$search%'
           ) ");
        }
        if (array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit'], $params['start']);
        } elseif (!array_key_exists('start', $params) && array_key_exists('limit', $params)) {
            $this->db->limit($params['limit']);
        }
        $this->db->where('services.shop_id_pri', $this->session->userdata('shop_id_pri'));  
        $this->db->order_by('services.services_id', 'DESC');
        return $this->db->get('services');
    }

    public function getServices1Row($id = null) {
        $this->db->where('services_id', $id);
        return $this->db->get('services');
    }
    
    public function insert($data) {
        $this->db->insert('services', $data);
    }
    
    public function edit($id, $data) {
        $this->db->where('services.services_id', $id);
        $this->db->update('services', $data);
    }
    
    public function delete($id) {
        $this->db->where('services.services_id', $id);
        $this->db->delete('services');
    }
}
