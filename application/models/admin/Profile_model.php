<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profile_model
 *
 * @author Prasan Srisopa
 */
class Profile_model extends CI_Model{
    //put your code here
    public function get_admin($id = null) {
        if ($id != NULL) {
            $this->db->where('admin_id', $id);
        }
        return $this->db->get('admin');
    }
    
    public function edit($id, $data) {
        $this->db->where('admin.admin_id', $id);
        $this->db->update('admin', $data);
    }
    
    public function checkpassword($admin_id,$password) {
        $this->db->where('admin_id',$admin_id);
        $this->db->where('password',$password);
        return $this->db->get('admin');
    }
}
