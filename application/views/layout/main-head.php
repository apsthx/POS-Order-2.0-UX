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
        if ($this->session->userdata('role_id') != 8) {
            $shop_id_pri = $this->session->userdata('shop_id_pri');
            $shop = $this->accesscontrol->getMyShop($shop_id_pri);
            $user_id = $this->session->userdata('user_id');
            $user = $this->accesscontrol->getUser($user_id)->row();
            $package_id = $this->session->userdata('package_id');
            $package = $this->accesscontrol->getPackage($package_id)->row();
        } else {
            $shop_id_pri = $this->session->userdata('shop_id_pri');
            $shop = $this->accesscontrol->getMyShop($shop_id_pri);
            $user_id = $this->session->userdata('user_id');
            $user = $this->accesscontrol->getCustomer($user_id)->row();
        }
        ?> 

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->plugins_css('bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css');
        echo $this->assets->plugins_css('bootstrap-datepicker/bootstrap-datepicker.min.css');
        echo $this->assets->css('style_1.css');
        echo $this->assets->css('loading.min.css');

        echo $this->assets->css('jquery.Thailand.min.css');
//        echo $this->assets->css('fancybox/dist/jquery.fancybox.css');
        ?>

        <!-- You can change the theme colors from here -->
        <link href="<?php echo base_url() . 'assets/css/colors/' . $user->style . '.css'; ?>" id="theme" rel="stylesheet">

        <?php
        //Add CSS file optional
        if (isset($css)) {
            foreach ($css as $link_css) {
                echo $this->assets->css($link_css);
            }
        }

        echo $this->assets->plugins_js('jquery/jquery.min.js');
        echo $this->assets->plugins_js('bootstrap/js/tether.min.js');
        echo $this->assets->plugins_js('bootstrap/js/bootstrap.min.js');
        echo $this->assets->plugins_js('loading.min.js');
        echo $this->assets->plugins_js('moment/moment.js');
        echo $this->assets->plugins_js('bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js');
        echo $this->assets->plugins_js('bootstrap-datepicker/bootstrap-datepicker.min.js');
        ?>

    </head>    

    <body class="fix-header card-no-border">
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" >
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar">
                <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-header text-left" style="padding-left: 16px">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <!-- Logo icon -->
                            <b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Light Logo icon -->
                                <img src="<?php echo base_url() . 'store/image/' . $this->accesscontrol->getImage($shop->image_id)->image_name; ?>" alt="homepage" style="max-width: 45px"  class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span style="color: #fff; font-weight:bold;">
                                <!-- Light Logo text -->    
                                <?php echo $shop->shop_name; ?>

                                <?php
//                                $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
//                                echo '/'.$this->accesscontrol->checkuseuser($package_shop->package_shop_id_pri);
//                                
//                                $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
//                                echo '/'.$this->accesscontrol->checkuseshop($package_shop->package_shop_id_pri);
//                                
//                                $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
//                                echo '/'.$this->accesscontrol->checkuseagent($package_shop->package_shop_id_pri);
//                                
                                if ($this->session->userdata('role_id') != 8) {
                                    $package_shop = $this->accesscontrol->getUserPackage($this->session->userdata('user_id'))->row();
                                    $stop_usedate = date('Y-m-d', strtotime($package_shop->user_package_modify . "+$package->package_usedate day"));
                                    if ($stop_usedate > $package_shop->user_package_modify) {
                                        $checkusedate = 1;
                                    } else {
                                        $checkusedate = 0; //หมดอายุ
                                    }
                                }else{
                                    $checkusedate = 1;
                                }
                                ?>

<!--<img src="<?php //echo base_url() . 'assets/images/logo-light-text.png';         ?>" class="light-logo" alt="homepage" />-->
                            </span> 
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav mr-auto mt-md-0">
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        </ul>
                        <!-- ============================================================== -->
                        <ul class="navbar-nav my-lg-0">   
                            <!-- ============================================================== -->
                            <!-- Profile -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <span style="color: #fff; font-weight:bold;"><?php echo $user->fullname; ?></span>
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() . 'store/image/' . $this->accesscontrol->getImage($user->image_id)->image_name; ?>" alt="user" class="profile-pic" /></a>
                                <div class="dropdown-menu dropdown-menu-right scale-up">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-img"><img src="<?php echo base_url() . 'store/image/' . $this->accesscontrol->getImage($user->image_id)->image_name; ?>" alt="user"></div>
                                                <div class="u-text">
                                                    <h4><?php echo $this->accesscontrol->getRole($this->session->userdata('role_id'))->row()->role_name; ?></h4>
                                                    <p class="text-muted"><?php echo $user->email; ?></p>
                                                    <?php if ($this->session->userdata('role_id') != 8) { ?>
                                                        <a href="javascript:void(0)" class="btn btn-rounded btn-danger btn-sm"><?php echo $package->package_name; ?></a>
                                                    <?php } ?>  
                                                </div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo ($this->session->userdata('role_id') != 8) ? base_url() . 'profile' : base_url() . 'profilecustomer'; ?>"><i class="fa fa-user-circle"></i> ข้อมูลส่วนตัว</a></li>
                                        <?php
                                        if ($this->session->userdata('role_id') != 8) {
                                            if ($shop->type_shop_id == 1) {
                                                ?>
                                                <li><a href="<?php echo base_url() . 'package'; ?>"><i class="fa fa-gift"></i> แพ็กเกจ & อัตราค่าบริการ SMS</a></li>
                                                <li><a href="<?php echo base_url() . 'payment'; ?>"><i class="fa fa-pencil-square-o"></i> แจ้งชำระเงิน </a></li>
                                            <?php }
                                            else { ?>
                                                <li><a href="<?php echo base_url() . 'package'; ?>"><i class="fa fa-gift"></i> อัตราค่าบริการ SMS</a></li>
                                                <li><a href="<?php echo base_url() . 'payment'; ?>"><i class="fa fa-pencil-square-o"></i> แจ้งชำระเงิน </a></li>
                                            <?php } ?> 
                                            <li><a href="http://pos.apsth.com" target="_blank"><i class="fa fa-user-circle-o"></i> ผู้ให้บริการ & ติดต่อสอบถาม</a></li>
                                        <?php } ?> 
                                        <li role="separator" class="divider"></li>
                                        <li><a href="<?php echo base_url() . 'login/logout'; ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
