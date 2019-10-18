<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <!--<a href="<?php echo base_url(); ?>" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">ภาพรวม </span></a>-->                  
                </li>
                <?php
                $role_id = $this->session->userdata('role_id');
                $package_id = $this->session->userdata('package_id');
                $group_menu = $this->accesscontrol->getGroupMenuByRole($role_id);
                if ($group_menu->num_rows() > 0) {
                    foreach ($group_menu->result() as $g) {
                        if ($this->accesscontrol->checkmenugroup($g->group_menu_id) != $this->accesscontrol->checkmenupackage($g->group_menu_id,$package_id)) {                            
                            ?>
                            <li <?php echo ($g->group_menu_id == $group_id ? 'class="active"' : ''); ?>>
                                <a class="has-arrow" href="#" aria-expanded="false"><i class="<?php echo $g->group_menu_icon ?>"></i><span class="hide-menu"><?php echo $g->group_menu_name; ?></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <?php
                                    $menu = $this->accesscontrol->getMenuByGroup($g->group_menu_id, $role_id);
                                    if ($menu->num_rows() > 0) {
                                        foreach ($menu->result() as $m_m) {
                                            if ($m_m->menu_status_id == 1) {
                                                if ($this->accesscontrol->getMenuPackage($m_m->menu_id, $package_id) == 0) {
                                                    ?>
                                                    <li <?php echo ($m_m->menu_id == $menu_id ? 'class="active"' : ''); ?>>
                                                        <a <?php echo ($m_m->menu_id == $menu_id ? 'class="active"' : ''); ?> href="<?php echo ($m_m->menu_status_id == 3 ? 'javascript:void(0);' : ($m_m->menu_link != '#' ? $url = base_url() . $m_m->menu_link : '#')); ?>">
                                                            <?php echo $m_m->menu_name; ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                }
                ?>                     
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