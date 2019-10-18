<?php
$shop = $this->receipt_model->get_shop(1)->row();
$image = $this->receipt_model->get_image($shop->image_id)->row()->image_name;
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                margin: 5mm 2mm 5mm 2mm;
            }
            td{
                border: 1px solid black;
            }
            p{
                font-size: 5pt;
            }
        </style>
    </head>   
    <body>
        <table height="25mm" width="55mm" style="border-collapse: collapse;"> 
            <tr>
                <td height="3mm" width="55mm" style="text-align: center">
                    <p style="font-size: 7pt; font-weight: bold;"><?php echo $shop->shop_name; ?></p>
                </td>
            </tr>
            <tr >
                <td height="3mm" style="text-align: center">
                    <p><?php echo $shop->address_shop; ?></p>
                </td>
            </tr>
            <tr >
                <td height="3mm" style="text-align: center">
                    <p><?php echo 'โทร ' . $shop->tel_shop . ' อีเมล ' . $shop->email_shop; ?></p>
                </td>
            </tr>
            <tr>
                <td height="3mm" style="text-align: center">
                    <p><?php echo 'เลขประจำตัวผู้เสียภาษี ' . $shop->tax_id; ?></p>
                </td>
            </tr>
            <tr>
                <td height="1mm" style="text-align: center">
                    
                </td>
            </tr>
            <tr>
                <td height="3mm" style="text-align: center">
                    <p style="font-weight: bold;"><?php echo 'ใบเสร็จรับเงิน'; ?></p>
                </td>
            </tr>
            <tr>
                <td height="3mm" style="text-align: left">
                    <p><?php echo 'เลขที่ใบเสร็จรับเงิน :' ; ?></p>
                </td>
            </tr>
            <tr>
                <td height="3mm" style="text-align: left">
                    <p><?php echo 'เลขที่อ้างอิง :' ; ?></p>
                </td>
            </tr>
            <tr>
                <td height="3mm" style="text-align: left">
                    <p><?php echo 'ลูกค้า :' ; ?></p>
                </td>
            </tr>
        </table>
    </body>
</html>