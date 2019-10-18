<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportservices_model
 *
 * @author Prasan Srisopa
 */
class Reportservices_model extends CI_Model{
    //put your code here
    public function services_year() {
        $this->db->select('YEAR(services_master.date_pay) AS year_pay');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.date_pay !=', '');
        $this->db->group_by('YEAR(services_master.date_pay)');
        return $this->db->get('services_master');
    }
    
    public function get_services_master_all() {
        $this->db->join('services_detail', 'services_detail.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);
        $this->db->where('(services_detail.services_detail_number = "" OR services_detail.services_detail_number IS NULL)');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('services_master');
    }
    
    public function get_services_master_day($dateday) {
        $this->db->join('services_detail', 'services_detail.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);
        $this->db->where('(services_detail.services_detail_number = "" OR services_detail.services_detail_number IS NULL)');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.date_pay >=', $dateday . ' 00:00:00');
        $this->db->where('services_master.date_pay <=', $dateday . ' 23:59:59');
        return $this->db->get('services_master');
    }
    
    public function get_services_master_month($datemonth) {
        $datedaystart = date("$datemonth-01");
        $datedayend = date("$datemonth-31");
        $this->db->join('services_detail', 'services_detail.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);;
        $this->db->where('(services_detail.services_detail_number = "" OR services_detail.services_detail_number IS NULL)');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.date_pay >=', $datedaystart . ' 00:00:00');
        $this->db->where('services_master.date_pay <=', $datedayend . ' 23:59:59');
        return $this->db->get('services_master');
    }
    
    public function get_services_master_year($dateyear) {
        $datedaystart = date("$dateyear-01-01");
        $datedayend = date("$dateyear-12-31");
        $this->db->join('services_detail', 'services_detail.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);
        $this->db->where('(services_detail.services_detail_number = "" OR services_detail.services_detail_number IS NULL)');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.date_pay >=', $datedaystart . ' 00:00:00');
        $this->db->where('services_master.date_pay <=', $datedayend . ' 23:59:59');
        return $this->db->get('services_master');
    }
    
    public function get_services_master_dateday($datedaystart,$datedayend) {
        $this->db->join('services_detail', 'services_detail.services_master_id_pri = services_master.services_master_id_pri');
        $this->db->where('services_master.services_status', 2);
        $this->db->where('services_master.services_pay', 1);
        $this->db->where('(services_detail.services_detail_number = "" OR services_detail.services_detail_number IS NULL)');
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->where('services_master.date_pay >=', $datedaystart . ' 00:00:00');
        $this->db->where('services_master.date_pay <=', $datedayend . ' 23:59:59');
        return $this->db->get('services_master');
    }
    
     public function get_customer_group($customer_id, $customer_group_id = null) {
        $this->db->select('customer_group.customer_group_name');
        $this->db->where('customer.customer_id', $customer_id);
        if ($customer_group_id != null) {
            $this->db->where('customer.customer_group_id', $customer_group_id);
        }
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        return $this->db->get('customer');
    }

    public function ref_customer_group() {
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('customer_group');
    }
}
