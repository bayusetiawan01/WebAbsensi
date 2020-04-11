<!DOCTYPE html>
<html dir="ltr">

<head>
    <?php $this->load->view("dashboard/_partials/head.php") ?>
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
                <h3 class="text-uppercase error-subtitle">PAGE NOT FOUND !</h3>
                <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
                <a href="<?php echo base_url(''); ?>" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Back to home</a>
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