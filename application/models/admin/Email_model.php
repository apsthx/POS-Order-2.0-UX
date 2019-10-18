<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email_model
 *
 * @author Prasan Srisopa
 */
class Email_model extends CI_Model{
    //put your code here
    public function get_setting_email() {
        return $this->db->get('setting_email')->row();
    }
    
    public function edit($data) {
        $this->db->update('setting_email', $data);
    }
    
}
