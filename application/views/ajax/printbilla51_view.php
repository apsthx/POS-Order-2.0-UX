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
                /*margin: 7mm 10mm 0mm 10mm;*/
            }
            td{
                border: 0px solid black;
                padding: 0mm 0mm 0mm 0mm;
            }
            p{
                font-size: 13pt;
            }
        </style>
    </head>   
    <body>
        <table height="14mm" style="border-collapse: collapse;width: 100%;margin-bottom: 0.05in;"> 
            <tr>
                <td width="16mm" rowspan="4"><img width="16mm" src="<?php echo base_url() . 'store/image/' . $image; ?>"></td>
                <td style="padding-left: 0.2in; vertical-align: bottom;" height="4mm" rowspan="2">
                    <p style="font-size: 16pt;font-weight:bold"><?php echo $shop->shop_name; ?></p>
                </td>
                <td style="vertical-align: top; text-align: right;" height="2mm" colspan="2">
                    <?php if($pageall > 1){ ?>
                    <p style="font-size: 8pt;"><?php echo 'หน้า '.$page.'/'.$pageall; ?></p>
                    <?php } else{ ?>
                    <p style="font-size: 8pt;"><?php echo 'หน้า 1'; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr >
                
                <td style="text-align: right" colspan="2">
                    <p style="font-size: 14pt; font-weight:bold;"><?php echo ($data->type_receipt_id == 3)? '' : ''; ?><?php echo $this->receipt_model->ref_type_receipt($data->type_receipt_id)->row()->type_receipt_name; ?><?php echo ($data->type_receipt_id == 3)? ' / ใบกำกับภาษี' : ''; ?></p>
                </td>
            </tr>
            <tr >
                <td style="padding-left: 0.2in; padding-top: -5px;" height="4mm">
                    <p><?php echo $shop->address_shop . ' โทร ' . $shop->tel_shop; ?></p>
                </td>
                <td width="15mm" style="border: 1px solid black;text-align: center">
                    <p style="font-weight:bold;"><?php echo 'เลขที่'; ?></p>
                </td>
                <td width="30mm" style="border: 1px solid black;">
                    <p>&nbsp;<?php echo $data->receipt_master_id; ?></p>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 0.2in; padding-top: -5px; vertical-align: top;" height="4mm">
                    <p><?php echo 'อีเมล ' . $shop->email_shop . ' เลขประจำตัวผู้เสียภาษี ' . $shop->tax_id; ?></p>
                </td>
                <td width="15mm" style="border: 1px solid black;text-align: center">
                    <p style="font-weight:bold;"><?php echo 'วันที่'; ?></p>
                </td>
                <td width="30mm" style="border: 1px solid black;">
                    <p>&nbsp;<?php echo $this->mics->dateen2stringthnum($data->date_receipt); ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>
