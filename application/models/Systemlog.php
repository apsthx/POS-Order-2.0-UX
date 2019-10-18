<?php

/*
 * SYSTEM NAME  : Receipt Finance of RMUTL
 * VERSION	: 2016 Build 2.0
 * AUTHOR 	: RMUTL
 */

/*
 * Class name : Systemlog
 * Author : Prasan Srisopa
 * Mail : prasan2533@gmail.com
 */

class Systemlog extends CI_Model {

    //------- ** update std realtime -----------------
    public function update_std_realtime($std_id, $action_text) {
        $data = array(
            'std_id' => "$std_id",
            'action_text' => $action_text,
            'data_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_warehouse_std', $data);
    }

    //------- ** Add System Log -----------------
    public function getAgent() {
        $this->load->library('user_agent');
        $agent = $this->agent->browser() . '/' . $this->agent->version();
        $agent = $agent . ' ' . $this->agent->platform();
        $agent = $agent . ' ' . $this->agent->mobile();
        return $agent;
    }

    //------ Log Add Login User-----------------
    public function addUserLogin($user_id, $text) {
        $data = array(
            'user_id' => $user_id,
            'log_text' => $text,
            'log_ip_address' => $this->input->ip_address(),
            'log_browser' => $this->getAgent(),
            'log_time' => $this->mics->getDate()
        );
        $this->db->insert('log_user_login', $data);
    }

    //------ check Login------------------------------------------------------------
    public function checkAddLogin($user_id) {
        $this->db->select('login_check.login_id');
        $this->db->from('login_check');
        $this->db->where('login_check.user_id', $user_id);
        return $this->db->count_all_results();
    }

    //------ add Login Check-----------------
    public function addLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'user_id' => $user_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->insert('login_check', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheck($user_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->where('login_check.user_id', $user_id);
        $this->db->update('login_check', $data);
    }

    //------ update Login Check-----------------
    public function deleteLoginCheck($user_id) {
        $this->db->where('login_check.user_id', $user_id);
        $this->db->delete('login_check');
    }

    //------ check Login------------------------------------------------------------
    public function checkAddLoginAdmin($admin_id) {
        $this->db->select('login_check_admin.login_id');
        $this->db->from('login_check_admin');
        $this->db->where('login_check_admin.admin_id', $admin_id);
        return $this->db->count_all_results();
    }

    //------ add Login Check-----------------
    public function addLoginCheckAdmin($admin_id, $regenerate_login) {
        $data = array(
            'admin_id' => $admin_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->insert('login_check_admin', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheckAdmin($admin_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->where('login_check_admin.admin_id', $admin_id);
        $this->db->update('login_check_admin', $data);
    }

    //------ update Login Check-----------------
    public function deleteLoginCheckAdmin($admin_id) {
        $this->db->where('login_check_admin.admin_id', $admin_id);
        $this->db->delete('login_check_admin');
    }

    //------- ** Log -----------------
    public function log_bank($action_text) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_bank', $data);
    }

    public function log_receipt($receipt_master_id_pri, $action_text) {
        $data = array(
            'action_text' => $action_text,
            'receipt_master_id_pri' => $receipt_master_id_pri,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_receipt', $data);
    }

    public function log_expense($expense_id, $action_text) {
        $data = array(
            'action_text' => $action_text,
            'expense_id' => $expense_id,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_expense', $data);
    }

    public function log_transportexport() {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_transportexport', $data);
    }

    public function log_services($services_master_id_pri, $action_text) {
        $data = array(
            'action_text' => $action_text,
            'services_master_id_pri' => $services_master_id_pri,
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_services', $data);
    }

    //------ check Login------------------------------------------------------------
    public function checkAddLogincustomer($user_id) {
        $this->db->select('login_check_customer.login_id');
        $this->db->from('login_check_customer');
        $this->db->where('login_check_customer.customer_id_pri', $user_id);
        return $this->db->count_all_results();
    }

    //------ add Login Check-----------------
    public function addLoginCheckcustomer($user_id, $regenerate_login) {
        $data = array(
            'customer_id_pri' => $user_id,
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->insert('login_check_customer', $data);
    }

    //------ update Login Check-----------------
    public function updateLoginCheckcustomer($user_id, $regenerate_login) {
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'regenerate_login' => $regenerate_login,
            'login_last_time' => $this->mics->getDate()
        );
        $this->db->where('login_check_customer.customer_id_pri', $user_id);
        $this->db->update('login_check_customer', $data);
    }
    
    public function log_sendsms($action_text, $shop_id_pri, $user_id) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $user_id,           
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_sendsms', $data);
    }

    public function log_sendemail($action_text, $shop_id_pri, $user_id) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $user_id,           
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_sendemail', $data);
    }
    
    public function log_package($action_text, $shop_id_pri) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $shop_id_pri,         
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_package', $data);
    }
    
    public function log_creditsms($action_text, $shop_id_pri) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $shop_id_pri,         
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_creditsms', $data);
    }
    
    public function log_sendreceipt($action_text, $shop_id_pri, $user_id) {
        $data = array(
            'action_text' => $action_text,
            'shop_id_pri' => $shop_id_pri,
            'user_id' => $user_id,           
            'date_modify' => $this->mics->getDate()
        );
        $this->db->insert('log_sendreceipt', $data);
    }
}
