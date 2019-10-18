<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportproductmovementsub
 *
 * @Prasan Srisopa
 */
class Reportproductmovementsub extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 71;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportproductmovementsub_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportproductmovementsub.js'),
        );
        $this->renderView('reportproductmovementsub_view', $data);
    }

    public function data() {
        $data = array(
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),
            'datas' => $this->reportproductmovementsub_model->product($this->input->post('search')),
        );
        $this->load->view('ajax/reportproductmovementsub_page', $data);
    }

    public function export($date_start, $date_end, $search) {
        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('รายงานสรุปความเคลื่อนไหวสินค้า');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(10);
        $sheet->getColumnDimension('C')->setWidth(26);
        $sheet->getColumnDimension('D')->setWidth(9);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(10);
        $sheet->getColumnDimension('H')->setWidth(10);

        if ($date_start != 'null') {
            if ($date_end != 'null') {
                $sheet->setCellValue("A1", 'รายงานสรุปความเคลื่อนไหวสินค้า ตั้งแต่วันที่' . $this->mics->dateen2stringthMS($date_start) . ' ถึง ' . $this->mics->dateen2stringthMS($date_end));
            } else {
                $sheet->setCellValue("A1", 'รายงานสรุปความเคลื่อนไหวสินค้า วันที่' . $this->mics->dateen2stringthMS($date_start));
                $date_end = null;
            }
        } else {
            $sheet->setCellValue("A1", 'รายงานสรุปความเคลื่อนไหวสินค้าทั้งหมด');
            $date_start = null;
            $date_end = null;
        }
        
        if ($search == 'null') {
            $search = null;
        }

        $this->excel->getActiveSheet()->mergeCells("A1:H1");
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'รหัสสินค้า');
        $sheet->setCellValue("C2", 'สินค้า');
        $sheet->setCellValue("D2", 'หน่วยนับ');
        $sheet->setCellValue("E2", 'ยอดยกมา');
        $sheet->setCellValue("F2", 'ยอดเข้า');
        $sheet->setCellValue("G2", 'ยอดออก');
        $sheet->setCellValue("H2", 'ยอดยกไป');
        $sheet->getStyle("A1:H2")->getFont()->setBold(true);

        $l = 3;
        $i = 1;
        $shop_id = $this->accesscontrol->getMyShop()->shop_id;
        $in_out_product_sum = 0;
        $product_in_sum = 0;
        $product_out_sum = 0;
        $product_out_in_sum = 0;

        $datas = $this->reportproductmovementsub_model->product($search);

        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {

                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValue("B$l", $data->product_id);
                $sheet->setCellValue("C$l", $data->product_name);
                $sheet->setCellValue("D$l", $data->product_unit);
                $in_out_product = 0;
                $product_out_in = 0;
                if ($date_start != null) {
                    $in_product_check = $this->reportproductmovementsub_model->in_product($data->product_id, $date_start,$shop_id);
                    if ($in_product_check->num_rows() > 0) {
                        $in_product = $in_product_check->row()->product_amount;
                    } else {
                        $in_product = 0;
                    }
                    $out_product_check = $this->reportproductmovementsub_model->out_product($data->product_id, $date_start);
                    if ($out_product_check->num_rows() > 0) {
                        $out_product = $out_product_check->row()->product_amount;
                    } else {
                        $out_product = 0;
                    }
                } else {
                    $in_product = 0;
                    $out_product = 0;
                }
                $product_in_check = $this->reportproductmovementsub_model->product_in($data->product_id, $date_start, $date_end,$shop_id);
                if ($product_in_check->num_rows() > 0) {
                    $product_in = $product_in_check->row()->product_amount;
                } else {
                    $product_in = 0;
                }
                $product_out_check = $this->reportproductmovementsub_model->product_out($data->product_id, $date_start, $date_end);
                if ($product_out_check->num_rows() > 0) {
                    $product_out = $product_out_check->row()->product_amount;
                } else {
                    $product_out = 0;
                }
                $in_out_product = $in_product + $out_product;
                $product_out_in = ($in_out_product + $product_in) - $product_out;
                $in_out_product_sum += $in_out_product;
                $product_in_sum += $product_in;
                $product_out_sum += $product_out;
                $product_out_in_sum += $product_out_in;
                $sheet->setCellValue("E$l", number_format($in_out_product, 0));
                $sheet->setCellValue("F$l", number_format($product_in, 0));
                $sheet->setCellValue("G$l", number_format($product_out, 0));
                $sheet->setCellValue("H$l", number_format($product_out_in, 0));
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
        $this->excel->getActiveSheet()->mergeCells("A$l:E$l");
        $sheet->setCellValue("E$l", number_format($in_out_product_sum, 0));
        $sheet->setCellValue("F$l", number_format($product_in_sum, 0));
        $sheet->setCellValue("G$l", number_format($product_out_sum, 0));
        $sheet->setCellValue("H$l", number_format($product_out_in_sum, 0));
        $sheet->getStyle("A$l:H$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $this->excel->getActiveSheet()->getStyle("E2:E$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $this->excel->getActiveSheet()->getStyle("F2:F$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $this->excel->getActiveSheet()->getStyle("G2:G$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $this->excel->getActiveSheet()->getStyle("H2:H$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:H$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'รายงานสรุปความเคลื่อนไหวสินค้า ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
