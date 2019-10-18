<?php

/*
 * SYSTEM NAME  : Hotspot Wifi
 * VERSION	: 2016	Build 0.1
 * AUTHOR 	: Teendoi Studio
 */

/*
 * Class pdf.php 
 * Created By : Prasan Srisopa
 * Created Date : 9:40 10/11/2014
 */

class PDF {

    public function pdf() {
        $CI = & get_instance();
        include_once APPPATH . 'third_party/fpdf/fpdf.php';
    }

    public function load($param = NULL) {
        return new FPDF($param);
    }

    public function loadPDF() {
        return new FPDF('P', 'mm', array(153, 203));
    }

    public function loadPDFA4() {
        return new FPDF('P', 'mm', 'A4');
    }

    public function loadPDFA4L() {
        return new FPDF('L', 'mm', 'A4');
    }

    public function loadPDF1per2A4() {
        return new FPDF('P', 'mm', array(105, 297));
    }

    public function loadPDF1per4A4() {
        return new FPDF('P', 'mm', array(74, 210));
    }

    public function loadPDFB5() {
        return new FPDF('P', 'mm', array(149, 210));
    }

    public function loadPDFcustom($height, $width) {
        return new FPDF('L', 'mm', array($height, $width));
    }

}
