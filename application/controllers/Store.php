<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Etlreference
 *
 * @author karn-chonlatit
 */
class Store extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function image($file_name = null) {
        if ($file_name == NULL) {
            redirect(base_url());
        }

        $file = 'assets/upload/img/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

    public function logo($file_name = null) {
        if ($file_name == NULL || $this->session->userdata('islogin') != 1) {
            redirect(base_url());
        }

        $file = 'assets/upload/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
    
    public function receipt($file_name = null) {
        if ($file_name == NULL) {
            redirect(base_url());
        }

        $file = 'assets/upload/receipt/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
    
    public function files($file_name = null) {
        if ($file_name == NULL) {
            redirect(base_url());
        }

        $file = 'assets/upload/file/' . $file_name;

        header('Content-Type:image/jpeg');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

}
