<?php
$data = $this->stickertransport_model->get_receipt_master_id($receipt_master_id_pri)->row();
$data_details = $this->stickertransport_model->get_receipt_detail($receipt_master_id_pri);
?>
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
                font-size: 14pt;
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
                <?php if($data->transport_service_id == 1){ ?>
                    <td width="35mm" style="vertical-align: top; text-align: right"><img width="20mm" src="<?php echo base_url() . 'store/image/EMS_logo.jpg'; ?>"></td>
                <?php }else if($data->transport_service_id == 2){ ?>
                    <td width="35mm" style="vertical-align: top; text-align: right"><img width="20mm" src="<?php echo base_url() . 'store/image/Kerry_logo.jpg'; ?>"></td>
                <?php }else if($data->transport_service_id == 3){ ?>
                    <td width="35mm" style="vertical-align: top; text-align: right"><img width="20mm" src="<?php echo base_url() . 'store/image/delivery_logo.jpg'; ?>"></td>
                <?php } ?>
                <td style="height: 7mm; text-align: right;"><barcode code="<?php echo $data->receipt_master_id ;?>" type="C128A" class="barcode" height="1" /></td>
            </tr>
            <tr>
                <td width="8mm"><p style="font-size: 10pt; font-weight: bold">ผู้รับ</p></td>
                <td style="vertical-align: top; text-align: right; padding-right: 12px" colspan="2"><p style="font-size: 10pt; font-weight: bold"><?php echo $data->receipt_master_id ;?></p></td>
            </tr>
            <tr>
                <td><p></p></td>
                <td colspan="2">
                    <p><?php echo $data->transport_customer  . '  ' .$data->transport_customer_tel ; ?></p>
                </td>
            </tr>
            <tr>
                <td><p></p></td>
                <td colspan="2">
                    <?php 
                    if($data->transport_customer_district != null){
                        $transport_customer_district = 'ต.'.$data->transport_customer_district;
                    }else{
                        $transport_customer_district = '';
                    }
                    if($data->transport_customer_amphoe != null){
                        $transport_customer_amphoe = 'อ.'.$data->transport_customer_amphoe;
                    }else{
                        $transport_customer_amphoe = '';
                    }
                    if($data->transport_customer_province != null){
                        $transport_customer_province = 'จ.'.$data->transport_customer_province;
                    }else{
                        $transport_customer_province = '';
                    }
                    if($data->transport_customer_zipcode != null){
                        $transport_customer_zipcode = $data->transport_customer_zipcode;
                    }else{
                        $transport_customer_zipcode = '';
                    }
                    ?>
                    <p><?php echo $data->transport_customer_address.' '.$transport_customer_district.' '.$transport_customer_amphoe.' '.$transport_customer_province.' '.$transport_customer_zipcode; ?></p>
                </td>
            </tr>
            <?php if($this->stickertransport_model->get_transport_setting()->row()->show_price == 1){
                    if($data->transport_service_id == 2){ ?>
                        <tr>
                            <td><p></p></td>
                            <td colspan="2" style="text-align: right;">
                                <p style="font-size: 11pt;"><?php echo 'COD จำนวน '.number_format($data->price_sum_pay,2).' บาท  '; ?></p>
                            </td>
                        </tr>
              <?php }         
            }
            if($this->stickertransport_model->get_transport_setting()->row()->show_product == 1){
                if ($data_details->num_rows() > 0) {
                    foreach ($data_details->result() AS $data_detail) { ?>
                        <tr>
                            <td><p></p></td>
                            <td colspan="2">
                                <p style="font-size: 10pt;"><?php echo '( '.$data_detail->product_name.' '.$data_detail->product_amount.' '.$data_detail->product_unit.' )'; ?></p>
                            </td>
                        </tr>
                <?php             
                    }            
                } 
            }
            ?>
        </table>
    </body>
</html>