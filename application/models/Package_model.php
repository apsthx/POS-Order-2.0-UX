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
        $this->db->where('package_status', 1);
        return $this->db->get('package');
    }
    
    public function getSMS($id = null) {
        if ($id != NULL) {
            $this->db->where('sms_id', $id);
        }
        $this->db->where('sms_status', 1);
        return $this->db->get('sms');
    }
    
}
