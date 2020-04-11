<div class="wrap-login100" style="padding-top: 0px">
    <div class="login100-pic js-tilt regis" data-tilt>
        <img src="<?php echo base_url('assets/'); ?>images/gambar-2.png" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="post" action="<?= base_url('auth/registration'); ?>"> <span class="login100-form-title">
            <br><br>
            Registration Page
        </span>
        <div class="text-center">
            <?= form_error('npm', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('pass', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Name is Required!">
            <input class="input100" type="text" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="NPM is Required!">
            <input class="input100" type="text" id="npm" name="npm" placeholder="NPM" value="<?= set_value('npm'); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-id-card-o" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
            <input class="input100" type="text" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="pass" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn button_hover">
                Register Account
            </button>
        </div>

        <div class="text-center">

            <a class="txt2" href="<?= base_url(''); ?>">
                Already have an account? Login!
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
</div>