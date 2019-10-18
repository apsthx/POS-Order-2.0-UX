<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author Prasan Srisopa
 */
class Customer extends CI_Controller {

    //put your code here
    public $group_id = 2;
    public $menu_id = 6;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('customer_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
            'js' => array('flash-message.js', 'build/customer.js'),
        );
        $this->renderView('customer_view', $data);
    }

    public function data() {
        $customer_group_id = $this->input->post('customer_group_id');
        $status_id = $this->input->post('status_id');
        $data = array(
            'datas' => $this->customer_model->get_customer($customer_group_id, $status_id),
        );
        $this->load->view('ajax/customer_page', $data);
    }

    public function add() {
        $document = $this->accesscontrol->get_document_setting();
        $run_number = $document->customer_number_default;
        $number_id = $document->customer_id_default . $run_number;
        $data_run_number = array('customer_number_default' => $document->customer_number_default + 1);
        $this->accesscontrol->update_document_setting($data_run_number);
        $data = array(
            'customer_id' => $number_id,
            'user_id' => $this->session->userdata('user_id'),
            'customer_group_id' => $this->input->post('customer_group_id'),
            'username' => $number_id,
            'password' => md5($number_id . $number_id),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'facebook' => $this->input->post('facebook'),
            'line' => $this->input->post('line'),
            'instagram' => $this->input->post('instagram'),
            'address' => $this->input->post('address'),
            'district' => $this->input->post('district'),
            'amphoe' => $this->input->post('amphoe'),
            'province' => $this->input->post('province'),
            'zipcode' => $this->input->post('zipcode'),
            'tax_id' => $this->input->post('tax_id'),
            'tax_shop' => $this->input->post('tax_shop'),
            'tax_shop_sub' => $this->input->post('tax_shop_sub'),
            'tax_address' => $this->input->post('tax_address'),
            'status_id' => 1,
            'role_id' => 8,
            'date_create' => $this->mics->getdate(),
            'date_modify' => $this->mics->getdate()
        );
        $customer_id_pri = $this->customer_model->add($data);
        redirect(base_url('email/sendmail/' . $customer_id_pri));
    }

    public function customeredit() {
        $id = $this->input->post('customer_id_pri');
        $data = array(
            'data' => $this->customer_model->get_customer(0, 0, $id)->row(),
        );
        $this->load->view('modal/edit_customer_modal', $data);
    }

    public function edit() {
        $data = array(
            'customer_group_id' => $this->input->post('customer_group_id'),
            'fullname' => $this->input->post('fullname'),
            'email' => $this->input->post('email'),
            'tel' => $this->input->post('tel'),
            'facebook' => $this->input->post('facebook'),
            'line' => $this->input->post('line'),
            'instagram' => $this->input->post('instagram'),
            'address' => $this->input->post('address'),
            'tax_id' => $this->input->post('tax_id'),
            'tax_shop' => $this->input->post('tax_shop'),
            'tax_shop_sub' => $this->input->post('tax_shop_sub'),
            'tax_address' => $this->input->post('tax_address'),
            'date_modify' => $this->mics->getdate()
        );
        $this->customer_model->edit($this->input->post('customer_id_pri'), $data);
        redirect(base_url('customer'));
    }

    public function modaleditstatus() {
        $data = array(
            'customer_id_pri' => $this->input->post('customer_id_pri'),
        );
        $this->load->view('modal/editstatus_customer_modal', $data);
    }

    public function editstatus() {
        $customer_group_id = $this->input->post('customer_group_id');
        $status_id = $this->input->post('status_id');
        $this->customer_model->edit($this->input->post('customer_id_pri'), array('status_id' => 2));
        $data = array(
            'datas' => $this->customer_model->get_customer($customer_group_id, $status_id),
        );
        $this->load->view('ajax/customer_page', $data);
    }

    public function check_id() {
        $check = $this->customer_model->check_id($this->input->post('customer_id'));
        if ($check->num_rows() > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function modalview() {
        $data = array(
            'dataview' => $this->customer_model->get_customer(null, null, $this->input->post('customer_id_pri'))->row(),
        );
        $this->load->view('modal/view_customer_modal', $data);
    }

    public function ajaxview() {
        $data = array(
            'customer_id' => $this->input->post('customer_id'),
            'datestart' => $this->input->post('datestart'),
            'dateend' => $this->input->post('dateend'),
        );
        $this->load->view('ajax/view_customer_page', $data);
    }

    public function modaleditpassword() {
        $data = array(
            'customer_id_pri' => $this->input->post('customer_id_pri'),
            'username' => $this->input->post('username'),
        );
        $this->load->view('modal/editpassword_customer_modal', $data);
    }

    public function editpassword() {
        $customer_group_id = $this->input->post('customer_group_id');
        $status_id = $this->input->post('status_id');
        $this->customer_model->edit($this->input->post('customer_id_pri'), array('password' => md5($this->input->post('username') . '1234')));
        $data = array(
            'datas' => $this->customer_model->get_customer($customer_group_id, $status_id),
        );
        $this->load->view('ajax/customer_page', $data);
    }

    public function import() {
        $lines = explode("\r\n", file_get_contents($_FILES["file"]["tmp_name"]));
        $data = array();
        $i = 0;
        echo sizeof($lines);
        foreach ($lines as $line) {
            $explode = explode(",", $line);
            echo '<pre>';
            if ($i != 0) {
                if (sizeof($explode) > 1) {
                    $data[] = array(
                        'fullname' => $explode[0],
                        'email' => $explode[1],
                        'tel' => $explode[2],
                        'facebook' => $explode[3],
                        'line' => $explode[4],
                        'instagram' => $explode[5],
                        'address' => $explode[6],
                        'district' => $explode[7],
                        'amphoe' => $explode[8],
                        'province' => $explode[9],
                        'zipcode' => $explode[10],
                        'tax_id' => $explode[11],
                        'tax_shop' => $explode[12],
                        'tax_shop_sub' => $explode[13],
                        'tax_address' => $explode[14]
                    );
                }
            }
            $i++;
        }
        foreach ($data as $row) {
            if ($row['fullname'] == '' || $row['email'] == '') {
                $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid orange;"><i class="fa fa-ban" style="color: #D33E3E;"></i>&nbsp;ต้องกรอก fullname และ email ให้ครบ</div>');
                redirect(base_url('customer'));
            }
        }
        //$max = $this->customer_model->get_maxcustomer();
        //$customer_id_default = $this->customer_model->get_shop_setting_document($this->session->userdata('shop_id_pri'))->row()->customer_id_default;
        foreach ($data as $row) {
            //$max++;
            //$customer_id = $customer_id_default . $max;
            $document = $this->accesscontrol->get_document_setting();
            $run_number = $document->customer_number_default;
            $number_id = $document->customer_id_default . $run_number;
            $data_run_number = array('customer_number_default' => $document->customer_number_default + 1);
            $this->accesscontrol->update_document_setting($data_run_number);

            $add = array(
                'customer_id' => $number_id,
                'user_id' => $this->session->userdata('user_id'),
                'customer_group_id' => $this->input->post('customer_group_id'),
                'username' => $number_id,
                'password' => md5($number_id . $number_id),
                'fullname' => $row['fullname'],
                'email' => $row['email'],
                'tel' => $row['tel'],
                'facebook' => $row['facebook'],
                'line' => $row['line'],
                'instagram' => $row['instagram'],
                'address' => $row['address'],
                'district' => $row['district'],
                'amphoe' => $row['amphoe'],
                'province' => $row['province'],
                'zipcode' => $row['zipcode'],
                'tax_id' => $row['tax_id'],
                'tax_shop' => $row['tax_shop'],
                'tax_shop_sub' => $row['tax_shop_sub'],
                'tax_address' => $row['tax_address'],
                'status_id' => 1,
                'role_id' => 8,
                'date_create' => $this->mics->getdate(),
                'date_modify' => $this->mics->getdate()
            );

            $customer_id_pri = $this->customer_model->add($add);
            file_get_contents(base_url() . 'email/sendmail/' . $customer_id_pri);
        }
        $this->session->set_flashdata('flash_message', '<div class="col-lg-12" style="padding: 7px; font-size: 14px; border: 2px solid green;"><i class="fa fa-check" style="color: green;"></i>&nbsp;เพิ่มลูกค้าสำเร็จ</div>');
        redirect(base_url('customer'));
    }

}
