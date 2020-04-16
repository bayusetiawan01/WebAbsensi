<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <hr class="sidebar-divider">
                <!-- Query Menu -->
                <?php
                $role_id = $this->session->userdata('role_id');
                $queryMenu = " SELECT `user_menu`.`id`, `menu` 
                                    FROM `user_menu` JOIN `user_access_menu`
                                    ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                                    WHERE `user_access_menu`.`role_id` = $role_id
                                    ORDER BY `user_access_menu`.`menu_id` ASC ";
                $menu = $this->db->query($queryMenu)->result_array();
                ?>
                <!-- Looping Menu-->
                <?php foreach ($menu as $m) : ?>
                    <div class="sidebar-heading" style="text-align:center;color:aliceblue; padding:10px;border-bottom: 3px solid #e34c62;">
                        <strong><?php echo $m['menu']; ?></strong>
                    </div>
                    <!-- SUB MENU -->
                    <?php
                    $menuId = $m['id'];
                    $querySubMenu = "SELECT * 
                                        FROM `user_sub_menu` JOIN `user_menu`
                                        ON `user_sub_menu`.`menu_id` = `user_menu`.`id` 
                                        WHERE `user_sub_menu`.`menu_id` = $menuId 
                                        AND `user_sub_menu`.`is_active` = 1";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    ?>
                    <?php foreach ($subMenu as $sm) : ?>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url($sm['url']); ?>" aria-expanded="false">
                                <i class="<?= $sm['icon']; ?>"></i>
                                <span class="hide-menu"><?= $sm['title']; ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <hr class="sidebar-divider mt-3">

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('auth/logout/'); ?>" aria-expanded="false">
                        <i class="mdi mdi-logout"></i>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">

            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($this->uri->segment(2)) ?></li>
                        </ol> -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->