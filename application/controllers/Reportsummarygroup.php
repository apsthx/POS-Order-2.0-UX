<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportsummarygroup
 *
 * @author Prasan Srisopa
 */
class Reportsummarygroup extends CI_Controller {

    //put your code here
    public $group_id = 10;
    public $menu_id = 83;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportsummarygroup_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportsummarygroup.js'),
        );
        $this->renderView('reportsummarygroup_view', $data);
    }

    public function data() {
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $user_id = $this->input->post('user_id');
        $customer_group_id = $this->input->post('customer_group_id');
        $data = array(
            'datas' => $this->reportsummarygroup_model->get_receipt_master($date_start, $date_end, $user_id, $customer_group_id),
        );
        $this->load->view('ajax/reportsummarygroup_page', $data);
    }

    public function export($date_start, $date_end, $user_id, $customer_group_id) {
        
        if ($user_id == 'null') {
            $user_id = null;
        }
        if ($customer_group_id == 'null') {
            $customer_group_id = null;
        }
        
        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('ยอดขายพนักงาน(กลุ่มลูกค้า)');

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        if ($date_start != 'null') {
            if ($date_end != 'null') {
                $sheet->setCellValue("A1", 'ยอดขายพนักงาน(กลุ่มลูกค้า) ตั้งแต่วันที่' . $this->mics->dateen2stringthMS($date_start) . ' ถึง ' . $this->mics->dateen2stringthMS($date_end));
            } else {
                $sheet->setCellValue("A1", 'ยอดขายพนักงาน(กลุ่มลูกค้า) วันที่' . $this->mics->dateen2stringthMS($date_start));
                $date_end = null;
            }
        } else {
            $sheet->setCellValue("A1", 'ยอดขายพนักงาน(กลุ่มลูกค้า)ทั้งหมด');
            $date_start = null;
            $date_end = null;
        }

        $this->excel->getActiveSheet()->mergeCells("A1:E1");
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'พนกงาน');
        $sheet->setCellValue("C2", 'ตำแหน่ง');
        $sheet->setCellValue("D2", 'กลุ่มลูกค้า');
        $sheet->setCellValue("E2", 'จำนวนเงินสุทธิ');
        $sheet->getStyle("A1:E2")->getFont()->setBold(true);

        $l = 3;
        $i = 1;
        $price_sum_pay = 0;

        $datas = $this->reportsummarygroup_model->get_receipt_master($date_start, $date_end, $user_id, $customer_group_id);

        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {

                $sheet->setCellValue("A$l", $i);
                $sheet->setCellValue("B$l", $data->fullname);
                $sheet->setCellValue("C$l", $data->role_name);
                $sheet->setCellValue("D$l", $data->customer_group_name);
                $sheet->setCellValue("E$l", number_format($data->price_sum_pay, 2));
                $price_sum_pay += $data->price_sum_pay;
                $i++;
                $l++;
            }
        } else {
            $sheet->setCellValue("A$l", 'ไม่มีข้อมูล');
            $this->excel->getActiveSheet()->mergeCells("A$l:E$l");
            $sheet->getStyle("A$l")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $l++;
        }
        $sheet->setCellValue("A$l", 'รวม');
        $this->excel->getActiveSheet()->mergeCells("A$l:D$l");
        $sheet->setCellValue("E$l", number_format($price_sum_pay, 2));
        $this->excel->getActiveSheet()->getStyle("E2:E$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $sheet->getStyle("A$l:E$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:E$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'ยอดขายพนักงาน(กลุ่มลูกค้า) ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
