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
        $admin_id = $this->session->userdata('admin_id');
        $admin = $this->accesscontrol->getadmin($admin_id);
        ?> 

        <?php
        echo $this->assets->plugins_css('bootstrap/css/bootstrap.min.css');
        echo $this->assets->plugins_css('bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css');
        echo $this->assets->plugins_css('bootstrap-datepicker/bootstrap-datepicker.min.css');
        echo $this->assets->css('style_1.css');
        echo $this->assets->css('loading.min.css');
        echo $this->assets->css('fancybox/dist/jquery.fancybox.css');
        echo $this->assets->css('parsley.css');
        ?>

        <!-- You can change the theme colors from here -->
        <link href="<?php echo base_url() . 'assets/css/colors/' . 'blue' . '.css'; ?>" id="theme" rel="stylesheet">

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
                    <div class="navbar-header text-left" style="padding-left: 15px">
                        <a class="navbar-brand" href="<?php echo base_url() . 'admin'; ?>">
                            <!-- Logo icon -->
                            <b>
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Light Logo icon -->
                                <img src="<?php echo ($admin->image_name != null )? base_url() . 'assets/upload/img/'.$admin->image_name : base_url() . 'assets/img/logo1.png'; ?>" alt="homepage" style="max-height: 45px;"  class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
<!--                            <span style="color: #fff; font-weight:bold;">
                                 Light Logo text     
                            <?php //echo 'APSTH';  ?>
                                <img src="<?php //echo base_url() . 'assets/images/logo-light-text.png';        ?>" class="light-logo" alt="homepage" />
                            </span> -->
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
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="<?php echo base_url() . 'admin/profile'; ?>">
                                    <span style="color: #fff; font-weight:bold;">&nbsp;<?php echo ($admin->name != null)? $admin->name : 'Admin APS'; ?>&nbsp;</span>
                                </a>
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="<?php echo base_url() . 'admin/login/logout'; ?>">
                                    <i class="fa fa-power-off"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
