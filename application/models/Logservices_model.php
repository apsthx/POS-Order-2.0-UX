<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logservices_model
 *
 * @Prasan Srisopa
 */
class Logservices_model extends CI_Model{
    //put your code here
    public function logservices() {
        $this->db->join('services_master', 'log_services.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('log_services.shop_id_pri', $this->session->userdata('shop_id_pri'));;
        $this->db->order_by('log_services.date_modify','DESC');
        return $this->db->get('log_services');
    }
}
