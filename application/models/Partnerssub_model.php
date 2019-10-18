<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Parterssub_model
 *
 * @author Prasan Srisopa
 */
class Partnerssub_model extends CI_Model {

    //put your code here
    public function get_partners() {
        $this->db->select('shop_create_id');
        $this->db->where('shop.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        $shop_create_id = $this->db->get('shop')->row()->shop_create_id;

        $this->db->select('*');
        $this->db->where('shop.shop_id_pri', $shop_create_id);
        $this->db->limit(1);
        return $this->db->get('shop');
    }

}
