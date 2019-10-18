<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settingtransport
 *
 * @author Prasan Srisopa
 */
class Settingtransport extends CI_Controller {

    //put your code here
    public $group_id = 4;
    public $menu_id = 47;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('settingtransport_model');
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'css' => array('parsley.css'),
            'plugins_js' => array('parsley.min.js', 'input-valid.js'),
        );
        $this->renderView('settingtransport_view', $data);
    }

    public function edit() {
        $data = array(
            'send_name' => $this->input->post('send_name'),
            'send_address' => $this->input->post('send_address'),
            'transport_tel' => $this->input->post('transport_tel'),
//            'transport_service_id' => $this->input->post('transport_service_id'),
            'transport_price' => $this->input->post('transport_price'),
            'show_product' => $this->input->post('show_product'),
            'show_price' => $this->input->post('show_price'),
            'date_deley' => $this->input->post('date_deley'),
        );
        $this->settingtransport_model->edit($data);

        $data_kerry = array(
            'username' => $this->input->post('Username_kerry'),
            'password' => $this->input->post('Password_kerry'),
        );
        $this->settingtransport_model->edit_api($data_kerry, $this->input->post('kerry_id'));

        $data_ems = array(
            'username' => $this->input->post('Username_ems'),
            'password' => $this->input->post('Password_ems'),
        );
        $this->settingtransport_model->edit_api($data_ems, $this->input->post('ems_id'));

        redirect(base_url() . 'settingtransport');
    }

    public function printtransportfrom() {

        $pdf = $this->pdf2->loadthaicustom(100, 50);

        $send = $this->settingtransport_model->get_transport_setting()->row();

        $data = array(
            'send_name' => $send->send_name,
            'transport_tel' => $send->transport_tel,
            'send_address' => $send->send_address,
        );

        $pdf->AddPage('', '', '', '', '', 3, 2, 2, 1, 0, 0);
        $html = $this->load->view('ajax/printtransportfrom_view', $data, true);
        $pdf->WriteHTML($html);

        $pdf->Output('พิมพ์สติ๊กเกอร์' . date('YmdHis') . '.pdf', 'I');
        exit;
    }

}
