<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />       
        <title><?php echo isset($title) ? $title . ' | Stock & POS manager' : 'Stock & POS manager'; ?></title>    
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/favicon.png'; ?>">
        <meta name="robots" content="noindex, nofollow">

        <?php
        $shop_id_pri = $this->session->userdata('shop_id_pri');
        $shop = $this->accesscontrol->getMyShop($shop_id_pri);
        $user_id = $this->session->userdata('user_id');
        $user = $this->accesscontrol->getUser($user_id)->row();
        $package_id = $this->session->userdata('package_id');
        $package = $this->accesscontrol->getPackage($package_id)->row();
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->css('style_1.css');
        ?>

        <link href="<?php echo base_url() . 'assets/css/colors/' . $user->style . '.css'; ?>" id="theme" rel="stylesheet">

        <?php
        echo $this->assets->plugins_js('jquery/jquery.min.js');
        echo $this->assets->plugins_js('bootstrap/js/tether.min.js');
        echo $this->assets->plugins_js('bootstrap/js/bootstrap.min.js');
        ?>

    </head>    

    <body style="color: black;">
        <div style="padding-top: 20px">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-8">
                        <div class="card">
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table class="table">                
                                        <tbody>
                                            <tr>
                                                <th class="text-right" width="5%">ลำดับ</th>
                                                <th class="text-left">รายการ</th>
                                                <th class="text-right">ราคาต่อหน่วย</th>
                                                <th class="text-right">จำนวน</th>
                                                <th class="text-right">ราคา</th>
                                            </tr>
                                            <?php
                                            $datas = $this->selleasy_model->getreceipttemp();
                                            if ($datas->num_rows() > 0) {
                                                $i = 1;
                                                foreach ($datas->result() as $data) {
                                                    ?>                    
                                                    <tr>
                                                        <td class="text-right"><?php echo $i; ?></td>
                                                        <td class="text-left"><?php echo $data->product_name; ?></td>
                                                        <td class="text-right"><?php echo number_format($data->product_price, 2); ?></td>
                                                        <td class="text-right"><?php echo $data->product_amount; ?></td>
                                                        <td class="text-right"><?php echo number_format(($data->product_price * $data->product_amount), 2) . ' บาท'; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="" style="font-size: 22px;font-weight: bold;" ><?php echo 'ยอดชำระทั้งสิน '; ?></div> 
                                        <div class="text-right  text-primary" style="font-size: 26px;font-weight: bold;"><?php echo number_format($price_sum_pay, 2) . ' บาท'; ?></div> 
                                        <?php if ($status == 1) { ?>
                                            <div class="" style="font-size: 20px;font-weight: bold;" ><?php echo 'รับเงิน '; ?></div> 
                                            <div class="text-right text-warning" style="font-size: 24px;font-weight: bold;"><?php echo number_format($get_pay_money, 2) . ' บาท'; ?></div> 
                                            <div class="" style="font-size: 20px;font-weight: bold;" ><?php echo 'เงินทอน '; ?></div> 
                                            <div class="text-right text-success" style="font-size: 24px;font-weight: bold;"><?php echo number_format(($get_pay_money - $price_sum_pay), 2) . ' บาท'; ?></div> 
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-block" style="background: #263238;">
                                        <div class="text-white" style="font-size: 22px;font-weight: bold;"><?php echo $shop->shop_promptpay_name; ?></div>
                                        <br/>
                                        <div class="text-center">
                                            <image src="<?php echo base_url() . 'store/image/promptpay.png'; ?>" class="img-responsive"/>
                                        </div>
                                        <br/>
                                        <?php
                                        if ($shop->shop_promptpay_id != null || $shop->shop_promptpay_id != '') {
                                            ?>
                                            <div class="text-center">
                                                <image src="<?php echo 'https://promptpay.io/' . $shop->shop_promptpay_id . '/' . number_format($price_sum_pay, 2, '.', ''); ?>" class="img-responsive img-thumbnail"/>
                                            </div>
                                        <?php } ?>
                                        <br/>
                                        <div class="text-center">
                                            <image src="<?php echo base_url() . 'store/image/promptpaybank.png'; ?>" class="img-responsive"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </body>
</html>
