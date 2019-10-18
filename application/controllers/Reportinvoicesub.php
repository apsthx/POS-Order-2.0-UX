<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportinvoicesub
 *
 * @author Prasan Srisopa
 */
class Reportinvoicesub extends CI_Controller{
    //put your code here
    public $group_id = 10;
    public $menu_id = 78;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportinvoicesub_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportinvoicesub.js'),
        );
        $this->renderView('reportinvoicesub_view', $data);
    }

    public function data() {
        $checked = $this->input->post('checked');
        $dateday = $this->input->post('dateday');
        $datemonth = $this->input->post('datemonth');
        $dateyear = $this->input->post('dateyear');
        $datedaystart = $this->input->post('datedaystart');
        $datedayend = $this->input->post('datedayend');
        $shop_id = $this->accesscontrol->getMyShop()->shop_id;
        if ($checked == 1) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_day($dateday,$shop_id);
        } else if ($checked == 2) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_month($datemonth,$shop_id);
        } else if ($checked == 3) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_year($dateyear,$shop_id);
        } else if ($checked == 4) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_dateday($datedaystart, $datedayend,$shop_id);
        } else {
            $datas = $this->reportinvoicesub_model->get_receipt_master_all($shop_id);
        }
        $data = array(
            'datas' => $datas,
        );
        $this->load->view('ajax/reportinvoicesub_page', $data);
    }

    public function export($checked, $dateday, $datemonth, $dateyear, $datedaystart, $datedayend) {

        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('รายงานสรุปใบแจ้งหนี้');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(17);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(13);
        $sheet->getColumnDimension('G')->setWidth(14);
        $sheet->getColumnDimension('H')->setWidth(14);
        $shop_id = $this->accesscontrol->getMyShop()->shop_id;
        if ($checked == 1) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_day($dateday,$shop_id);
            $sheet->setCellValue("A1", 'รายงานสรุปใบแจ้งหนี้ประจำวันที่ ' . $this->mics->dateen2stringthMS($dateday));
            $this->excel->getActiveSheet()->mergeCells("A1:H1");
        } else if ($checked == 2) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_month($datemonth,$shop_id);
            $sheet->setCellValue("A1", 'รายงานสรุปใบแจ้งหนี้ประจำเดือน ' . $this->mics->date2thai("$datemonth-01",'%m %y'));
            $this->excel->getActiveSheet()->mergeCells("A1:H1");
        } else if ($checked == 3) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_year($dateyear,$shop_id);
            $sheet->setCellValue("A1", 'รายงานสรุปใบแจ้งหนี้ประจำปี ' . ($dateyear + 543));
            $this->excel->getActiveSheet()->mergeCells("A1:H1");
        } else if ($checked == 4) {
            $datas = $this->reportinvoicesub_model->get_receipt_master_dateday($datedaystart, $datedayend,$shop_id);
            $sheet->setCellValue("A1", 'รายงานสรุปใบแจ้งหนี้ตั้งแต่ ' . $this->mics->dateen2stringthMS($datedaystart) . ' ถึง ' . $this->mics->dateen2stringthMS($datedayend));
            $this->excel->getActiveSheet()->mergeCells("A1:H1");
        } else {
            $datas = $this->reportinvoicesub_model->get_receipt_master_all($shop_id);
            $sheet->setCellValue("A1", 'รายงานสรุปใบแจ้งหนี้ทั้งหมด');
            $this->excel->getActiveSheet()->mergeCells("A1:H1");
        }
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'เลขที่ใบแจ้งหนี้');
        $sheet->setCellValue("C2", 'สาขา/ตัวแทน');
        $sheet->setCellValue("D2", 'วันที่ออกใบแจ้งหนี้');
        $sheet->setCellValue("E2", 'สถานะการจ่ายเงิน');
        $sheet->setCellValue("F2", 'สถานะสินค้า');
        $sheet->setCellValue("G2", 'สถานะออกใบเสร็จ');
        $sheet->setCellValue("H2", 'จำนวนเงินสุทธิ');
        $sheet->getStyle("A1:H2")->getFont()->setBold(true);
        
        $l = 3;

        $i = 1;
        $price_sum_pay = 0;
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValue("B$l", $data->receipt_master_id);
                $sheet->setCellValue("C$l", $data->customer_name);
                $sheet->setCellValue("D$l", $this->mics->dateen2stringthMS($data->date_receipt));
                $sheet->setCellValue("E$l", $this->reportinvoicesub_model->ref_status_pay($data->status_pay_id)->row()->status_pay_name);
                $sheet->setCellValue("F$l", $this->reportinvoicesub_model->ref_status_transfer($data->status_transfer_id)->row()->status_transfer_name);
                $sheet->setCellValue("G$l", $this->reportinvoicesub_model->ref_status_receipt_order($data->status_receipt_order_id)->row()->status_receipt_order_name);
                $sheet->setCellValue("H$l", number_format($data->price_sum_pay, 2));
                $price_sum_pay += $data->price_sum_pay;
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
        $this->excel->getActiveSheet()->mergeCells("A$l:G$l");
        $sheet->setCellValue("H$l", number_format($price_sum_pay, 2));
        $this->excel->getActiveSheet()->getStyle("H2:H$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        
        $sheet->getStyle("A$l:H$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:H$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'รายงานสรุปใบแจ้งหนี้ ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
