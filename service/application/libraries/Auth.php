<?php

/*
 * Class name : Auth
 * Author : Prasan Srisopa
 * Mail : prasan2533@gmail.com
 * Date Time : 25 ก.ย. 2559 14:27:26
 */

class Auth {

    public function isLoginNull() {
        $CI = & get_instance();
        if ($CI->session->userdata('islogin') != 1) {
            redirect(base_url() . 'login');
        }
    }

    public function isLogin($menu_id = NULL) {
        $CI = & get_instance();
        if ($CI->session->userdata('islogin') != 1 || $CI->accesscontrol->access($CI->session->userdata('user_id'), $menu_id) == 0) {
            redirect(base_url() . 'login');
        }
    }

}
