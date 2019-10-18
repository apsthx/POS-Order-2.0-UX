<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Partners_model
 *
 * @author Prasan Srisopa
 */
class Partners_model extends CI_Model {
    //put your code here
    public function get_partners($partners_group_id, $status_id, $id = null) {
        $this->db->select('*');
        $this->db->join('partners_group', 'partners.partners_group_id = partners_group.partners_group_id');
        $this->db->join('ref_status', 'partners.status_id = ref_status.status_id');
        $this->db->where('partners_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('partners_id_pri', $id);
        }
        if ($status_id == 1) {
            $this->db->where('partners.status_id', 1);
        }
        if ($partners_group_id != 0) {
            $this->db->where('partners_group.partners_group_id',$partners_group_id);
        }
        $this->db->order_by('partners_id_pri','DESC');
        return $this->db->get('partners');
    }

    public function checkpartners($partners_id) {
        $this->db->from('partners');
        $this->db->where('partners.partners_id', $partners_id);
        return $this->db->count_all_results();
    }

    public function add($data) {
        $this->db->insert('partners', $data);
    }

    public function edit($id, $data) {
        $this->db->where('partners.partners_id_pri', $id);
        $this->db->update('partners', $data);
    }

    public function get_grouppartners($id = null) {
        $this->db->select('*');
        $this->db->where('partners_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($id != NULL) {
            $this->db->where('partners_group_id', $id);
        }
        $this->db->order_by('partners_group_id');
        return $this->db->get('partners_group');
    }

    public function get_maxpartners() {
        $this->db->select('MAX(partners.partners_id_pri) AS MAX');
        $MAX = $this->db->get('partners')->row()->MAX;
        if ($MAX == null) {
            return 0;
        } else {
            return $MAX;
        }
    }
    
    public function check_id($id = null) {
        if ($id != NULL) {
            $this->db->where('partners_id', $id);
        }
        return $this->db->get('partners');
    }   
    
    public function get_shop_setting_document($id = null) {
        if ($id != NULL) {
            $this->db->where('shop_setting_document.shop_id_pri', $id);
        }
        return $this->db->get('shop_setting_document');
    }
}
