<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Serviceslist_model
 *
 * @author Prasan Srisopa
 */
class Serviceslist_model extends CI_Model {

    //put your code here
    public function get_services_master($services_status = NULL, $services_day_start = NULL, $services_day_end = NULL, $services_pay = NULL) {
        $this->db->select('*');
        $this->db->join('user', 'services_master.user_id = `user`.user_id');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        if ($services_status != NULL) {
            $this->db->where('services_master.services_status', $services_status);
        }
        if ($services_day_start != null) {
            if ($services_status == 1) {
                $this->db->where('services_master.services_day >=', $services_day_start . ' 00:00:00');
            } else {
                $this->db->where('services_master.date_services >=', $services_day_start . ' 00:00:00');
            }
        }
        if ($services_day_end != null) {
            if ($services_status == 1) {
                $this->db->where('services_master.services_day <=', $services_day_end . ' 23:59:59');
            } else {
                $this->db->where('services_master.date_services <=', $services_day_end . ' 23:59:59');
            }
        }
        if ($services_pay != null) {
            $this->db->where('services_master.services_pay', $services_pay);
        }
        $this->db->order_by('services_master.services_day');
        $this->db->order_by('services_master.date_modify');
        return $this->db->get('services_master');
    }
    
    public function get_bank($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('bank_id', $id);
        }
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('bank');
    }
    
    public function bank_update($data) {
        $this->db->where('bank.bank_id', $data['bank_id']);
        $this->db->update('bank', $data);
    }
    
    public function get_servicesmaster($services_master_id_pri = null) {
        $this->db->join('user', 'services_master.user_id = `user`.user_id');
        if ($services_master_id_pri != NULL) {
            $this->db->where('services_master.services_master_id_pri', $services_master_id_pri);
        }
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('services_master');
    }
    
    public function servicesmaster_update($data,$services_master_id_pri) {
        $this->db->where('services_master.services_master_id_pri', $services_master_id_pri);
        $this->db->update('services_master', $data);
    }

    public function get_file($services_master_id_pri = null) {
         $this->db->join('user', 'files.user_id = `user`.user_id');
        $this->db->where('files.services_master_id_pri', $services_master_id_pri);
        return $this->db->get('files');
    }
    
    public function get_file_id($files_id = null) {
        $this->db->where('files.files_id', $files_id);
        return $this->db->get('files');
    }
}
