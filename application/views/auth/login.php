<div class="wrap-login100">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo base_url('assets/'); ?>images/gambar-1.png" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="post" action="<?= base_url('auth') ?>">
        <span class="login100-form-title">
            Login Page
        </span>
        <small>
            <?= $this->session->flashdata('message'); ?>
        </small>

        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" name="email" placeholder="Email">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="pass" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <?= form_error('pass', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn button_hover">
                Login
            </button>
        </div>

        <div class="text-center">
            <a class="txt2" href="<?= base_url('registration'); ?>">
                Create your Account
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
</div>