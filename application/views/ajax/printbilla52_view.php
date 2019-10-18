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
                /*margin: 8mm 10mm 0mm 10mm;*/
            }
            td{                
                border: 0px solid black;
                /*vertical-align: central;*/
            }
            p{
                font-size: 13pt;
            }
        </style>
    </head>   
    <body>
        <table height="12mm" style="width: 100%;margin-bottom: 0.05in; border-collapse: collapse;"> 
            <tr>
                <td style="padding-left: 10px; border: 1px solid black;">
                    <table height="9mm" width="120mm" style="border-collapse: collapse;"> 
                        <tr style="border-collapse: collapse">
                            <td style="font-weight:bold;"  height="4mm" width="17mm">
                                <p><?php echo 'ชื่อผู้ติดต่อ' ?></p>
                            </td>
                            <td colspan="2" width="98mm">
                                <p><?php echo $data->customer_name ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold; vertical-align: top;"  height="4mm" >
                                <p><?php echo 'ที่อยู่' ?></p>
                            </td>
                            <td colspan="2" width="98mm" style="vertical-align: top;"  height="4mm">
                                <p><?php echo $data->customer_address.' '.$data->customer_district.' '.$data->customer_amphoe.' '.$data->customer_province.' '.$data->customer_zipcode; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;" height="4mm">
                                <p><?php echo 'โทร' ?></p>
                            </td>
                            <td width="44mm">
                                <p><?php echo $data->customer_tel; ?></p>
                            </td>
                            <td width="70mm">
                                <span style="font-size: 12pt;"><b><?php echo 'เลขประจำตัวผู้เสียภาษี'; ?></b></span>&nbsp;&nbsp;<span style="font-size: 14pt;"><?php echo $data->customer_tax_id; ?></span>
                            </td>
                        </tr>                                              
                    </table>
                </td>
                <td width="2mm">

                </td>
                <td style="padding-left: 10px ;border: 1px solid black;">
                    <table height="9mm" width="60mm" style="border-collapse: collapse;"> 
                        <tr style="border-collapse: collapse">
                            <td style="font-weight:bold;"  height="4mm" width="21mm">
                                <p><?php echo 'เลขที่อ้างอิง' ?></p>
                            </td>
                            <td>
                                <p><?php echo $data->refer; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;"  height="4mm" width="21mm">
                                <p><?php echo 'ช่องทางขาย' ?></p>
                            </td>
                            <td>
                                <p><?php echo $this->receipt_model->get_sale_from($data->sale_from_id)->row()->sale_from_name; ?></p>
                            </td>                          
                        </tr>
                        <tr>
                            <td style="font-weight:bold; vertical-align: central;"  height="4mm" width="21mm">
                                <p><?php echo 'ประเภทภาษี' ?></p>
                            </td>
                            <td>
                                <p><?php echo $this->receipt_model->ref_type_tax($data->type_tax_id)->row()->type_tax_name; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>