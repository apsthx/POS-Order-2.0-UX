<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportwarehouse
 *
 * @Prasan Srisopa
 */
class Reportwarehouse extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 57;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportwarehouse_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportwarehouse.js'),
        );
        $this->renderView('reportwarehouse_view', $data);
    }

    public function data() {
        $data = array(
            'datas' => $this->reportwarehouse_model->get_stock(),
        );
        $this->load->view('ajax/reportwarehouse_page', $data);
    }

    public function export() {
        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('รายงานสินค้าคงคลัง');

        $sheet->getColumnDimension('A')->setWidth(13);
        $sheet->getColumnDimension('B')->setWidth(37);
        $sheet->getColumnDimension('C')->setWidth(28);
        $sheet->getColumnDimension('D')->setWidth(12);

        $sheet->setCellValue("A1", 'รายงานสินค้าคงคลัง');

        $this->excel->getActiveSheet()->mergeCells("A1:D1");
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("A2", 'รหัส');
        $sheet->setCellValue("B2", 'คลังสินค้า / สินค้า');
        $sheet->setCellValue("C2", 'สินค้าคงคลัง / จำนวนคงเหลือ');
        $sheet->setCellValue("D2", 'หน่วยนับ');
        $sheet->getStyle("A1:D2")->getFont()->setBold(true);

        $l = 3;

        $datas = $this->reportwarehouse_model->get_stock();

        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $stock = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri)->row();
                $sheet->setCellValue("A$l", $data->stock_id);
                $sheet->setCellValue("B$l", $data->stock_name);
                $stock_amount = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri);
                if ($stock_amount->num_rows() > 0) {
                    $stockamount = $stock_amount->row()->stock_amount;
                } else {
                    $stockamount = 0;
                }
                $sheet->setCellValue("C$l", number_format($stockamount));
                $sheet->setCellValue("D$l", '');
                $sheet->getStyle("A$l:D$l")->getFont()->setBold(true);
                $l++;
                $map_products = $this->reportwarehouse_model->get_map_product_stock($data->stock_id_pri);
                if ($map_products->num_rows() > 0) {
                    foreach ($map_products->result() as $map_product) {
                        $product = $this->reportwarehouse_model->get_product($map_product->product_id_pri)->row();
                        $sheet->setCellValue("A$l", '   ' . $product->product_id);
                        $sheet->setCellValue("B$l", '   ' . $product->product_name);
                        $stock_amount = $this->reportwarehouse_model->get_stock_amount($data->stock_id_pri, $map_product->product_id_pri);
                            if ($stock_amount->num_rows() > 0) {
                                $stockamount = $stock_amount->row()->stock_amount;
                            } else {
                                $stockamount = 0;
                            }
                        $sheet->setCellValue("C$l", number_format($stockamount));
                        $sheet->setCellValue("D$l", $product->product_unit);
                        $l++;
                    }
                }
            }
        } else {
            $sheet->setCellValue("A$l", 'ไม่มีข้อมูล');
            $this->excel->getActiveSheet()->mergeCells("A$l:D$l");
            $sheet->getStyle("A$l")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $l++;
        }
        $l--;
        $sheet->getStyle("A2:D$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'รายงานจัดอันดับยอดซื้อลูกค้า ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
