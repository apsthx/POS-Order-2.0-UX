<?php

class Wallet extends CI_Controller {

    public $group_id = 9;
    public $menu_id = 11;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('wallet_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('build/wallet.js'),
            'datas' => $this->wallet_model->get_bank()
        );
        $this->renderView('wallet_view', $data);
    }

    public function modal_add() {
        $this->load->view('modal/wallet_add_modal');
    }

    public function modal_edit() {
        $id = $this->input->post('id');
        $data = array(
            'row' => $this->wallet_model->get_bank($id)->row()
        );
        $this->load->view('modal/wallet_edit_modal', $data);
    }

    public function modal_edit_money() {
        $id = $this->input->post('id');
        $data = array(
            'row' => $this->wallet_model->get_bank($id)->row()
        );
        $this->load->view('modal/wallet_edit_money_modal', $data);
    }

    public function modal_delete() {
        $id = $this->input->post('id');
        $count = $this->wallet_model->count_money_bank($id);
        if ($count > 0) {
            $this->load->view('modal/delete_not_modal');
        } else {
            $data = array(
                'id' => $id,
                'link' => base_url() . 'wallet/delete'
            );
            $this->load->view('modal/delete_modal', $data);
        }
    }

    public function add() {
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'bank_number' => $this->input->post('bank_number'),
            'bank_name' => $this->input->post('bank_name'),
            'bank_fullname' => $this->input->post('bank_fullname'),
            'bank_money' => 0,
            'type_bank_id' => 2,
            'date_modify' => $this->mics->getDate(),
        );
        $this->wallet_model->add($data);
//        -- add log --
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_bank($user->username . ' ได้เพิ่ม ' . $this->input->post('bank_name'));
        redirect('wallet');
    }

    public function edit() {
        $data = array(
            'bank_id' => $this->input->post('bank_id'),
            'bank_number' => $this->input->post('bank_number'),
            'bank_name' => $this->input->post('bank_name'),
            'bank_fullname' => $this->input->post('bank_fullname'),
            'bank_money' => $this->input->post('bank_money'),
            'date_modify' => $this->mics->getDate(),
        );
        $this->wallet_model->edit($data);
//        -- add log --
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_bank($user->username . ' ได้แก้ไข ' . $this->input->post('bank_name'));
        redirect('wallet');
    }

    public function edit_money() {
        $data = array(
            'bank_id' => $this->input->post('bank_id'),
            'bank_money' => $this->input->post('bank_money'),
            'date_modify' => $this->mics->getDate(),
        );
        $this->wallet_model->edit($data);
//        -- add log --
        $bank = $this->wallet_model->get_bank($this->input->post('bank_id'))->row();
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_bank($user->fullname . ' ได้แก้ไข ' . $bank->bank_name);
        redirect('wallet');
    }

    public function delete() {
        $id = $this->input->post('id');
        $bank = $this->wallet_model->get_bank($id)->row();
        $this->wallet_model->delete_bank($id);
//        -- add log --
        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_bank($user->username . ' ได้ลบ ' . $bank->bank_name);
        redirect('wallet');
    }

}
