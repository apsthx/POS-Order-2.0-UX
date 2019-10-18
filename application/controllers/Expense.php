<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author Prasan Srisopa
 */
class Expense extends CI_Controller {

    public $group_id = 9;
    public $menu_id = 22;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('expense_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js'),
            'js' => array('build/expense.js'),
        );
        $this->renderView('expense_view', $data);
    }

    public function ajax() {
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->expense_model->get_data(NULL, $status_id),
        );
        $this->load->view('ajax/expense_page', $data);
    }

    public function modal_add() {
        $this->load->view('modal/expense_add_modal');
    }

    public function modal_edit() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->expense_model->get_data($id, 99)->row()
        );
        $this->load->view('modal/expense_edit_modal', $data);
    }

    public function add() {
        $bank_id = $this->input->post('bank_id');
        $money = $this->input->post('expense_money');
        $expense_name = $this->input->post('expense_name');
        $data = array(
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'bank_id' => $bank_id,
            'expense_name' => $expense_name,
            'expense_detail' => $this->input->post('expense_detail'),
            'expense_money' => $money,
            'expense_date_pay' => $this->input->post('expense_date_pay'),
            'expense_refer' => $this->input->post('expense_refer'),
            'expense_shop' => $this->input->post('expense_shop'),
            'expense_shop_address' => $this->input->post('expense_shop_address'),
            'expense_shop_email' => $this->input->post('expense_shop_email'),
            'expense_shop_tel' => $this->input->post('expense_shop_tel'),
            'status_expense_id' => $this->input->post('status_expense_id'),
            'date_modify' => $this->mics->getDate()
        );
        $file_name = $this->upload_pic();
        $data['expense_image'] = $file_name;
        $this->db->insert('expense', $data);
        $expense_id = $this->db->insert_id();

        $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
        $this->systemlog->log_expense($expense_id, $user->fullname . ' ได้สร้างรายการค่าใช้จ่าย ' . $expense_name);

        if ($this->input->post('status_expense_id') == 2) {
            $bank = $this->expense_model->get_bank($bank_id)->row();
            $bank_update = array(
                'bank_id' => $bank->bank_id,
                'bank_money' => $bank->bank_money - $money,
                'date_modify' => $this->mics->getDate()
            );
            $this->expense_model->bank_update($bank_update);
            $this->systemlog->log_bank($user->fullname . ' ได้จ่ายเงินจาก ' . $bank->bank_name . ' จากรายการ expense_id = ' . $expense_id);
        }

        redirect(base_url() . 'expense');
    }

    private function upload_pic() {
        $path = "./assets/upload/img/"; //server path
        $config['upload_path'] = $path;
        $config['file_name'] = 'expense_' . date("YmdHis");
        $config['allowed_types'] = "jpg|gif|png";
        $config['max_size'] = 1024 * 5;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            return NULL;
        }
    }

    public function edit() {
        $expense_id = $this->input->post('expense_id');
        $status_expense_id = $this->input->post('status_expense_id');
        $status_expense_id_befor = $this->input->post('status_expense_id_befor');
        $expense_money = $this->input->post('expense_money');
        $bank_id = $this->input->post('bank_id');
        $data = array(
            'expense_id' => $expense_id,
            'status_expense_id' => $this->input->post('status_expense_id'),
            'date_modify' => $this->mics->getDate()
        );
        $this->expense_model->update_data($data);
        if ($status_expense_id_befor != $status_expense_id) {
            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
            if ($status_expense_id == 2) {
                $bank = $this->expense_model->get_bank($bank_id)->row();
                $bank_update = array(
                    'bank_id' => $bank->bank_id,
                    'bank_money' => $bank->bank_money - $expense_money,
                    'date_modify' => $this->mics->getDate()
                );
                $this->expense_model->bank_update($bank_update);
                $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . ' จากรายการค่าใช้จ่าย expense_id = ' . $expense_id);
            } elseif ($status_expense_id_befor == 2) {
                $bank = $this->expense_model->get_bank($bank_id)->row();
                $bank_update = array(
                    'bank_id' => $bank->bank_id,
                    'bank_money' => $bank->bank_money + $expense_money,
                    'date_modify' => $this->mics->getDate()
                );
                $this->expense_model->bank_update($bank_update);
                $this->systemlog->log_bank($user->fullname . ' ได้เพิ่มเงินใน ' . $bank->bank_name . ' จากรายการค่าใช้จ่าย expense_id = ' . $expense_id);
            }
        }
        redirect(base_url() . 'expense');
    }

}
