<?php

/*
 * SYSTEM NAME  : MSI-A
 * VERSION	: 2016 Build 2.0
 * AUTHOR 	: APSTH
 */

/*
 * Class name : Accesscontrol
 * Author : Prasan Srisopaa
 * Mail : Prasan2533@gmail.com
 */

class Accesscontrol extends CI_Model {

    public function getGroupMenuByRole($role_id) {
        $this->db->select('group_menu.group_menu_id,
                            group_menu.group_menu_name,
                            group_menu.group_menu_icon,
                            group_menu.group_menu_public,
                            group_menu.group_menu_sort,
                            group_menu.date_modify');
        $this->db->join('menu', 'menu.group_menu_id = group_menu.group_menu_id');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->group_by('group_menu.group_menu_id');
        $this->db->order_by('group_menu.group_menu_sort');
        return $this->db->get('group_menu');
    }

    public function getMenuByGroup($group_menu_id, $role_id) {
        $this->db->select('menu.menu_link,menu.menu_id,menu.menu_name,menu.menu_status_id');
        $this->db->from('group_menu');
        $this->db->join('menu', 'menu.group_menu_id = group_menu.group_menu_id');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('group_menu.group_menu_id', $group_menu_id);
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->where_in('menu.menu_status_id', array(1, 3));
        $this->db->order_by('menu.menu_sort');
        return $this->db->get();
    }

    public function accessMenu($menu_id, $role_id) {
        $this->db->select('menu.menu_id');
        $this->db->join('map_menu_role', 'map_menu_role.menu_id = menu.menu_id');
        $this->db->where('menu.menu_id', $menu_id);
        $this->db->where('menu.menu_status_id !=', 2);
        $this->db->where('map_menu_role.role_id', $role_id);
        $this->db->limit(1);
        return $this->db->count_all_results('menu');
    }

    public function accessMenuPackage($menu_id, $package_id) {
        $this->db->join('map_menu_package', 'map_menu_package.menu_id = menu.menu_id');
        $this->db->where('map_menu_package.menu_id', $menu_id);
        $this->db->where('map_menu_package.package_id', $package_id);
        $this->db->limit(1);
        if ($this->db->count_all_results('menu') == 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getNameTitle($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุเมนู';
        } else {
            $this->db->select('menu_name');
            $this->db->from('menu');
            $this->db->where('menu.menu_id', $id);
            $row = $this->db->get()->row();
            return $row->menu_name;
        }
    }

    public function getNameGroup($id = NULL) {
        if ($id == NULL) {
            return 'ยังไม่ได้ระบุกลุ่มเมนู';
        } else {
            $this->db->select('group_menu_name');
            $this->db->from('group_menu');
            $this->db->where('group_menu.group_menu_id', $id);
            $row = $this->db->get()->row();
            return $row->group_menu_name;
        }
    }

    public function getIcon($id = NULL) {
        $this->db->select('group_menu_icon');
        $this->db->from('group_menu');
        $this->db->where('group_menu.group_menu_id', $id);
        $row = $this->db->get()->row();
        return $row->group_menu_icon;
    }

    public function getUser($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        return $this->db->get('user');
    }

    public function getMyShop() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('shop')->row();
    }

    public function get_document_setting() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('shop_setting_document')->row();
    }

    public function get_transport_setting() {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('transport_setting')->row();
    }

    public function update_document_setting($data) {
        $this->db->where('shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->update('shop_setting_document', $data);
    }

    public function getRole($id = null) {
        $this->db->select('*');
        if ($id != NULL) {
            $this->db->where('role_id', $id);
        }
        return $this->db->get('role');
    }

    public function checkLogin($user_id, $regenerate_login) {
        $this->db->select('login_check.login_id');
        $this->db->from('login_check');
        $this->db->where('login_check.user_id', $user_id);
        $this->db->where('login_check.regenerate_login', $regenerate_login);
        $this->db->where('login_check.ip_address', $this->input->ip_address());
        return $this->db->count_all_results();
    }

    public function checkLoginAdmin($admin_id, $regenerate_login) {
        $this->db->select('login_check_admin.login_id');
        $this->db->from('login_check_admin');
        $this->db->where('login_check_admin.admin_id', $admin_id);
        $this->db->where('login_check_admin.regenerate_login', $regenerate_login);
        $this->db->where('login_check_admin.ip_address', $this->input->ip_address());
        return $this->db->count_all_results();
    }

    public function getImage($id) {
        $this->db->where('image.image_id', $id);
        $this->db->limit(1);
        return $this->db->get('image')->row();
    }

    public function checkLogincustomer($user_id, $regenerate_login) {
        $this->db->select('login_check_customer.login_id');
        $this->db->from('login_check_customer');
        $this->db->where('login_check_customer.customer_id_pri', $user_id);
        $this->db->where('login_check_customer.regenerate_login', $regenerate_login);
        $this->db->where('login_check_customer.ip_address', $this->input->ip_address());
        return $this->db->count_all_results();
    }

    public function getCustomer($user_id) {
        $this->db->where('customer_id_pri', $user_id);
        $this->db->limit(1);
        return $this->db->get('customer');
    }

    public function getUserPackage($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        return $this->db->get('user_package');
    }

    public function getMenuPackage($menu_id, $package_id) {
        $this->db->where('menu_id', $menu_id);
        $this->db->where('package_id', $package_id);
        $this->db->limit(1);
        return $this->db->get('map_menu_package')->num_rows();
    }

    public function getPackage($package_id) {
        $this->db->where('package_id', $package_id);
        $this->db->limit(1);
        return $this->db->get('package');
    }

    public function checkuseuser($package_shop_id_pri = null) {
        $this->db->where('user_package.package_shop_id_pri', $package_shop_id_pri);
        return $this->db->get('user_package')->num_rows();
    }

    public function checkuseshop($package_shop_id_pri = null) {
        $this->db->where('shop.shop_create_id_pri', $package_shop_id_pri);
        $this->db->where('shop.type_shop_id', 2);
        return $this->db->get('shop')->num_rows();
    }

    public function checkuseagent($package_shop_id_pri = null) {
        $this->db->where('shop.shop_create_id_pri', $package_shop_id_pri);
        $this->db->where('shop.type_shop_id', 3);
        return $this->db->get('shop')->num_rows();
    }

    public function checksms() {
        $this->db->where('setting_sms.shop_id_pri', $this->session->userdata('shop_id_pri'));
        $this->db->limit(1);
        return $this->db->get('setting_sms')->row();
    }

    public function checkmenugroup($group_menu_id) {
        $this->db->join('group_menu', 'menu.group_menu_id = group_menu.group_menu_id');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        return $this->db->get('menu')->num_rows();
    }

    public function checkmenupackage($group_menu_id, $package_id) {
        $this->db->join('menu', 'map_menu_package.menu_id = menu.menu_id');
        $this->db->where('menu.group_menu_id', $group_menu_id);
        $this->db->where('map_menu_package.package_id', $package_id);
        return $this->db->get('map_menu_package')->num_rows();
    }
    
    public function checkShop($shop_id_pri) {
        $this->db->where('shop_id_pri', $shop_id_pri);
        $this->db->limit(1);
        return $this->db->get('shop')->row();
    }

    public function getemailsms() {
        $this->db->limit(1);
        return $this->db->get('setting_email')->row();
    }

    public function getadmin($id) {
        $this->db->where('admin_id', $id);
        $this->db->limit(1);
        return $this->db->get('admin')->row();
    }

}
