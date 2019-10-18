<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Grouppartners_model
 *
 * @author Prasan Srisopa
 */
class Grouppartners_model extends CI_Model {
    
    public function get_grouppartners($id = null) {
        $this->db->select('*');
        $this->db->where('partners_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('partners_group_id', $id);
        }
        $this->db->order_by('partners_group_id');
        return $this->db->get('partners_group');
    }
    
    public function checkgrouppartners($partners_group_id) {
        $this->db->from('partners');
        $this->db->where('partners.partners_group_id', $partners_group_id);
        return $this->db->count_all_results();
    }
    
    public function add($data) {
        $this->db->insert('partners_group', $data);
    }
    
    public function edit($id, $data) {
        $this->db->where('partners_group.partners_group_id', $id);
        $this->db->update('partners_group', $data);
    }
    
    public function delete($id) {
        $this->db->where('partners_group.partners_group_id', $id);
        $this->db->delete('partners_group');
    }  
}
