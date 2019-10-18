<?php
$data = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
$data_detail = $this->receipt_model->get_receipt_detail(null,$receipt_master_id_pri);
$shop = $this->receipt_model->get_shop($data->shop_id_pri)->row();
$image = $this->receipt_model->get_image($shop->image_id)->row()->image_name;
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <link href="<?php echo base_url() .'assets/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
        <style type="text/css">
            @media print {
                table tr .printtd {
                    background-color: #000000 !important;
                    -webkit-print-color-adjust: exact; 
                }
            }@page  {
                margin: 5mm 2mm 5mm 2mm;
            }
            p{
                margin: 0px 0px 0px 0px !important;
                font-family: "RSU";
                font-size: 10px;
            }
            table{
                width: 100%;
            }         
        </style>
    </head>
    <body onload="window.print();setTimeout(function(){window.close();},100);">
        <table tyle="border-collapse: collapse;"> 
            <tr>
                <td class="text-center" colspan="4">
                    <p><b><?php echo $shop->shop_name; ?></b></p>
                </td>
            </tr>
            <tr >
                <td class="text-center" colspan="4">
                    <p><?php echo $shop->address_shop; ?></p>
                </td>
            </tr>
            <tr >
                <td class="text-center" colspan="4">
                    <p><?php echo 'โทร ' . $shop->tel_shop . ' อีเมล ' . $shop->email_shop; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <p><?php echo 'TAX#' . $shop->tax_id. ' (VAT Included)'; ?></p>
                </td>
            </tr>
            <tr>
                <td  style="text-align: center">
                    
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <p style="font-weight: bold;"><?php echo 'ใบเสร็จรับเงิน / ใบกำกับภาษีอย่างย่อ'; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="4">
                    <p><?php echo 'เลขที่ใบเสร็จรับเงิน : '.$data->receipt_master_id ; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-left"colspan="4">
                    <p><?php echo 'เลขที่อ้างอิง : '.$data->refer ; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="4">
                    <p><?php echo 'วันที่ : '.$this->mics->dateen2stringthnum($data->date_receipt) ; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-left" colspan="4">
                    <p><?php echo 'ลูกค้า : '.$data->customer_name ; ?></p>
                </td>
            </tr>
            <?php  $num_detail = $data_detail->num_rows();
            if($num_detail > 0){
                foreach ($data_detail->result() as $datas){ ?>
                <tr>
                    <td>
                        <p><?php echo $datas->product_id.' '.$datas->product_name; ?></p>
                    </td>
                    <td>
                        <p><?php echo $datas->product_amount.' '.$datas->product_unit ?></p>
                    </td>
                    <td>
                        <p><?php echo $datas->product_price ?></p>
                    </td>
                    <td>
                        <p><?php echo ' '; ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?php echo '' ?></p>
                    </td>
                    <td>
                        <p><?php echo 'ส่วนลด' ?></p>
                    </td>
                    <td>
                        <p><?php echo $datas->product_save ?></p>
                    </td>
                    <td class="text-right">
                        <p><?php echo $datas->product_price_sum ?></p>
                    </td>
                </tr>
                <?php }
            } ?>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'รวมเงิน' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->price_product_sum,2,'.',','); ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'ส่วนลดการค้า' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo $data->save; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'เงินหลังหักส่วนลด' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->price_befor_tax,2,'.',','); ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'ภาษีมูลค่าเพิ่ม 7%' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->price_tax,2,'.',','); ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'มูลค่ารวม' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->price,2,'.',','); ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'ค่าขนส่ง' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->transport_price,2,'.',','); ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'หักภาษี ณ ที่จ่าย' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo $data->withholding_tax; ?></p>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="3">
                    <p><?php echo 'จำนวนเงินชำระสุทธิ' ?></p>
                </td>
                <td class="text-right">
                    <p><?php echo number_format($data->price_sum_pay,2,'.',','); ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>
