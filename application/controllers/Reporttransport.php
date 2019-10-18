<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reporttransport
 *
 * @author Prasan Srisopa
 */
class Reporttransport extends CI_Controller{
    //put your code here
    public $group_id = 10;
    public $menu_id = 76;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reporttransport_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reporttransport.js'),
        );
        $this->renderView('reporttransport_view', $data);
    }

    public function data() {
        $checked = $this->input->post('checked');
        $dateday = $this->input->post('dateday');
        $datemonth = $this->input->post('datemonth');
        $dateyear = $this->input->post('dateyear');
        $datedaystart = $this->input->post('datedaystart');
        $datedayend = $this->input->post('datedayend');
        if ($checked == 1) {
            $datas = $this->reporttransport_model->get_receipt_master_day($dateday);
        } else if ($checked == 2) {
            $datas = $this->reporttransport_model->get_receipt_master_month($datemonth);
        } else if ($checked == 3) {
            $datas = $this->reporttransport_model->get_receipt_master_year($dateyear);
        } else if ($checked == 4) {
            $datas = $this->reporttransport_model->get_receipt_master_dateday($datedaystart, $datedayend);
        } else {
            $datas = $this->reporttransport_model->get_receipt_master_all();
        }
        $data = array(
            'datas' => $datas,
        );
        $this->load->view('ajax/reporttransport_page', $data);
    }

    public function export($checked, $dateday, $datemonth, $dateyear, $datedaystart, $datedayend) {

        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('สินค้าส่งออกสาขาหรือตัวแทน');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);


        if ($checked == 1) {
            $datas = $this->reporttransport_model->get_receipt_master_day($dateday);
            $sheet->setCellValue("A1", 'สินค้าส่งออกสาขาหรือตัวแทนประจำวันที่ ' . $this->mics->dateen2stringthMS($dateday));
            $this->excel->getActiveSheet()->mergeCells("A1:E1");
        } else if ($checked == 2) {
            $datas = $this->reporttransport_model->get_receipt_master_month($datemonth);
            $sheet->setCellValue("A1", 'สินค้าส่งออกสาขาหรือตัวแทนประจำเดือน ' . $this->mics->date2thai("$datemonth-01",'%m %y'));
            $this->excel->getActiveSheet()->mergeCells("A1:E1");
        } else if ($checked == 3) {
            $datas = $this->reporttransport_model->get_receipt_master_year($dateyear);
            $sheet->setCellValue("A1", 'สินค้าส่งออกสาขาหรือตัวแทนประจำปี ' . ($dateyear + 543));
            $this->excel->getActiveSheet()->mergeCells("A1:E1");
        } else if ($checked == 4) {
            $datas = $this->reporttransport_model->get_receipt_master_dateday($datedaystart, $datedayend);
            $sheet->setCellValue("A1", 'สินค้าส่งออกสาขาหรือตัวแทนตั้งแต่ ' . $this->mics->dateen2stringthMS($datedaystart) . ' ถึง ' . $this->mics->dateen2stringthMS($datedayend));
            $this->excel->getActiveSheet()->mergeCells("A1:E1");
        } else {
            $datas = $this->reporttransport_model->get_receipt_master_all();
            $sheet->setCellValue("A1", 'สินค้าส่งออกสาขาหรือตัวแทนทั้งหมด');
            $this->excel->getActiveSheet()->mergeCells("A1:E1");
        }
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'เลขที่ใบอ้างอิง');
        $sheet->setCellValue("C2", 'สาขา/ตัวแทน');
        $sheet->setCellValue("D2", 'วันที่ขนส่ง');
        $sheet->setCellValue("E2", 'จำนวนสินค้า(ชิ้น)');

        $sheet->getStyle("A1:E2")->getFont()->setBold(true);
        
        $l = 3;

        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValue("B$l", $data->receipt_master_id);
                $sheet->setCellValue("C$l", $data->customer_name);
                $sheet->setCellValue("D$l", $this->mics->dateen2stringthMS($data->date_receipt));
                $product_amount = $this->reporttransport_model->get_product_amount($data->receipt_master_id_pri)->row()->product_amount;
                $sheet->setCellValue("E$l", number_format($product_amount, 0));
                $price_sum_pay += $product_amount;
                $i++;
                $l++;
            }
        } else {
            $sheet->setCellValue("A$l", 'ไม่มีข้อมูล');
            $this->excel->getActiveSheet()->mergeCells("A$l:H$l");
            $sheet->getStyle("A$l")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $l++;
        }
        $sheet->setCellValue("A$l", 'รวม');
        $this->excel->getActiveSheet()->mergeCells("A$l:D$l");
        $sheet->setCellValue("E$l", number_format($price_sum_pay, 0));
        $this->excel->getActiveSheet()->getStyle("E2:E$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        
        $sheet->getStyle("A$l:E$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:E$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'สินค้าส่งออกสาขาหรือตัวแทน ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
