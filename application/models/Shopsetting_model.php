<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shop_model
 *
 * @author Prasan Srisopa
 */
class Shopsetting_model extends CI_Model {

    public function get_shop() {
        $this->db->select('shop.shop_id_pri,
                            shop.shop_id,
                            shop.shop_name,
                            shop.tax_id,
                            shop.tel_shop,
                            shop.fax_shop,
                            shop.website_shop,
                            shop.email_shop,
                            shop.address_shop,
                            shop.status_shop_id,
                            image.image_id,
                            image.image_name,
                            shop.date_create,
                            ref_status_shop.status_shop_name,
                            ref_status_shop.status_shop_id,
                            ref_type_shop.type_shop_name,
                            shop.shop_promptpay_id,
                            shop.shop_promptpay_name');
        $this->db->join('image', 'shop.image_id = image.image_id');
        $this->db->join('ref_status_shop', 'shop.status_shop_id = ref_status_shop.status_shop_id');
        $this->db->join('ref_type_shop', 'shop.type_shop_id = ref_type_shop.type_shop_id');
        $this->db->where('shop.shop_id_pri', $this->session->userdata('shop_id_pri'));
        return $this->db->get('shop');
    }

    public function update_shop($data) {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('shop', $data);
    }

}
