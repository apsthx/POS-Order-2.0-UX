<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Services_model
 *
 * @author Prasan Srisopa
 */
class Services_model extends CI_Model {

    //put your code here
    public function get_shop_setting_document($id = null) {
        if ($id != NULL) {
            $this->db->where('shop_setting_document.shop_id_pri', $id);
        }
        return $this->db->get('shop_setting_document');
    }

    public function get_maxcustomer() {
        $this->db->select('MAX(customer.customer_id_pri) AS MAX');
        $MAX = $this->db->get('customer')->row()->MAX;
        if ($MAX == null) {
            return 0;
        } else {
            return $MAX;
        }
    }

    public function get_groupcustomer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('ref_type_save', 'ref_type_save.type_save_id = customer_group.type_save_id');
        if ($id != NULL) {
            $this->db->where('customer_group_id', $id);
        }
        $this->db->order_by('customer_group_id');
        return $this->db->get('customer_group');
    }

    public function get_group_customer($id = null) {
        $this->db->select('*');
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->join('customer', 'customer.customer_group_id = customer_group.customer_group_id');
        if ($id != NULL) {
            $this->db->where('customer.customer_id', $id);
        }
        return $this->db->get('customer_group');
    }

    public function get_customer($customer_group_id = null) {
        $this->db->select('customer.customer_id,
                            customer_group_name,
                            customer_group.customer_group_save,
                            customer_group.type_save_id,
                            customer.fullname,
                            customer.email,
                            customer.tel,
                            customer.address,
                            
                            customer.district,
                            customer.amphoe,
                            customer.province,
                            customer.zipcode,
                            
                            customer.tax_id,
                            customer.tax_shop,
                            customer.tax_shop_sub,
                            customer.tax_address');
        $this->db->join('customer_group', 'customer.customer_group_id = customer_group.customer_group_id');
        if ($customer_group_id != null) {
            $this->db->where('customer.customer_group_id', $customer_group_id);
        }
        $this->db->where('customer.status_id', 1);
        $this->db->where('customer_group.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->group_by('customer.customer_id');
        return $this->db->get('customer');
    }

    public function get_services($services_id = null) {
        $this->db->select('services.services_id,
                            services.services_name,
                            services.services_cost');
        if ($services_id != NULL) {
            $this->db->where('services.services_id', $services_id);
        }
        $this->db->where('services.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('services');
    }

    public function check_services_master_id($services_master_id) {
        $this->db->select('services_master_id');
        $this->db->where('services_master.services_master_id', $services_master_id);
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('services_master');
    }

    public function check_services_master_id_pri($services_master_id_pri) {
        $this->db->select('services_master_id_pri');
        $this->db->where('services_master.services_master_id_pri', $services_master_id_pri);
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->count_all_results('services_master');
    }

    public function get_servicesmaster($services_master_id_pri = null) {
        if ($services_master_id_pri != NULL) {
            $this->db->where('services_master.services_master_id_pri', $services_master_id_pri);
        }
        $this->db->where('services_master.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('services_master');
    }

    public function get_detail($services_master_id_pri) {
        $this->db->select('*');
        $this->db->where('services_master_id_pri', $services_master_id_pri);
        $this->db->order_by('services_detail_id');
        return $this->db->get('services_detail');
    }

    public function get_services_detail($id = null, $limit = 1000, $start = 0) {
        $this->db->select('*');
        $this->db->where('services_master_id_pri', $id);
        $this->db->order_by('services_detail_id');
        return $this->db->get('services_detail', $limit, $start);
    }
    
    public function get_services_master_id($id) {
        $this->db->select('*');
        $this->db->where('services_master_id_pri', $id);
        $this->db->limit(1);
        return $this->db->get('services_master');
    }
    
    public function get_shop($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        return $this->db->get('shop');
    }
    
    public function get_image($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('image.image_id', $id);
        }
        return $this->db->get('image');
    }
    
    public function ref_type_tax($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('type_tax_id', $id);
        }
        return $this->db->get('ref_type_tax');
    }
    
    public function get_user($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('user_id', $id);
        }
        return $this->db->get('user');
    }

}
