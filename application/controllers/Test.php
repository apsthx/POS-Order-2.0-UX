<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Test
 *
 * @author Prasan Srisopa
 */
class Test extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        $this->load->library('simple_html_dom');
    }

    public function index() {
        $html = file_get_html('https://th.kerryexpress.com/en/track/?track=SSUT007055588');
        foreach ($html->find('div .piority-success') as $element) {
            echo $element;
        }

        $this->load->view('test_view');
    }

}
