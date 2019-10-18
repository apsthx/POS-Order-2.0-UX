<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

date_default_timezone_set('Asia/Bangkok');
require_once APPPATH . '/third_party/PHPMailer/PHPMailerAutoload.php';

class Mail extends PHPMailer {

    public function __construct() {
        parent::__construct();
    }

}
