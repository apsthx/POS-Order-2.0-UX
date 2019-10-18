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
    public function get_user($id = null) {
        $this->db->select('*');
        $this->db->where('user.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('user.user_id', $id);
        }
        return $this->db->get('user');
    }
    
    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }
    
    public function checkpassword($user_id,$password) {
        $this->db->where('user_id',$user_id);
        $this->db->where('password',$password);
        return $this->db->get('user');
    }
    
    public function get_image($id) {
        $this->db->where('image.image_id', $id);
        $this->db->limit(1);
        return $this->db->get('image')->row();
    }
}
