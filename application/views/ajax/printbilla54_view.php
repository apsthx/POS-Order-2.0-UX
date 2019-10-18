<?php
$data = $this->receipt_model->get_receipt_master_id($receipt_master_id_pri)->row();
$shop = $this->receipt_model->get_shop($data->shop_id_pri)->row();
$image = $this->receipt_model->get_image($shop->image_id)->row()->image_name;
$user = $this->receipt_model->get_user($data->user_id)->row();
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                /*margin: 0.25in 0.25in 0.5in 0.25in;*/
            }
            td{                
                border: 0px solid black;
                padding: 0mm 0mm 0mm 0mm;
                /*vertical-align: central;*/
            }
            p{
                font-size: 13pt;
            }
        </style>
    </head>   
    <body>
        <table style="width: 100%;margin-bottom: 0.05in; border-collapse: collapse;"> 
            <tr>
                <td style="border: 0px solid black;">
                    <table style="border-collapse: collapse;width: 100%;"> 
                        <tr style="border-collapse: collapse">
                            <td style="vertical-align: bottom; text-align: center;"  height="5mm" >

                            </td> 
                        </tr>
                        <tr>
                            <td style="font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo '' ?></p>
                            </td> 
                        </tr>
                        <tr>
                            <td style="font-weight:bold; text-align: center;" height="5mm" >
                                <?php if($data->type_receipt_id == 2){ ?>
                                <p><?php echo 'ลูกค้า อนุมัติสั่งซื้อ' ?></p>
                                <?php }else{ ?>
                                <p><?php echo 'ลูกค้า ผู้รับสินค้า' ?></p>
                                <?php } ?>
                            </td> 
                        </tr>
                        <tr>
                            <td style="font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo 'วันที่ _____/_____/_____' ?></p>
                            </td> 
                        </tr>
                    </table>
                </td>
                <td width="2mm">
                    
                </td>
                <td style="border: 0px solid black;">
                    <table  style="border-collapse: collapse; width: 100%;" > 
                        <tr style="border-collapse: collapse">
                            <td style="vertical-align: bottom; text-align: center;"  height="5mm" >
                                
                            </td> 
                        </tr>
                        <tr>
                            <td style="font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo $user->fullname ?></p>
                            </td> 
                        </tr>
                        <tr>
                            <td style="font-weight:bold; text-align: center;" height="5mm" >
                                <?php if($data->type_receipt_id == 2){ ?>
                                <p><?php echo 'ผู้เสนอราคา' ?></p>
                                <?php }else{ ?>
                                <p><?php echo 'ผู้รับเงิน' ?></p>
                                <?php } ?>
                            </td> 
                        </tr>
                        <tr>
                            <td style="text-align: center;" height="5mm" >
                                <span style="font-size: 14pt;"><b><?php echo 'วันที่  '; ?></b></span><span style="font-size: 14pt;"><?php echo $this->mics->dateen2stringthnum($data->date_receipt); ?></span>
                            </td> 
                        </tr>
                    </table>
                </td>
                <td width="2mm">
                    
                </td>
                <td style="border: 0px solid black;">
                   <table style="border-collapse: collapse; width: 100%;"> 
                        <tr style="border-collapse: collapse">
                            <td style="vertical-align: bottom; text-align: center;"  height="5mm" >
                                
                            </td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: bottom; font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo ''; ?></p>
                            </td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: bottom; font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo 'ผู้จัดการ' ?></p>
                            </td> 
                        </tr>
                        <tr>
                            <td style="vertical-align: bottom; font-weight:bold; text-align: center;" height="5mm" >
                                <p><?php echo 'วันที่ _____/_____/_____' ?></p>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>