<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mpdf
 *
 * @author Prasan Srisopa
 */
class PDF2 {
    //put your code here
    public function pdf2() {
        $CI = & get_instance();
        include_once APPPATH . 'third_party/mpdf/mpdf.php';
    }
    
    public function loadthaiA4() {
        //return new mPDF($mode='th',$format='A4');
        //return new mPDF($mode='tha',$format='A4');
        return new mPDF($mode='tha',$format='A4');
    }
    
    public function loadthaiA5() {
        //return new mPDF($mode='th',$format='A4');
        //return new mPDF($mode='tha',$format='A4');
        return new mPDF($mode='tha',$format='A5-L');
    }
    
    
    public function loadthaiIV($height) {
        return new mPDF($mode='thaiv', $format=array(80, $height));
    }
    
    public function loadthaicustom($width,$height) {
        return new mPDF($mode='th', $format=array($width, $height));
    }
}
