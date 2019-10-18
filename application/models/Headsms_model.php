<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Headsms_model
 *
 * @author Prasan Srisopa
 */
class Headsms_model extends CI_Model{
    //put your code here
    public function get_headsms($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('head_sms_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('head_sms.head_sms_id');
        return $this->db->get('head_sms');
    }
    
    public function addheadsms($data) {
        $this->db->insert('head_sms', $data);
    }
    
    public function editheadsms($id, $data) {
        $this->db->where('head_sms.head_sms_id', $id);
        $this->db->update('head_sms', $data);
    }
   
    
    public function deleteheadsms($id) {
        $this->db->where('head_sms.head_sms_id', $id);
        $this->db->delete('head_sms');
    }
}
