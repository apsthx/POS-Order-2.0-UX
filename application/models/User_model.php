<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home_model
 *
 * @author Prasan Srisopa
 */
class User_model extends CI_Model {

    public function get_user($status_id, $id = null) {
        $this->db->select('*');
        $this->db->join('role', 'user.role_id = role.role_id');
        $this->db->join('ref_status', 'user.status_id = ref_status.status_id');
        $this->db->where('user.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('user.user_id', $id);
        }
        if ($status_id == 1) {
            $this->db->where('user.status_id', 1);
        }
        $this->db->order_by('user.user_id', 'DESC');
        return $this->db->get('user');
    }

    public function get_role($id = null) {
        if ($id != NULL) {
            $this->db->where('role_id', $id);
        }
        return $this->db->get('role');
    }

    public function ref_status($id = null) {
        if ($id != NULL) {
            $this->db->where('status_id', $id);
        }
        return $this->db->get('ref_status');
    }

    public function check_username($username = null) {
        if ($username != NULL) {
            $this->db->where('username', $username);
        }
        return $this->db->get('user');
    }

    public function add($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }

    public function get_role_group($id = null) {
        if ($id == 1) {
            $this->db->where_in('role_id', array(2,5,6,7,15));
        } else if ($id == 2) {
            $this->db->where_in('role_id', array(3,9,10,11,15));
        } else {
            $this->db->where_in('role_id', array(4,12,13,14,15));
        }
        return $this->db->get('role');
    }
    
    public function getuserpackage($user_id = null) {
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        return $this->db->get('user_package');
    }

}
