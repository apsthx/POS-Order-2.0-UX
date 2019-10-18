<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sticker
 *
 * @author Prasan Srisopa
 */
class Sticker extends CI_Controller {

    //put your code here
    public $group_id = 6;
    public $menu_id = 31;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('sticker_model');
        $this->load->library('pdf2');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/sticker.js'),
            'datas' => $this->sticker_model->get_sticker(),
        );
        $this->renderView('sticker_view', $data);
    }

    public function printsticker() {
        $checkbox_arr = $this->input->post('checkbox');
        $product_id_pri_arr = $this->input->post('product_id_pri');
        $amount_arr = $this->input->post('amount');
        $amount_sum = 0;
        foreach ($product_id_pri_arr as $i => $value) {
            $amount = intval($amount_arr[$i]);
            if (isset($checkbox_arr[$i]) && $checkbox_arr[$i] == 'on' && $amount != '') {
                //echo $product_id_pri_arr[$i];
                $amount_sum = $amount_sum + $amount;
            }
        }

        $pdf = $this->pdf2->loadthaicustom(105, 27);
        $data = array(
            'checkbox_arr' => $checkbox_arr,
            'product_id_pri_arr' => $product_id_pri_arr,
            'amount_arr' => $amount_arr,
            'amount_sum' => $amount_sum,
        );

        foreach ($product_id_pri_arr as $i => $value) {
            $amount = intval($amount_arr[$i]);
            if (isset($checkbox_arr[$i]) && $checkbox_arr[$i] == 'on' && $amount != '') {
                $product = $this->sticker_model->get_product($product_id_pri_arr[$i])->row();
                for ($j = 1; $j <= $amount; $j++) {
                    $data = array(
                        'product' => $product,
                    );
                    $pdf->AddPage('', '', '', '', '', 2, 0, 4, 0, 0, 0);
                    $html = $this->load->view('ajax/printsticker_view', $data, true);
                    $pdf->WriteHTML($html);
                }
            }
        }
        
        $pdf->Output('stickerprodurt.pdf', 'I');
        exit;
    }

}
