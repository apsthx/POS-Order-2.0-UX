<?php
$data = $this->services_model->get_services_master_id($services_master_id_pri)->row();
$data_detail = $this->services_model->get_services_detail($services_master_id_pri,$limit,$start);
$shop = $this->services_model->get_shop($data->shop_id_pri)->row();
$image = $this->services_model->get_image($shop->image_id)->row()->image_name;
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">   
        <style>
            @page  {
                /*margin: 0.25in 0.25in 0.5in 0.25in;*/
            }
            td{   
                border-right: 1px solid black;
                border-left: 1px solid black;
                /*border: 1px solid black;*/
                /*vertical-align: central;*/
            }
            th{
                border: 1px solid black;
            }
            p{
                font-size: 14pt;
            }
        </style>
    </head>   
    <body>
        <table height="138mm" width="190mm" style="width: 100%; margin-bottom: 0.05in; border: 1px solid black; border-collapse: collapse;"> 
            <tr>
                <th height="6mm" width="10mm">
                    <p><?php echo 'ลำดับ' ?></p>
                </th>
                <th width="98mm">
                    <p><?php echo 'รายการ' ?></p>
                </th>
                <th width="16mm">
                    <p><?php echo 'จำนวน' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'ราคา/หน่วย' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'ส่วนลด' ?></p>
                </th>
                <th width="22mm">
                    <p><?php echo 'จำนวนเงิน' ?></p>
                </th>
            </tr>
            <?php  $num_detail = $data_detail->num_rows();
            if($num_detail > 0){
                $num = $limit - $num_detail;
                $number = 1;
                foreach ($data_detail->result() as $datas){ ?>
                    <tr>
                    <td style="padding-right: 7px; text-align: right;" height="6mm">
                        <?php if($datas->services_detail_number == null){ ?>
                        <p><?php echo $number ?></p>                       
                        <?php 
                            $number++;
                        } else { ?>
                        <p><?php echo '' ?></p>
                        <?php } ?>
                    </td>
                    <td style="padding-left: 7px;">
                        <p><?php echo $this->mics->ShortenTitle($datas->services_name,60) ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo ($datas->services_detail_number == null)? $datas->services_amount : ''; ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo ($datas->services_detail_number == null)? $datas->services_price : ''; ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo ($datas->services_detail_number == null)? $datas->services_save : ''; ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo ($datas->services_detail_number == null)? $datas->services_price_sum : ''; ?></p>
                    </td>
                </tr>
                <?php 
                
                }
            }else{
                $num = $limit;
            }
            for($i = 1; $i <= $num; $i++){ ?>
                <tr>
                    <td style="padding-left: 7px;" height="6mm">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-left: 7px;">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                    <td style="padding-right: 7px; text-align: right">
                        <p><?php echo '' ?></p>
                    </td>
                </tr>
            <?php } ?>
            <tr style="border: 1">
                <td height="88mm" width="124mm" colspan="3" rowspan="3" style="padding-left: 7px; text-align: left; vertical-align: top;"> 
                    <span style="font-size: 14pt;"><b><?php echo 'หมายเหตุ '; ?></b></span><span style="font-size: 14pt;"><?php echo $data->comment; ?></span>
                </td>               
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'รวมเงิน' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_product_sum,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'ส่วนลดการค้า' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo $data->save; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'เงินหลังหักส่วนลด' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_befor_tax,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">                 
                <td width="30mm" rowspan="4" colspan="3" style="text-align: center;">
                    <table>
                        <tr>
                            <td rowspan="3" style="border: 0;">
                                <img width="22mm" src="<?php echo 'https://promptpay.io/'.$shop->shop_promptpay_id.'/'.number_format($data->price_sum_pay,2,'.',''); ?>">
                            </td>
                            <td style="font-size: 14pt; text-align: left; padding-left: 10px; font-weight: bold; border: 0;">
                                <?php echo $shop->shop_promptpay_name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 0;">
                                <img width="34mm" hight="15mm" src="<?php echo base_url() . 'store/image/promptpay.png'; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; border: 0;">
                                <img width="33mm" hight="15mm" src="<?php echo base_url() . 'store/image/promptpaybank.png'; ?>"/>
                            </td>
                        </tr>
                    </table>
                </td> 
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'ภาษีมูลค่าเพิ่ม 7%' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_tax,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">                
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'มูลค่ารวม' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'ค่าขนส่ง' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->transport_price,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'ภาษีหัก ณ ที่จ่าย' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo $data->withholding_tax; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
            <tr style="border: 1">
                <td height="6mm" colspan="3" style="font-weight: bold; text-align: center;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo '('.$this->mics->ThaiBahtConversion($data->price_sum_pay).')'; ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
                <td width="44mm" colspan="2" style="padding-left: 7px; font-weight: bold;">
                    <p><?php echo 'จำนวนเงินชำระสุทธิ' ?></p>
                </td>
                <td width="22mm" style="padding-right: 7px; font-weight: bold; text-align: right;">
                    <?php if($page == $pageall){ ?>
                    <p><?php echo number_format($data->price_sum_pay,2,'.',','); ?></p>
                    <?php } else{ ?>
                    <p><?php echo ''; ?></p>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </body>
</html>