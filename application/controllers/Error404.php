<?php

class Error404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Error 404',
        );
        $this->load->view('error404_view', $data);
    }

}
