<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportproductbuy
 *
 * @Prasan Srisopa
 */
class Reportproductbuy extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 56;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportproductbuy_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportproductbuy.js'),
        );
        $this->renderView('reportproductbuy_view', $data);
    }

    public function data() {
        $data = array(
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),
            'search' => $this->input->post('search'),
        );
        $this->load->view('ajax/reportproductbuy_page', $data);
    }

    public function export($date_start, $date_end, $search) {
        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('รายงานจัดอันดับสินค้าขายดี');

        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(32);
        $sheet->getColumnDimension('D')->setWidth(11);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(17);
        if ($date_start != 'null') {
            if ($date_end != 'null') {
                $sheet->setCellValue("A1", 'รายงานจัดอันดับสินค้าขายดี ตั้งแต่วันที่' . $this->mics->dateen2stringthMS($date_start) . ' ถึง ' . $this->mics->dateen2stringthMS($date_end));
            } else {
                $sheet->setCellValue("A1", 'รายงานจัดอันดับสินค้าขายดี วันที่' . $this->mics->dateen2stringthMS($date_start));
                $date_end = null;
            }
        } else {
            $sheet->setCellValue("A1", 'รายงานจัดอันดับสินค้าขายดีทั้งหมด');
            $date_start = null;
            $date_end = null;
        }

        if ($search == 'null') {
            $search = null;
        }
        
        $this->excel->getActiveSheet()->mergeCells("A1:F1");
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'รหัสสินค้า');
        $sheet->setCellValue("C2", 'สินค้า');
        $sheet->setCellValue("D2", 'จำนวนขาย');
        $sheet->setCellValue("E2", 'หน่วยนับ');
        $sheet->setCellValue("F2", 'ราคาขายทั้งหมด');
        $sheet->getStyle("A1:F2")->getFont()->setBold(true);

        $l = 3;
        $i = 1;
        $product_price_sum = 0;

        $datas = $this->reportproductbuy_model->hit_product($date_start, $date_end, $search);

        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValue("B$l", $data->product_id);
                $sheet->setCellValue("C$l", $data->product_name);
                $sheet->setCellValue("D$l", number_format($data->product_amount, 0));
                $sheet->setCellValue("E$l", $data->product_unit);
                $sheet->setCellValue("F$l", number_format($data->product_price_sum, 2));
                $product_price_sum += $data->product_price_sum;
                $i++;
                $l++;
            }
        } else {
            $sheet->setCellValue("A$l", 'ไม่มีข้อมูล');
            $this->excel->getActiveSheet()->mergeCells("A$l:F$l");
            $sheet->getStyle("A$l")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $l++;
        }
        $sheet->setCellValue("A$l", 'รวม');
        $this->excel->getActiveSheet()->mergeCells("A$l:E$l");
        $sheet->setCellValue("F$l", number_format($product_price_sum, 2));
        $this->excel->getActiveSheet()->getStyle("F2:F$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $sheet->getStyle("A$l:F$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:F$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'รายงานจัดอันดับสินค้าขายดี ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
