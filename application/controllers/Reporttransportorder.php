<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporttransportorder
 *
 * @author Prasan Srisopa
 */
class Reporttransportorder extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 80;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reporttransportorder_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reporttransportorder.js'),
        );
        $this->renderView('reporttransportorder_view', $data);
    }

    public function data() {
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $transport_service_id = $this->input->post('transport_service_id');
        $data = array(
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),
            'datas' => $this->reporttransportorder_model->get_transport_api($date_start, $date_end, $transport_service_id),
        );
        $this->load->view('ajax/reporttransportorder_page', $data);
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

        if ($transport_service_id == 1) {
            $transport = 'Dropoff EMS';
        } else {
            $transport = 'Kerry Express';
        }

        if ($transport_service_id == 1) {
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
            $sheet->getColumnDimension('N')->setWidth(15);
            $sheet->getColumnDimension('O')->setWidth(15);

            $l = 1;

            $sheet->setCellValue("A$l", 'NO');
            $sheet->setCellValue("B$l", 'COMP_ORDER_ID');
            $sheet->setCellValue("C$l", 'INV_NO');
            $sheet->setCellValue("D$l", 'BARCODE_NO');
            $sheet->setCellValue("E$l", 'PRODUCT_IN_BOX');
            $sheet->setCellValue("F$l", 'RECEIVER');
            $sheet->setCellValue("G$l", 'RECEIVER_ADDRESS');
            $sheet->setCellValue("H$l", 'RECEIVER_AMPHUR');
            $sheet->setCellValue("I$l", 'RECEIVER_PROVINCE');
            $sheet->setCellValue("J$l", 'RECEIVER_ZIPCODE');
            $sheet->setCellValue("K$l", 'RECEIVER_TEL');
            $sheet->setCellValue("L$l", 'WEIGHT');
            $sheet->setCellValue("M$l", 'PRICE');
            $sheet->setCellValue("N$l", 'INSURE');
            $sheet->setCellValue("O$l", 'INSURE_PRICE');

            $l++;
            $i = 1;

            $datas = $this->reporttransportorder_model->get_transport_api($date_start, $date_end, $transport_service_id);
            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    $sheet->setCellValue("A$l", $i);
                    $sheet->setCellValueExplicit("B$l", $data->refer, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("C$l", $data->receipt_master_id, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("D$l", $data->transport_tracking_id, PHPExcel_Cell_DataType::TYPE_STRING);
                    
                    $dataproducts = $this->reporttransportorder_model->get_receipt_detail($data->receipt_master_id_pri);
                    
                    $product = ' ';
                    $n = 0;
                    if ($dataproducts->num_rows() > 0) {
                        foreach ($dataproducts->result() as $dataproduct) {
                            if($n > 0){
                                $product .= ', ';
                            }
                            $product .= $dataproduct->product_name. ' ('.$dataproduct->product_amount.')';
                            $n++;
                        }
                    }
                    $sheet->setCellValueExplicit("E$l", $product, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("F$l", $data->customer_name, PHPExcel_Cell_DataType::TYPE_STRING);
//                    $recipient_zipcode = explode(' ', $data->transport_customer_address);
//                    $zipcode = sizeof($recipient_zipcode);
//                    $address = str_replace($recipient_zipcode[$zipcode - 1], "", $data->transport_customer_address);
//                    $sheet->setCellValueExplicit("G$l", $address, PHPExcel_Cell_DataType::TYPE_STRING);
//                    $sheet->setCellValue("H$l", '');
//                    if ($recipient_zipcode[$zipcode - 1] != null) {
//                        $provinces = $this->reporttransportorder_model->get_province($recipient_zipcode[$zipcode - 1]);
//                        if ($provinces->num_rows() > 0) {
//                            $province = $provinces->row(1)->province;
//                        } else {
//                            $province = '';
//                        }
//                    }else{
//                        $province = '';
//                    }
                    $sheet->setCellValueExplicit("G$l", $data->transport_customer_address.' '.$data->transport_customer_district, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("H$l", $data->transport_customer_amphoe, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("I$l", $data->transport_customer_province, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("J$l", $data->transport_customer_zipcode, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("K$l", $data->transport_customer_tel, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("L$l", '');
                    $sheet->setCellValueExplicit("M$l", number_format($data->price_sum_pay, 0), PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("N$l", '');
                    $sheet->setCellValue("O$l", '');
                    $i++;
                    $l++;
                }
            }
            $sheet->getStyle("A1:O$l")->getFont()->setSize(10);

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
            
        } else {
            $sheet->setTitle($transport);

            $sheet->getColumnDimension('A')->setWidth(10);
            $sheet->getColumnDimension('B')->setWidth(10);
            $sheet->getColumnDimension('C')->setWidth(10);
            $sheet->getColumnDimension('D')->setWidth(10);
            $sheet->getColumnDimension('E')->setWidth(10);
            $sheet->getColumnDimension('F')->setWidth(10);
            $sheet->getColumnDimension('G')->setWidth(10);
            $sheet->getColumnDimension('H')->setWidth(10);
            $sheet->getColumnDimension('I')->setWidth(10);
            $sheet->getColumnDimension('J')->setWidth(10);
            $sheet->getColumnDimension('K')->setWidth(10);
            $sheet->getColumnDimension('L')->setWidth(10);
            $sheet->getColumnDimension('M')->setWidth(10);
            $sheet->getColumnDimension('N')->setWidth(10);
            $sheet->getColumnDimension('O')->setWidth(10);
            $sheet->getColumnDimension('P')->setWidth(10);
            $sheet->getColumnDimension('Q')->setWidth(10);
            $sheet->getColumnDimension('R')->setWidth(10);
            $sheet->getColumnDimension('S')->setWidth(10);
            $sheet->getColumnDimension('T')->setWidth(10);
            $sheet->getColumnDimension('U')->setWidth(10);
            $sheet->getColumnDimension('V')->setWidth(10);
            $sheet->getColumnDimension('W')->setWidth(10);
            $sheet->getColumnDimension('X')->setWidth(10);
            $sheet->getColumnDimension('Y')->setWidth(10);
            $sheet->getColumnDimension('Z')->setWidth(10);
            $sheet->getColumnDimension('AA')->setWidth(10);
            $sheet->getColumnDimension('AB')->setWidth(10);
            $sheet->getColumnDimension('AC')->setWidth(10);
            $sheet->getColumnDimension('AD')->setWidth(10);
            $sheet->getColumnDimension('AE')->setWidth(10);
            $sheet->getColumnDimension('AF')->setWidth(10);
            $sheet->getColumnDimension('AG')->setWidth(10);
            $sheet->getColumnDimension('AH')->setWidth(10);

            $l = 1;

            $sheet->setCellValue("A$l", 'booking_no');
            $sheet->setCellValue("B$l", 'consignment_no');
            $sheet->setCellValue("C$l", 'ref_no');
            $sheet->setCellValue("D$l", 'payerid');
            $sheet->setCellValue("E$l", 'payer_name');
            $sheet->setCellValue("F$l", 'payer_address1');
            $sheet->setCellValue("G$l", 'payer_address2');
            $sheet->setCellValue("H$l", 'payer_zipcode');
            $sheet->setCellValue("I$l", 'payer_telephone');
            $sheet->setCellValue("J$l", 'payer_fax');
            $sheet->setCellValue("K$l", 'payment_mode');
            $sheet->setCellValue("L$l", 'sender_name');
            $sheet->setCellValue("M$l", 'sender_address1');
            $sheet->setCellValue("N$l", 'sender_address2');
            $sheet->setCellValue("O$l", 'sender_zipcode');
            $sheet->setCellValue("P$l", 'sender_telephone');
            $sheet->setCellValue("Q$l", 'sender_fax');
            $sheet->setCellValue("R$l", 'sender_contact_person');
            $sheet->setCellValue("S$l", 'recipient_name');
            $sheet->setCellValue("T$l", 'recipient_address1');
            $sheet->setCellValue("U$l", 'recipient_address2');
            $sheet->setCellValue("V$l", 'recipient_zipcode');
            $sheet->setCellValue("W$l", 'recipient_telephone');
            $sheet->setCellValue("X$l", 'recipient_fax');
            $sheet->setCellValue("Y$l", 'recipient_contact_person');
            $sheet->setCellValue("Z$l", 'service_code');
            $sheet->setCellValue("AA$l", 'declare_value');
            $sheet->setCellValue("AB$l", 'payment_type');
            $sheet->setCellValue("AC$l", 'commodity_code');
            $sheet->setCellValue("AD$l", 'remark');
            $sheet->setCellValue("AE$l", 'cod_amount');
            $sheet->setCellValue("AF$l", 'return_pod_hc');
            $sheet->setCellValue("AG$l", 'return_invoice_hc');
            $sheet->setCellValue("AH$l", 'BOX');

            $l++;
            $i = 1;

            $datas = $this->reporttransportorder_model->get_transport_api($date_start, $date_end, $transport_service_id);

            if ($datas->num_rows() > 0) {
                foreach ($datas->result() as $data) {
                    $sheet->setCellValue("A$l", $i);
                    $sheet->setCellValueExplicit("B$l", $data->transport_tracking_id, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("C$l", $data->refer, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("D$l", 'FIVE');
                    $sheet->setCellValue("E$l", '');
                    $sheet->setCellValue("F$l", '');
                    $sheet->setCellValue("G$l", '');
                    $sheet->setCellValue("H$l", '');
                    $sheet->setCellValue("I$l", '');
                    $sheet->setCellValue("J$l", '');
                    $sheet->setCellValue("K$l", '');
                    $sheet->setCellValue("L$l", '');
                    $sheet->setCellValue("M$l", '');
                    $sheet->setCellValue("N$l", '');
                    $sheet->setCellValue("O$l", '');
                    $sheet->setCellValue("P$l", '');
                    $sheet->setCellValue("Q$l", '');
                    $sheet->setCellValue("R$l", '');
                    $sheet->setCellValueExplicit("S$l", $data->customer_name, PHPExcel_Cell_DataType::TYPE_STRING);
//                    $recipient_zipcode = explode(' ', $data->transport_customer_address);
//                    $zipcode = sizeof($recipient_zipcode);
//                    $address = str_replace($recipient_zipcode[$zipcode - 1], "", $data->transport_customer_address);
                    $sheet->setCellValueExplicit("T$l", $data->transport_customer_address.' '.$data->transport_customer_district.' '.$data->transport_customer_amphoe.' '.$data->transport_customer_province, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValueExplicit("U$l", $data->customer_tax_address.' '.$data->customer_district.' '.$data->customer_amphoe.' '.$data->customer_province, PHPExcel_Cell_DataType::TYPE_STRING);
//                    $sheet->setCellValueExplicit("V$l", $recipient_zipcode[$zipcode - 1], PHPExcel_Cell_DataType::TYPE_STRING);                                      
                    $sheet->setCellValueExplicit("V$l", $data->transport_customer_zipcode, PHPExcel_Cell_DataType::TYPE_STRING);                    
                    $sheet->setCellValueExplicit("W$l", $data->transport_customer_tel, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("X$l", '');
                    $sheet->setCellValueExplicit("Y$l", $data->customer_name, PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("Z$l", '2D');
                    $sheet->setCellValue("AA$l", '0');
                    $sheet->setCellValue("AB$l", 'FP');
                    $sheet->setCellValue("AC$l", '');
                    $sheet->setCellValue("AD$l", '');
                    $sheet->setCellValueExplicit("AE$l", number_format($data->price_sum_pay, 0), PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setCellValue("AF$l", 'N');
                    $sheet->setCellValue("AG$l", 'N');
                    $sheet->setCellValue("AH$l", '');
                    $i++;
                    $l++;
                }
            }
            $sheet->getStyle("A1:AH$l")->getFont()->setSize(10);

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

}
