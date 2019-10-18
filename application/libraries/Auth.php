<?php

/*
 * SYSTEM NAME  : MSI-A
 * VERSION	: 2018	Build 0.1
 * AUTHOR 	: APSTH
 */

/*
 * Class name : Auth
 * Author : Prasan Srisopa
 * Mail : Prasan2533@gmail.com
 * Date Time : 25 ก.พ. 2561 13:42:26
 */

class Auth {

    public function isLoginNull() {
        $CI = & get_instance();
        if ($CI->session->userdata('user_id') == NULL || $CI->accesscontrol->checkLogin($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
            if ($CI->session->userdata('user_id') == NULL || $CI->accesscontrol->checkLogincustomer($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
                redirect(base_url() . 'login', 'refresh');
            }
        }
    }

    public function isLogin($menu_id = NULL) {
        $CI = & get_instance();
        $role_id = $CI->session->userdata('role_id');
        if ($role_id != 8) {
            $package = $CI->accesscontrol->getPackage($CI->session->userdata('package_id'))->row();
            $package_shop = $CI->accesscontrol->getUserPackage($CI->session->userdata('user_id'))->row();
            $stop_usedate = date('Y-m-d', strtotime($package_shop->user_package_modify . "+ $package->package_usedate day"));
            if (date('Y-m-d') > $stop_usedate) { //หมดอายุ
                $CI->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid orange;color: red;"><i class="fa fa-ban" style="color: #D33E3E;"></i>&nbsp;ร้านของท่านถูกระงับใช้งาน เนื่องจากแพ็กเกจหมดอายุ โปรดติดต่อ Admin</div>');
                redirect(base_url() . 'login', 'refresh');
            }
            else if ($CI->accesscontrol->checkShop($package_shop->package_shop_id_pri)->status_shop_id != 1) {
                $CI->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid orange;color: red;"><i class="fa fa-ban" style="color: #D33E3E;"></i>&nbsp;ร้านของท่านถูกระงับใช้งาน โปรดติดต่อ Admin</div>');
                redirect(base_url() . 'login', 'refresh');
            }
        }
        if ($CI->session->userdata('user_id') == NULL || $CI->accesscontrol->accessMenu($menu_id, $role_id) == 0 || $CI->accesscontrol->accessMenuPackage($menu_id, $CI->session->userdata('package_id')) == 0 || $CI->accesscontrol->checkLogin($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
            if ($CI->session->userdata('user_id') == NULL || $CI->accesscontrol->accessMenu($menu_id, $role_id) == 0 || $CI->accesscontrol->checkLogincustomer($CI->session->userdata('user_id'), $CI->session->userdata('regenerate_login')) == 0) {
                redirect(base_url() . 'login', 'refresh');
            }
        }
    }

    public function isLoginAdmin() {
        $CI = & get_instance();
        if ($CI->session->userdata('admin_id') == NULL || $CI->accesscontrol->checkLoginAdmin($CI->session->userdata('admin_id'), $CI->session->userdata('regenerate_login')) == 0) {
            redirect(base_url() . 'admin/login', 'refresh');
        }
    }

}
