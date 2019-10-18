<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reportusersell
 *
 * @Prasan Srisopa
 */
class Reportusersell extends CI_Controller{
    //put your code here
    public $group_id = 10;
    public $menu_id = 55;

    public function __construct() {
        parent::__construct();
        $this->auth->isLogin($this->menu_id);
        $this->load->model('reportusersell_model');
        $this->load->library('excel');
    }

    public function index() {
        $data = array(
            'group_id' => $this->group_id,
            'menu_id' => $this->menu_id,
            'icon' => $this->accesscontrol->getIcon($this->group_id),
            'title' => $this->accesscontrol->getNameTitle($this->menu_id),
            'js' => array('build/reportusersell.js'),
        );
        $this->renderView('reportusersell_view', $data);
    }

    public function data() {
        $data = array(
            'date_start' => $this->input->post('date_start'),
            'date_end' => $this->input->post('date_end'),
            'datas' => $this->reportusersell_model->get_user(),
        );
        $this->load->view('ajax/reportusersell_page', $data);
    }

    public function export($date_start, $date_end) {
        $sheet = $this->excel->setActiveSheetIndex();
        $sheet->setTitle('รายงานนจัดอันดับยอดขาย');

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        if ($date_start != 'null') {
            if ($date_end != 'null') {
                $sheet->setCellValue("A1", 'รายงานนจัดอันดับยอดขาย ตั้งแต่วันที่' . $this->mics->dateen2stringthMS($date_start) . ' ถึง ' . $this->mics->dateen2stringthMS($date_end));
            } else {
                $sheet->setCellValue("A1", 'รายงานนจัดอันดับยอดขาย วันที่' . $this->mics->dateen2stringthMS($date_start));
                $date_end = null;
            }
        } else {
            $sheet->setCellValue("A1", 'รายงานนจัดอันดับยอดขายทั้งหมด');
            $date_start = null;
            $date_end = null;
        }

        $this->excel->getActiveSheet()->mergeCells("A1:D1");
        $this->excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue("A2", '#');
        $sheet->setCellValue("B2", 'พนกงาน');
        $sheet->setCellValue("C2", 'ตำแหน่ง');
        $sheet->setCellValue("D2", 'จำนวนเงินสุทธิ');
        $sheet->getStyle("A1:D2")->getFont()->setBold(true);

        $l = 3;
        $i = 1;
        $price_sum_pay = 0;
        
        $datas = $this->reportusersell_model->get_user();
        
        if ($datas->num_rows() > 0) {
            foreach ($datas->result() as $data) {
                $users = $this->reportusersell_model->get_receipt_master($date_start, $date_end, $data->user_id);
                if ($users->num_rows() > 0) {
                    $sheet->setCellValue("A$l", $i);
                    $user = $users->row();
                    $sheet->setCellValue("B$l", $this->reportusersell_model->get_user($data->user_id)->row()->fullname.' ('.$data->user_id.')');                    
                    $sheet->setCellValue("C$l", $this->reportusersell_model->get_role($this->reportusersell_model->get_user($data->user_id)->row()->role_id)->row()->role_name);
                    $sheet->setCellValue("D$l", number_format($user->price_sum_pay, 2));
                    $price_sum_pay += $user->price_sum_pay;
                    $i++;
                    $l++;
                }
            }
        } else {
            $sheet->setCellValue("A$l", 'ไม่มีข้อมูล');
            $this->excel->getActiveSheet()->mergeCells("A$l:D$l");
            $sheet->getStyle("A$l")->getFont()->setBold(true);
            $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $l++;
        }
        $sheet->setCellValue("A$l", 'รวม');
        $this->excel->getActiveSheet()->mergeCells("A$l:C$l");
        $sheet->setCellValue("D$l", number_format($price_sum_pay, 2));
        $this->excel->getActiveSheet()->getStyle("D2:D$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        
        $sheet->getStyle("A$l:D$l")->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle("A$l")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle("A2:D$l")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        $filename = 'รายงานนจัดอันดับยอดขาย ข้อมูล ณ วันที่' . date('YmdHis') . '.xlsx';
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
