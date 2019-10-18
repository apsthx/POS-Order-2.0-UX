<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->accesscontrol->checkLoginAdmin($this->session->userdata('admin_id'), $this->session->userdata('regenerate_login')) == 1) {
            redirect(base_url() . 'admin/home');
        }
        $data = array(
            'title' => 'เข้าสู่ระบบ',
        );
        $this->load->view('admin/login_view', $data);
    }

    public function doLogin() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $admins = $this->db->select('*')->where('username', $username)->where('password', $password)->limit(1)->get('admin');

        if ($admins->num_rows() > 0) {
            $admin = $admins->row();
            $sessiondata = array(
                'admin_id' => $admin->admin_id,
                'regenerate_login' => rand(100000, 999999)
            );
            $this->session->set_userdata($sessiondata);
            if ($this->systemlog->checkAddLoginAdmin($admin->admin_id) == 1) {
                $this->systemlog->updateLoginCheckAdmin($admin->admin_id, $this->session->userdata('regenerate_login'));
            } else {
                $this->systemlog->addLoginCheckAdmin($admin->admin_id, $this->session->userdata('regenerate_login'));
            }
            redirect(base_url() . 'admin/home');
        } else {
            $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid #f77474;"><i class="fa fa-times-circle" style="color: #D33E3E;"></i>&nbsp;Username or Password ไม่ถูกต้อง</div>');
            redirect(base_url('admin'));
        }
    }

    public function logout() {
        $this->systemlog->deleteLoginCheckAdmin($this->session->userdata('admin_id'));
        $this->session->sess_destroy();
        redirect(base_url() . 'admin');
    }

}
