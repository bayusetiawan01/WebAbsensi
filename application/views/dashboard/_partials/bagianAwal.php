<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view("dashboard/_partials/head.php") ?>
</head>

<body>
    <?php $this->load->view("dashboard/_partials/preloader.php") ?>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <?php $this->load->view("dashboard/_partials/navbar.php") ?>
        <?php $this->load->view("dashboard/_partials/sidebar.php") ?>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <?php $this->load->view("dashboard/_partials/breadcrumb.php") ?>