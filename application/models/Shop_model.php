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
class Shop_model extends CI_Model {

    //put your code here
    public function get_shop($id = null) {
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
                            image.image_name,
                            shop.date_create,
                            ref_status_shop.status_shop_name,
                            ref_status_shop.status_shop_id,
                            ref_type_shop.type_shop_name,
                            user.user_id,
                            user.username,
                            user.fullname');
        $this->db->join('image', 'shop.image_id = image.image_id');
        $this->db->join('ref_status_shop', 'shop.status_shop_id = ref_status_shop.status_shop_id');
        $this->db->join('ref_type_shop', 'shop.type_shop_id = ref_type_shop.type_shop_id');
        $this->db->join('user', 'user.shop_id_pri = shop.shop_id_pri');
        $this->db->where('shop.shop_create_id', $this->session->userdata('shop_id_pri'));
        $this->db->where('user.type_user_id', 1);
        if ($id != NULL) {
            $this->db->where('shop.shop_id_pri', $id);
        }
        $this->db->order_by('shop.shop_id_pri', 'DESC');
        return $this->db->get('shop');
    }

    public function edit($id, $data) {
        $this->db->where('user.user_id', $id);
        $this->db->update('user', $data);
    }

}
