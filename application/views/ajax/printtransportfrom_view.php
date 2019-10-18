<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                /*margin: 5mm 5mm 1mm 5mm;*/
            }
            td{
                border: 0px solid black;
                padding: 0mm 0mm 0mm 0mm;
                /*height: 3mm;*/
            }
            p{
                font-size: 15pt;
            }
            .barcode {
                margin: 0;
                width: 20mm;    
                vertical-align: central;
                color: #000000;
            }
        </style>
    </head>   
    <body>
        <table height="50mm" style="border-collapse: collapse;width: 100%;margin-bottom: 0.05in;"> 
            <tr>
                <td><p></p></td>
                <td width="35mm" style="vertical-align: top; text-align: right"><img width="20mm" src="<?php echo base_url() . 'store/image/EMS_logo.jpg'; ?>"></td>
                <td><p></p></td>
            </tr>
            <tr>
                <td width="8mm"><p style="font-size: 11pt; font-weight: bold">ผู้ส่ง</p></td>
                <td style="vertical-align: top; text-align: right; padding-right: 12px" colspan="2"><p style="font-size: 10pt; font-weight: bold"><?php echo $data->receipt_master_id ;?></p></td>
            </tr>
            <tr>
                <td><p></p></td>
                <td colspan="2">
                    <p><?php echo $send_name.'  '.$transport_tel ; ?></p>
                </td>
            </tr>
            <tr>
                <td><p></p></td>
                <td colspan="2">
                    <p><?php echo $send_address; ?></p>
                </td>
            </tr>
            <tr>
                <td><p></p></td>
                <td><p></p></td>
                <td><p></p></td>
            </tr>
        </table>
    </body>
</html>
