<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupcustomer_model
 *
 * @author Prasan Srisopa
 */
class Groupcustomer_model extends CI_Model {
    
    public function get_groupcustomer($id = null) {
        $this->db->select('*');
        $this->db->join('ref_type_save', 'ref_type_save.type_save_id = customer_group.type_save_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('customer_group_id', $id);
        }
        $this->db->order_by('customer_group_id');
        return $this->db->get('customer_group');
    }
    
    public function checkgroupcustomer($customer_group_id) {
        $this->db->from('customer');
        $this->db->where('customer.customer_group_id', $customer_group_id);
        return $this->db->count_all_results();
    }
    
    public function add($data) {
        $this->db->insert('customer_group', $data);
    }
    
    public function edit($id, $data) {
        $this->db->where('customer_group.customer_group_id', $id);
        $this->db->update('customer_group', $data);
    }
    
    public function delete($id) {
        $this->db->where('customer_group.customer_group_id', $id);
        $this->db->delete('customer_group');
    }  
}
