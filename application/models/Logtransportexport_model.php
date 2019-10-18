<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logtransportexport_model
 *
 * @Prasan Srisopa
 */
class Logtransportexport_model extends CI_Model {

    //put your code here
    public function log_transportexport() {
        $this->db->select('log_transportexport.log_id,
            log_transportexport.user_id,
            log_transportexport.shop_id_pri,
            log_transportexport.date_modify,
            user.fullname');
        $this->db->join('user', 'log_transportexport.user_id = user.user_id');
        $this->db->where('log_transportexport.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->order_by('log_transportexport.date_modify', 'DESC');
        return $this->db->get('log_transportexport');
    }

}
