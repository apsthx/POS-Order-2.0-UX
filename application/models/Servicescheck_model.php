<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servicescheck_model
 *
 * @author Prasan Srisopa
 */
class Servicescheck_model extends CI_Model {

    //put your code here
    public function get_services_master() {
        $this->db->select('*');
        $this->db->join('user', 'services_master.user_id = `user`.user_id');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.services_alertday <=', Date('Y-m-d'));
        $this->db->where('services_master.services_status', 1);
        $this->db->where('services_master.services_pay', 2);
        $this->db->order_by('services_master.services_alertday');
        $this->db->order_by('services_master.services_day');
        return $this->db->get('services_master');
    }

}
