<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SMS
 *
 * @author Prasan Srisopa
 */
class Sms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('thsms');
        $this->load->model('sms_model');
    }

    public function index() {
        
    }

    public function sendSMSreceipt($receipt_master_id_pri) {
        $sms = new thsms();

        $datareceipt = $this->sms_model->get_receipt_master_id($receipt_master_id_pri)->row();
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $datasms = $this->sms_model->get_sms(null, $shop_id_pri)->row();
//        $sms->username = 'walklive7';$sms->password = 'faa377';
        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        $tel = $datareceipt->customer_tel;
        $text = 'ได้รับการชำระเงินแล้ว -> เลขใบเสร็จ : ' . $datareceipt->receipt_master_id;
//      $credit = $sms->getCredit(); print_r($credit);echo $credit[2];
        if ($datasms->credit_balance > 0) {
            $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
//          print_r($creditsend);echo $creditsend[1];echo $creditsend[3];
            if ($creditsend[1] == 'OK') {
                $data = array(
                    'credit_sum' => $datasms->credit_sum + 1,
                    'credit_balance' => $datasms->credit_balance - 1,
                    'credit_all' => $creditsend[3],
                );
                $this->sms_model->edit($datasms->setting_sms_id, $data);
                $action_text = $text . ' ส่งไปยัง ' . $tel;
                //$shop_id_pri = $this->session->userdata('shop_id_pri');
                $user_id = $this->session->userdata('user_id');
                $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function sendSMStransport($receipt_master_id_pri, $head_sms_id) {
        $sms = new thsms();

        $datareceipt = $this->sms_model->get_receipt_master_id($receipt_master_id_pri)->row();
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $datasms = $this->sms_model->get_sms(null, $shop_id_pri)->row();

//        $sms->username = 'walklive7';
//        $sms->password = 'faa377';
        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        $tel = $datareceipt->customer_tel;
        if ($head_sms_id == 'null') {
            $head_sms_name = 'เลขใบเสร็จ : ' . $datareceipt->receipt_master_id;
        } else {
            $head_sms_name = $this->sms_model->get_head_sms($head_sms_id)->row()->head_sms_name;
        }
        $text = $head_sms_name . ' -> เลขที่พัสดุ : ' . $datareceipt->transport_tracking_id;

//        $credit = $sms->getCredit();
//        print_r($credit);
//        echo $credit[2];
        if ($datasms->credit_balance > 0) {
            $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);

//        print_r($creditsend);  
//        echo $creditsend[1];
//        echo $creditsend[3];

            if ($creditsend[1] == 'OK') {
                $data = array(
                    'credit_sum' => $datasms->credit_sum + 1,
                    'credit_balance' => $datasms->credit_balance - 1,
                    'credit_all' => $creditsend[3],
                );
                $this->sms_model->edit($datasms->setting_sms_id, $data);
                $action_text = $text . ' ส่งไปยัง ' . $tel;
                //$shop_id_pri = $this->session->userdata('shop_id_pri');
                $user_id = $this->session->userdata('user_id');
                $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    public function sendSMSadvt() {
        $sends = $this->input->post('sends');
        $customer_id_pri = $this->input->post('customer_id_pri');
        $customer_group_id = $this->input->post('customer_group_id');
        $start_customer_id = $this->input->post('start_customer_id');
        $end_customer_id = $this->input->post('end_customer_id');
        $advt_header = $this->input->post('advt_header');
//        echo $advt_type.'/'.$sends.'/'.$customer_id_pri.'/'.$customer_group_id.'/'.$start_customer_id
//                .'/'.$end_customer_id.'/'.$advt_header.'/'.$advt_message;
        $sms = new thsms();

        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $datasms = $this->sms_model->get_sms(null, $shop_id_pri)->row();

        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        if ($sends == 1) {
            if ($this->sms_model->get_customer($customer_id_pri)->num_rows() > 0) {
                $data = $this->sms_model->get_customer($customer_id_pri)->row();
                $tel = $data->tel;
                $text = $advt_header;
                if ($datasms->credit_balance > 0) {
                    $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
                    if ($creditsend[1] == 'OK') {
                        $datasend = array(
                            'credit_sum' => $datasms->credit_sum + 1,
                            'credit_balance' => $datasms->credit_balance - 1,
                            'credit_all' => $creditsend[3],
                        );
                        $this->sms_model->edit($datasms->setting_sms_id, $datasend);
                        $action_text = '(SMSAdvt.) ' . $text . ' ส่งไปยัง ' . $tel;
                        //$shop_id_pri = $this->session->userdata('shop_id_pri');
                        $user_id = $this->session->userdata('user_id');
                        $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                        $dataadd = array(
                            'customer_id_pri' => $customer_id_pri,
                            'advt_type' => 1,
                            'advt_header' => $advt_header,
                            'advt_status' => 1,
                            'date_modify' => $this->mics->getdate(),
                        );
                        $this->sms_model->addadvt($dataadd);
                        echo 1;
                    }
                } else {
                    $dataadd = array(
                        'customer_id_pri' => $customer_id_pri,
                        'advt_type' => 1,
                        'advt_header' => $advt_header,
                        'advt_status' => 2,
                        'date_modify' => $this->mics->getdate(),
                    );
                    $this->sms_model->addadvt($dataadd);
                    echo 0;
                }
            } else {
                echo 0;
            }
        } else {
            $datas = $this->sms_model->get_group_customer($customer_group_id, $start_customer_id, $end_customer_id);
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    $tel = $data->tel;
                    $text = $advt_header;
                    if ($datasms->credit_balance > 0) {
                        $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
                        if ($creditsend[1] == 'OK') {
                            $datasend = array(
                                'credit_sum' => $datasms->credit_sum + 1,
                                'credit_balance' => $datasms->credit_balance - 1,
                                'credit_all' => $creditsend[3],
                            );
                            $this->sms_model->edit($datasms->setting_sms_id, $datasend);
                            $action_text = '(SMSAdvt.) ' . $text . ' ส่งไปยัง ' . $tel;
                            //$shop_id_pri = $this->session->userdata('shop_id_pri');
                            $user_id = $this->session->userdata('user_id');
                            $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
                            $dataadd = array(
                                'customer_id_pri' => $data->customer_id_pri,
                                'advt_type' => 1,
                                'advt_header' => $advt_header,
                                'advt_status' => 1,
                                'date_modify' => $this->mics->getdate(),
                            );
                            $this->sms_model->addadvt($dataadd);
                        }
                    } else {
                        $dataadd = array(
                            'customer_id_pri' => $data->customer_id_pri,
                            'advt_type' => 1,
                            'advt_header' => $advt_header,
                            'advt_status' => 2,
                            'date_modify' => $this->mics->getdate(),
                        );
                        $this->sms_model->addadvt($dataadd);
                    }
                }
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function sendSMSOTP() {
        $sms = new thsms();
        $shop_id_pri = 1;
        $datasms = $this->sms_model->get_sms(null, $shop_id_pri)->row();
        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;
        $telcheck = $this->input->post('telcheck');
        $refotp = $this->input->post('refotp');
        $otp = $this->input->post('otp');
        $tel = $telcheck;
        $text = 'รหัส OTP คือ ' . $otp . ' (Ref No. ' . $refotp . ')';
        $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
        if ($creditsend[1] == 'OK') {
            $datasend = array(
                'credit_sum' => $datasms->credit_sum + 1,
                'credit_balance' => $datasms->credit_balance - 1,
                'credit_all' => $creditsend[3],
            );
            $this->sms_model->edit($datasms->setting_sms_id, $datasend);
            $action_text = '(SMSOTP ระบบส่ง) ' . $text . ' ส่งไปยัง ' . $tel;
            //$shop_id_pri = $this->session->userdata('shop_id_pri');
            $user_id = 1; //$this->session->userdata('user_id');
            $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function sendpassword() {
        $username = $this->input->post('username');
        $tel = $this->sms_model->get_tel($username);
        $password = $this->input->post('text');
        //$this->sendmail->sendEmailpassword($username, $password);
        $datauser = array(
            'password' => md5($username . $password),
            'date_modify' => $this->mics->getDate()
        );
        $this->sms_model->edituser($username, $datauser);

        $sms = new thsms();
        $shop_id_pri = 1;
        $datasms = $this->sms_model->get_sms(null, $shop_id_pri)->row();
        $sms->username = $datasms->setting_sms_username;
        $sms->password = $datasms->setting_sms_password;

        $text = $username . ' รหัสผ่านใหม่คือ ' . $password;
        $creditsend = $sms->send($datasms->setting_sms_number, $tel, $text);
        if ($creditsend[1] == 'OK') {
            $datasend = array(
                'credit_sum' => $datasms->credit_sum + 1,
                'credit_balance' => $datasms->credit_balance - 1,
                'credit_all' => $creditsend[3],
            );
            $this->sms_model->edit($datasms->setting_sms_id, $datasend);

            $action_text = '(SMSSendPassword ระบบส่ง) ' . $text . ' ส่งไปยัง ' . $tel;
            //$shop_id_pri = $this->session->userdata('shop_id_pri');
            $user_id = 1; //$this->session->userdata('user_id');
            $this->systemlog->log_sendsms($action_text, $shop_id_pri, $user_id);
            echo 1;
        } else {
            echo 0;
        }
    }

}
