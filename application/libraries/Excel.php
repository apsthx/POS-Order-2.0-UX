<?php

/*
 * SYSTEM NAME  : Hotspot Wifi
 * VERSION	: 2016	Build 0.1
 * AUTHOR 	: Teendoi Studio
 */

/*
 * Class excel.php 
 * Created By : Prasan Srisopa
 * Created Date : 14:21 18/11/2014
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once APPPATH . '/third_party/PHPExcel.php';

class Excel extends PHPExcel {

    public function __construct() {
        parent::__construct();
    }

}
