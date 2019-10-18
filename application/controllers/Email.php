<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author Prasan Srisopa
 */
class Email extends CI_Controller {

    //put your code here
    public $group_id = 1;
    public $menu_id = 26;

    public function __construct() {
        parent::__construct();
        //$this->auth->isLogin($this->menu_id);
        $this->load->model('email_model');
        $this->load->library('mail');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
                //'js' => array('build/email.js'),
        );
        $this->renderView('email_view', $data);
    }

    public function edit() {
        $data = array(
            'fromaddress' => $this->input->post('fromaddress'),
            'from' => $this->input->post('from'),
            'smtp_host' => $this->input->post('smtp_host'),
            'smtp_port' => $this->input->post('smtp_port'),
            'smtp_user' => $this->input->post('smtp_user'),
            'smtp_password' => $this->input->post('smtp_password'),
        );
        $this->email_model->edit($data);
        redirect(base_url() . 'email');
    }

    public function sendmail($customer_id_pri = null) {
        $setting_email = $this->email_model->get_setting_email();

        $username = "";
        $password = "";
        $email = "";
        $data = $this->email_model->get_customer($customer_id_pri);
        if ($data->num_rows() > 0) {
            $username = $data->row()->username;
            $password = $data->row()->password;
            $email = $data->row()->email;
        }

        $mail = $this->mail;
        $mail->CharSet = "utf-8";
        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
//          Enable SMTP debugging
//          0 = off (for production use)
//          1 = client messages
//          2 = client and server messages
        $mail->SMTPDebug = 0;
//          Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';
//          Set the hostname of the mail server
        $mail->Host = $setting_email->smtp_host;
//          Set the SMTP port number - likely to be 25, 465 or 587
        $mail->Port = $setting_email->smtp_port;
//          Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = $setting_email->smtp_secure;
//          Whether to use SMTP authentication
        $mail->SMTPAuth = true;
//          Username to use for SMTP authentication
        $mail->Username = $setting_email->smtp_user;
//          Password to use for SMTP authentication
        $mail->Password = $setting_email->smtp_password;
//          Set who the message is to be sent from
        $mail->setFrom($setting_email->fromaddress, $setting_email->from);
//          Set who the message is to be sent to  
        $mail->addAddress($email);
//          Set the subject line
        $mail->Subject = 'ลูกค้า Stock & POS';
//          Read an HTML message body from an external file, convert referenced images to embedded,
//          convert HTML into a basic plain-text alternative body
//          $mail->msgHTML(file_get_contents('content.html'), dirname(__FILE__));
        $mail->msgHTML("<p>username = $username</p> <p>password = $username</p>");
//          send the message, check for errors

        if (!$mail->send()) {
            redirect(base_url('customer'));
        } else {
            $action_text = 'ส่ง username และ password ให้ลูกค้า usename = ' . $username . ' ส่งไปยัง Email : ' . $email;
            $shop_id_pri = $this->session->userdata('shop_id_pri');
            $user_id = $this->session->userdata('user_id');
            $this->systemlog->log_sendemail($action_text, $shop_id_pri, $user_id);
            redirect(base_url('customer'));
        }
    }

    public function sendEmailadvt() {
        $sends = $this->input->post('sends');
        $customer_id_pri = $this->input->post('customer_id_pri');
        $customer_group_id = $this->input->post('customer_group_id');
        $start_customer_id = $this->input->post('start_customer_id');
        $end_customer_id = $this->input->post('end_customer_id');
        $advt_header = $this->input->post('advt_header');
        $advt_message = $this->input->post('advt_message');

        if ($sends == 1) {
            if ($this->email_model->get_customer($customer_id_pri)->num_rows() > 0) {
                $datasend = $this->email_model->get_customer($customer_id_pri)->row();

                $setting_email = $this->email_model->get_setting_email();
                $username = "";
                $password = "";
                $email = "";
                $data = $this->email_model->get_customer($customer_id_pri);
                if ($data->num_rows() > 0) {
                    $username = $data->row()->username;
                    $password = $data->row()->password;
                    $email = $data->row()->email;
                }
                $mail = $this->mail;
                $mail->CharSet = "utf-8";
                $mail->isSMTP();
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPDebug = 0;
                $mail->Debugoutput = 'html';
                $mail->Host = $setting_email->smtp_host;
                $mail->Port = $setting_email->smtp_port;
                $mail->SMTPSecure = $setting_email->smtp_secure;
                $mail->SMTPAuth = true;
                $mail->Username = $setting_email->smtp_user;
                $mail->Password = $setting_email->smtp_password;
                $mail->setFrom($setting_email->fromaddress, $setting_email->from);

                $mail->addAddress($datasend->email);
                $mail->Subject = $advt_header;
                $mail->msgHTML($advt_message);

                if (!$mail->send()) {
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                    $dataadd = array(
                        'customer_id_pri' => $customer_id_pri,
                        'advt_type' => 2,
                        'advt_header' => $advt_header,
                        'advt_message' => $advt_message,
                        'advt_status' => 2,
                        'date_modify' => $this->mics->getdate(),
                    );
                    $this->email_model->addadvt($dataadd);
                    echo 0;
                } else {
                    $dataadd = array(
                        'customer_id_pri' => $customer_id_pri,
                        'advt_type' => 2,
                        'advt_header' => $advt_header,
                        'advt_message' => $advt_message,
                        'advt_status' => 1,
                        'date_modify' => $this->mics->getdate(),
                    );
                    $this->email_model->addadvt($dataadd);
                    $action_text = '(EmailAdvt.) ' . $advt_header . ' : ' . $advt_message . ' ส่งไปยัง Email : ' . $email;
                    $shop_id_pri = $this->session->userdata('shop_id_pri');
                    $user_id = $this->session->userdata('user_id');
                    $this->systemlog->log_sendemail($action_text, $shop_id_pri, $user_id);
                    echo 1;
                }
            } else {
                echo 0;
            }
        } else {
            $datas = $this->email_model->get_group_customer($customer_group_id, $start_customer_id, $end_customer_id);
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $datasend) {
                    $setting_email = $this->email_model->get_setting_email();
                    $username = "";
                    $password = "";
                    $email = "";
                    $data = $this->email_model->get_customer($customer_id_pri);
                    if ($data->num_rows() > 0) {
                        $username = $data->row()->username;
                        $password = $data->row()->password;
                        $email = $data->row()->email;
                    }
                    $mail = $this->mail;
                    $mail->CharSet = "utf-8";
                    $mail->isSMTP();
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    $mail->SMTPDebug = 0;
                    $mail->Debugoutput = 'html';
                    $mail->Host = $setting_email->smtp_host;
                    $mail->Port = $setting_email->smtp_port;
                    $mail->SMTPSecure = $setting_email->smtp_secure;
                    $mail->SMTPAuth = true;
                    $mail->Username = $setting_email->smtp_user;
                    $mail->Password = $setting_email->smtp_password;
                    $mail->setFrom($setting_email->fromaddress, $setting_email->from);

                    $mail->addAddress($datasend->email);
                    $mail->Subject = $advt_header;
                    $mail->msgHTML($advt_message);

                    if (!$mail->send()) {
                        //echo "Mailer Error: " . $mail->ErrorInfo;
                        $dataadd = array(
                            'customer_id_pri' => $datasend->customer_id_pri,
                            'advt_type' => 2,
                            'advt_header' => $advt_header,
                            'advt_message' => $advt_message,
                            'advt_status' => 2,
                            'date_modify' => $this->mics->getdate(),
                        );
                        $this->email_model->addadvt($dataadd);
                    } else {
                        $dataadd = array(
                            'customer_id_pri' => $datasend->customer_id_pri,
                            'advt_type' => 2,
                            'advt_header' => $advt_header,
                            'advt_message' => $advt_message,
                            'advt_status' => 1,
                            'date_modify' => $this->mics->getdate(),
                        );
                        $this->email_model->addadvt($dataadd);
                        $action_text = '(EmailAdvt.) ' . $advt_header . ' : ' . $advt_message . ' ส่งไปยัง Email : ' . $email;
                        $shop_id_pri = $this->session->userdata('shop_id_pri');
                        $user_id = $this->session->userdata('user_id');
                        $this->systemlog->log_sendemail($action_text, $shop_id_pri, $user_id);
                    }
                }
                echo 1;
            } else {
                echo 0;
            }
        }
    }

}
