<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ERROR 404</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/chartist.min.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <?php $this->load->view("dashboard/_partials/preloader.php") ?>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="error-title text-danger">404</h1>
                <h3 class="text-uppercase error-subtitle">HALAMAN TIDAK DITEMUKAN !</h3>
                <p class="text-muted m-t-30 m-b-30">TAMPAKNYA ANDA TERSESAT</p>
                <a href="<?php echo base_url('user'); ?>" style="background-color:#e34c62 !important" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Kembali ke home</a>
            </div>
        </div>
    </div>
    <?php $this->load->view("dashboard/_partials/js.php") ?>
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
    </script>
</body>

</html>