<?php

class Home extends CI_Controller {

    public $group_id = '';
    public $menu_id = '';

    public function __construct() {
        parent::__construct();
        $this->auth->isLoginNull();
        $this->load->model('home_model');
    }

    public function index() {
        if ($this->session->userdata('role_id') != 8) {
            $data = array(
                'group_id' => $this->group_id,
                'menu_id' => $this->menu_id,
                'title' => 'ภาพรวม',
                'css' => array(),
                'js' => array('build/charts/highcharts.js', 'build/charts.js')
            );
            $this->renderView('home_view', $data);
        }else{
            redirect(base_url().'transportcustomer');
        }
    }

    public function charts() {
        $data = array();

        for ($i = 1; $i <= 12; $i++) {
            $price_pay = $this->home_model->charts_year_month((date("Y") - 1), $i)->row()->price_sum_pay;
            if ($price_pay == null) {
                $price_pay = 0;
            }
            $data['oldyear'][] = round($price_pay, 2);
        }
        for ($i = 1; $i <= 12; $i++) {
            $price_pay = $this->home_model->charts_year_month((date("Y")), $i)->row()->price_sum_pay;
            if ($price_pay == null) {
                $price_pay = 0;
            }
            $data['newyear'][] = round($price_pay, 2);
        }

        echo json_encode($data);
    }

}
