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
class Alienate extends CI_Controller {

    public $group_id = 9;
    public $menu_id = 23;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('alienate_model');
    }

    public function index() {
        $data = array(
            'alienate_category_id' => $this->input->get('category'),
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js'),
            'js' => array('build/alienate.js'),
        );
        $this->renderView('alienate_view', $data);
    }

    public function ajax() {
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->alienate_model->get_inform_payment(NULL, $status_id),
        );
        $this->load->view('ajax/alienate_page', $data);
    }

    public function modal_add() {
        $this->load->view('modal/alienate_add_modal');
    }

    public function modal_edit() {
        $id = $this->input->post('id');
        $data = array(
            'data' => $this->alienate_model->get_inform_payment($id, 99)->row()
        );
        $this->load->view('modal/alienate_edit_modal', $data);
    }

    public function add() {       
        $data = array(
            'bank_id' => $this->input->post('bank_id'),
            'date_pay' => $this->input->post('date_pay'),
            'time_pay' => $this->input->post('time_pay'),
            'money' => $this->input->post('money'),
            'invoice' => $this->input->post('invoice'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_email' => $this->input->post('customer_email'),
            'customer_tel' => $this->input->post('customer_tel'),
            'status_inform_id' => $this->input->post('status_inform_id'),
            'shop_id_pri' => $this->session->userdata('shop_id_pri'),
            'date_modify' => $this->mics->getDate()
        );
        //echo $this->upload_pic($this->input->post('customer_id').'-'.$this->input->post('customer_name').'-'.$this->input->post('date_pay').'-'.date('YmdHis'));
        $data['image_id'] = $this->upload_pic($this->input->post('customer_id').'-'.$this->input->post('customer_name').'-'.$this->input->post('date_pay').'-'.date('YmdHis'));
        $this->db->insert('inform_payment', $data);
        redirect(base_url() . 'alienate');
    }
    
    private function upload_pic($file_name) {
        $path = "./assets/upload/img/"; //server path
        $file_name_up = $file_name;
        $config['upload_path'] = $path;
        $config['file_name'] = $file_name_up;
        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 8192;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $data = array(
                'image_name' => $this->upload->data('file_name'),
                'date_modify' => $this->mics->getDate()
            );
            $this->db->insert('image', $data);
            return $this->db->insert_id();
        } else {
            return 2;
        }
    }

    public function edit() {
//        $status_inform_id = $this->input->post('status_inform_id');
//        $status_inform_id_befor = $this->input->post('status_inform_id_befor');
//        $money = $this->input->post('money');
//        $bank_id = $this->input->post('bank_id');
        $data = array(
            'invoice' => $this->input->post('invoice'),
            'inform_payment_id' => $this->input->post('inform_payment_id'),
            'status_inform_id' => $this->input->post('status_inform_id'),
            'user_id' => $this->session->userdata('user_id'),
            'date_modify' => $this->mics->getDate()
        );
        $this->alienate_model->update_data($data);
//        if ($status_inform_id_befor != $status_inform_id) {
//            $user = $this->accesscontrol->getUser($this->session->userdata('user_id'))->row();
//            if ($status_inform_id_befor != 2 && $status_inform_id == 2) {
//                $bank = $this->alienate_model->get_bank($bank_id)->row();
//                $bank_update = array(
//                    'bank_id' => $bank->bank_id,
//                    'bank_money' => $bank->bank_money + $money,
//                    'date_modify' => $this->mics->getDate()
//                );
//                $this->alienate_model->bank_update($bank_update);
//                $this->systemlog->log_bank($user->fullname . ' ได้เพิ่มเงินใน ' . $bank->bank_name . ' จากรายการแจ้งโอน status_inform_id = ' . $status_inform_id);
//            } elseif ($status_inform_id_befor == 2) {
//                $bank = $this->alienate_model->get_bank($bank_id)->row();
//                $bank_update = array(
//                    'bank_id' => $bank->bank_id,
//                    'bank_money' => $bank->bank_money - $money,
//                    'date_modify' => $this->mics->getDate()
//                );
//                $this->alienate_model->bank_update($bank_update);
//                $this->systemlog->log_bank($user->fullname . ' ได้ลดเงินใน ' . $bank->bank_name . ' จากการยกเลิกรายการแจ้งโอน status_inform_id = ' . $status_inform_id);
//            }
//        }
        redirect(base_url() . 'alienate');
    }

}
