<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author Prasan Srisopa
 */
class Payment extends CI_Controller {

    //put your code here
    public $group_id = 4;
    public $menu_id = 86;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('payment_model');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'datas' => $this->payment_model->getBank(),
            'receipts' => $this->payment_model->getReceipt(),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js'),
        );
        $this->renderView('payment_view', $data);
    }

    public function Receiptadd() {
        $data = array(
            'income_bank_id' => $this->input->post('income_bank_id'),
        );
        $this->load->view('modal/payment_add', $data);
    }

    public function add() {
        $data = array(
            'income_bank_id' => $this->input->post('income_bank_id'),
            'receipt_number' => $this->input->post('receipt_number'),
            'receipt_by' => $this->input->post('receipt_by'),
            'receipt_cost' => $this->input->post('receipt_cost'),
            'receipt_datepay' => $this->input->post('receipt_datepay'),
            'receipt_timepay' => $this->input->post('receipt_timepay'),
            'receipt_check' => 0,
            'user_id' => $this->session->userdata('user_id'),
            'package_id' => $this->input->post('package_id'),
            'receipt_create' => $this->mics->getDate(),
            'receipt_modify' => $this->mics->getDate(),
        );
        $receipt_id = $this->payment_model->add($data);

        if ($_FILES['receipt_evidence']['name'] != '') {
            $receipt_evidence = $this->uploadReceiptEvidence($this->session->userdata('user_id'));
            if ($receipt_evidence != NULL) {
                $datareceipt_evidence = array(
                    'receipt_evidence' => $receipt_evidence,
                );
                $this->payment_model->edit($receipt_id, $datareceipt_evidence);
            }
        }

        $package_name = $this->payment_model->getPackage($this->input->post('package_id'))->row()->package_name;

        $action_text = 'แจ้งโอนเงิน ชำระค่าแพ็กเกจ ' . $package_name;
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $user_id = $this->session->userdata('user_id');
        $this->systemlog->log_sendreceipt($action_text, $shop_id_pri, $user_id);

        redirect(base_url('payment'));
    }

    public function Receiptaddsms() {
        $data = array(
            'income_bank_id' => $this->input->post('income_bank_id'),
        );
        $this->load->view('modal/paymentsms_add', $data);
    }

    public function addsms() {
        $data = array(
            'income_bank_id' => $this->input->post('income_bank_id'),
            'receipt_number' => $this->input->post('receipt_number'),
            'receipt_by' => $this->input->post('receipt_by'),
            'receipt_cost' => $this->input->post('receipt_cost'),
            'receipt_datepay' => $this->input->post('receipt_datepay'),
            'receipt_timepay' => $this->input->post('receipt_timepay'),
            'receipt_check' => 0,
            'user_id' => $this->session->userdata('user_id'),
            'sms_id' => $this->input->post('sms_id'),
            'receipt_create' => $this->mics->getDate(),
            'receipt_modify' => $this->mics->getDate(),
        );
        $receipt_id = $this->payment_model->add($data);

        if ($_FILES['receipt_evidence']['name'] != '') {
            $receipt_evidence = $this->uploadReceiptEvidence($this->session->userdata('user_id'));
            if ($receipt_evidence != NULL) {
                $datareceipt_evidence = array(
                    'receipt_evidence' => $receipt_evidence,
                );
                $this->payment_model->edit($receipt_id, $datareceipt_evidence);
            }
        }

        $sms_name = $this->payment_model->getSMS($this->input->post('sms_id'))->row()->sms_name;

        $action_text = 'แจ้งโอนเงิน ชำระค่าแพ็กเกจ ' . $sms_name;
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $user_id = $this->session->userdata('user_id');
        $this->systemlog->log_sendreceipt($action_text, $shop_id_pri, $user_id);

        redirect(base_url('payment'));
    }

    public function uploadReceiptEvidence($user_id) {
        $this->load->library('upload');

        $path = "./assets/upload/receipt";
        //$link_part = base_url() . 'assets/upload/img/citizen_evidence';
        $file_name = 'receipt_evidence_' . $user_id . '_' . date('YmdHis');

        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'gif|jpg|jpeg|png',
            'max_size' => (8 * 1024),
            'file_name' => $file_name,
            'file_ext_tolower' => TRUE
        );
        $max_width = 800;
        $max_height = 600;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('receipt_evidence')) {
            $upload = $this->upload->data();
            $link = $upload['file_name'];
            //resize
            $config_resize['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $config_resize['maintain_ratio'] = TRUE;
            $config_resize['width'] = $max_width;
            $config_resize['height'] = $max_height;
            $this->load->library('image_lib', $config_resize);
            if ($upload['image_width'] > $max_width or $upload['image_height'] > $max_height) {
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors('', '');
                }
            }
            return $link;
        } else {
            return NULL;
        }
    }

}
