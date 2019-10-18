<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logbank_model
 *
 * @Prasan Srisopa
 */
class Logbank_model extends CI_Model {

    //put your code here
    public function log_bank() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('date_modify','DESC');
        return $this->db->get('log_bank');
    }

}
