<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporttransportdelivery
 *
 * @Prasan Srisopa
 */
class Reporttransportdelivery extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 96;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reporttransportdelivery_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reporttransportdelivery.js'),
        );
        $this->renderView('reporttransportdelivery_view', $data);
    }

    public function data() {
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),
            'datas' => $this->reporttransportdelivery_model->get_transport_api($date_start, $date_end, $transport_service_id),
        );
        $this->load->view('ajax/reporttransportdelivery_page', $data);
    }

    public function export($date_start, $date_end, $transport_service_id) {

        $this->systemlog->log_transportexport();

        if ($date_start != 'null') {
            if ($date_end != 'null') {
                
            } else {
                $date_end = null;
            }
        } else {
            $date_start = null;
            $date_end = null;
        }

        $sheet = $this->excel->setActiveSheetIndex();


        $transport = 'จัดส่งเอง';

        $sheet->setTitle($transport);
        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(15);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(15);
        $sheet->getColumnDimension('L')->setWidth(15);
        $sheet->getColumnDimension('M')->setWidth(15);

        $l = 1;

        $sheet->setCellValue("A$l", 'ลำดับ');
        $sheet->setCellValue("B$l", 'เลขที่ใบ order');
        $sheet->setCellValue("C$l", 'เลขที่ใบเสร็จ');
        $sheet->setCellValue("D$l", 'วันที่จัดส่ง');
        $sheet->setCellValue("E$l", 'สินค้าในกล่อง');
        $sheet->setCellValue("F$l", 'ลูกค้า');
        $sheet->setCellValue("G$l", 'ที่อยู่');
        $sheet->setCellValue("H$l", 'ตำบล');
        $sheet->setCellValue("I$l", 'อำเภอ');
        $sheet->setCellValue("J$l", 'จังหวัด');
        $sheet->setCellValue("K$l", 'รหัสไปรษณีย์');
        $sheet->setCellValue("L$l", 'โทร');
        $sheet->setCellValue("M$l", 'ราคา');
        //$sheet->setCellValue("N$l", 'INSURE');
        //$sheet->setCellValue("O$l", 'INSURE_PRICE');

        $l++;
        $i = 1;

        $datas = $this->reporttransportdelivery_model->get_transport_api($date_start, $date_end, $transport_service_id);
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValueExplicit("B$l", $data->refer, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("C$l", $data->receipt_master_id, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("D$l", $this->mics->dateen2stringthMS($data->date_transfer), PHPExcel_Cell_DataType::TYPE_STRING);

                $dataproducts = $this->reporttransportdelivery_model->get_receipt_detail($data->receipt_master_id_pri);

                $product = ' ';
                $n = 0;
                if ($dataproducts->num_rows() > 0) {
                    foreach ($dataproducts->result() as $dataproduct) {
                        if ($n > 0) {
                            $product .= ', ';
                        }
                        $product .= $dataproduct->product_name . ' (' . $dataproduct->product_amount . ')';
                        $n++;
                    }
                }
                $sheet->setCellValueExplicit("E$l", $product, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("F$l", $data->customer_name, PHPExcel_Cell_DataType::TYPE_STRING);
//                $recipient_zipcode = explode(' ', $data->transport_customer_address);
//                $zipcode = sizeof($recipient_zipcode);
//                $address = str_replace($recipient_zipcode[$zipcode - 1], "", $data->transport_customer_address);
//                $sheet->setCellValueExplicit("G$l", $address, PHPExcel_Cell_DataType::TYPE_STRING);
//                $sheet->setCellValue("H$l", '');
//                if ($recipient_zipcode[$zipcode - 1] != null) {
//                    $provinces = $this->reporttransportdelivery_model->get_province($recipient_zipcode[$zipcode - 1]);
//                    if ($provinces->num_rows() > 0) {
//                        $province = $provinces->row(1)->province;
//                    } else {
//                        $province = '';
//                    }
//                } else {
//                    $province = '';
//                }
                $sheet->setCellValueExplicit("G$l", $data->transport_customer_address, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("H$l", $data->transport_customer_district, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("I$l", $data->transport_customer_amphoe, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("J$l", $data->transport_customer_province, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("K$l", $data->transport_customer_zipcode, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("L$l", $data->transport_customer_tel, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit("M$l", number_format($data->price_sum_pay, 0), PHPExcel_Cell_DataType::TYPE_STRING);
                //$sheet->setCellValue("N$l", '');
                //$sheet->setCellValue("O$l", '');
                $i++;
                $l++;
            }
        }
        $sheet->getStyle("A1:M$l")->getFont()->setSize(10);

        if ($date_start != null) {
            if ($date_end != $date_start) {
                $filename = 'บริการส่งสินค้า ' . $transport . ' ตั้งแต่วันที่ ' . $this->mics->dateen2stringthMS($date_start) . ' ถึง ' . $this->mics->dateen2stringthMS($date_end) . ' ดึงข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
            } else {
                $filename = 'บริการส่งสินค้า ' . $transport . ' วันที่ ' . $this->mics->dateen2stringthMS($date_start) . ' ดึงข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
            }
        } else {
            $filename = 'บริการส่งสินค้า ' . $transport . ' ทั้งหมด ดึงข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');
    }

}
