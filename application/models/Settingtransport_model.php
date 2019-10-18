<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settingtransport_model
 *
 * @author Prasan Srisopa
 */
class Settingtransport_model extends CI_Model {

    //put your code here
    public function get_transport_setting() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('transport_setting');
    }

    public function get_transport_setting_api($transport_setting_id, $transport_service_id) {
        $this->db->where('transport_setting_id', $transport_setting_id);
        $this->db->where('transport_service_id', $transport_service_id);
        return $this->db->get('transport_api_setting');
    }

    public function ref_transport_service($id = null) {
        if ($id != null) {
            $this->db->where('transport_service_id', $id);
        }
        return $this->db->get('ref_transport_service');
    }

    public function edit($data) {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('transport_setting', $data);
    }

    public function edit_api($data, $transport_api_setting_id) {
        $this->db->where('transport_api_setting_id', $transport_api_setting_id);
        $this->db->update('transport_api_setting', $data);
    }

}
