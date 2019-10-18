<?php
$data = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
$shop = $this->receipt_model->get_shop($data->shop_id_pri)->row();
$image = $this->receipt_model->get_image($shop->image_id)->row()->image_name;
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                /*margin: 5mm 10mm 0mm 10mm;*/
            }
            td{
                border: 0px solid black;
            }
            p{
                font-size: 14pt;
            }
        </style>
    </head>   
    <body>
        <table height="15mm" style="border-collapse: collapse;width: 100%; margin-bottom: 0.05in;"> 
            <tr>
                <td width="53mm" height="15mm" rowspan="2">

                </td>
                <td height="7mm" rowspan="2" style="text-align: center">
                    <p style="font-size: 20pt; font-weight:bold;"><?php echo ($data->type_receipt_id == 3)? '' : ''; ?><?php echo $this->receipt_model->ref_type_receipt($data->type_receipt_id)->row()->type_receipt_name; ?><?php echo ($data->type_receipt_id == 3)? ' / ใบกำกับภาษี' : ''; ?></p>
                </td>
                <td width="15mm" height="7mm" style="border: 1px solid black;text-align: center">
                    <p style="font-weight:bold;"><?php echo 'เลขที่'; ?></p>
                </td>
                <td width="38mm" height="7mm" style="border: 1px solid black;">
                    <p>&nbsp;<?php echo $data->receipt_master_id; ?></p>
                </td>
            </tr>
            <tr>
                <td width="15mm" height="7mm" style="border: 1px solid black;text-align: center">
                    <p style="font-weight:bold;"><?php echo 'วันที่'; ?></p>
                </td>
                <td width="38mm" height="7mm" style="border: 1px solid black;">
                    <p>&nbsp;<?php echo $this->mics->dateen2stringthnum($data->date_receipt); ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>