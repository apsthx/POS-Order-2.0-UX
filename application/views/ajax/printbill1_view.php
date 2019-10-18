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
            }
            p{
                font-size: 14pt;
            }
        </style>
    </head>   
    <body>
        <table height="25mm" style="border-collapse: collapse;width: 100%;margin-bottom: 0.05in;"> 
            <tr>
                <td width="25mm" rowspan="4"><img width="25mm" src="<?php echo base_url() . 'store/image/' . $image; ?>"></td>
                <td style="vertical-align: top; text-align: right;" height="4mm">
                    <?php if($pageall > 1){ ?>
                    <p style="font-size: 12pt;"><?php echo 'หน้า '.$page.'/'.$pageall; ?></p>
                    <?php } else{ ?>
                    <p style="font-size: 12pt;"><?php echo 'หน้า 1'; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr >
                <td style="padding-left: 0.2in; vertical-align: bottom;" height="7mm">
                    <p style="font-size: 20pt;font-weight:bold"><?php echo $shop->shop_name; ?></p>
                </td>
            </tr>
            <tr >
                <td style="padding-left: 0.2in; padding-top: -5px;" height="5mm">
                    <p><?php echo $shop->address_shop . ' โทร ' . $shop->tel_shop; ?></p>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 0.2in; padding-top: -5px; vertical-align: top;" height="9mm">
                    <p><?php echo 'อีเมล ' . $shop->email_shop . ' เลขประจำตัวผู้เสียภาษี ' . $shop->tax_id; ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>