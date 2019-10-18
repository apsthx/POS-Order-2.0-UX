<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profilecustomer_model
 *
 * @author Prasan Srisopa
 */
class Profilecustomer_model extends CI_Model{
    //put your code here
    public function get_customer($id = null) {
        $this->db->select('*');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('customer.customer_id_pri', $id);
        }
        return $this->db->get('customer');
    }
    
    public function edit($id, $data) {
        $this->db->where('customer_id_pri', $id);
        $this->db->update('customer', $data);
    }
    
    public function checkpassword($customer_id_pri,$password) {
        $this->db->where('customer_id_pri',$customer_id_pri);
        $this->db->where('password',$password);
        return $this->db->get('customer');
    }
    
    public function get_image($id) {
        $this->db->where('image.image_id', $id);
        $this->db->limit(1);
        return $this->db->get('image')->row();
    }
}
