<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li <?php echo (1 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/home'; ?>" aria-expanded="false"><i class="fa fa-home"></i><?php echo 'ภาพรวม'; ?></a>                                       
                </li>   
                <li <?php echo (2 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/package'; ?>" aria-expanded="false"><i class="fa fa-gift"></i><?php echo 'แพ็กเกจ/บริการSMS'; ?></a>                                       
                </li>
                <li <?php echo (3 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/user'; ?>" aria-expanded="false"><i class="fa fa-users"></i><?php echo 'ผู้ใช้งาน'; ?></a>                                       
                </li>
                <li <?php echo (4 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/role'; ?>" aria-expanded="false"><i class="fa fa-key"></i><?php echo 'สิทธิ์การใช้งาน'; ?></a>                                       
                </li>
                <li <?php echo (5 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/groupmenu'; ?>" aria-expanded="false"><i class="fa fa-gears"></i><?php echo 'กลุ่มเมนู'; ?></a>                                       
                </li>
                <li <?php echo (6 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/email'; ?>" aria-expanded="false"><i class="fa fa-envelope"></i><?php echo ' อีเมล์/SMS'; ?></a>                                       
                </li>
                <li <?php echo (7 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/settingsms'; ?>" aria-expanded="false"><i class="fa fa-bell"></i><?php echo 'เครดิต SMS'; ?></a>                                       
                </li>
                <li <?php echo (8 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/bank'; ?>" aria-expanded="false"><i class="fa fa-address-card"></i><?php echo ' บัญชีธนาคาร'; ?></a>                                       
                </li>
                <li <?php echo (9 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/receipt'; ?>" aria-expanded="false"><i class="fa fa-money"></i><?php echo ' โอนเงิน'; ?></a>                                       
                </li>
                <li <?php echo (10 == $menu_id ? 'class="active"' : ''); ?> >
                    <a href="<?php echo base_url() . 'admin/report'; ?>" aria-expanded="false"><i class="fa fa-list-ul"></i><?php echo ' รายงาน'; ?></a>                                       
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles" style="padding-bottom: 5px; padding-top: 5px;"> 
            <div class="col-md-7 col-4 align-self-center">
                <div class="d-flex m-t-10 justify-content-end">       
                    <div class="">
                        <!--<button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->