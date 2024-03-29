<div class="wrap-login100" style="padding-top: 0px">
    <div class="login100-pic js-tilt regis" data-tilt>
        <img src="<?php echo base_url('assets/'); ?>images/gambar-2.png" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="post" action="<?= base_url('auth/registration'); ?>"> <span class="login100-form-title">
            <br><br>
            Halaman Registrasi
        </span>
        <div class="text-center">
            <?= form_error('npm', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('pass1', '<div class="alert alert-danger">', '</div>'); ?>
            <?= form_error('email', '<div class="alert alert-danger">', '</div>'); ?>

        </div>
        <div class="wrap-input100 validate-input" data-validate="Nama harus diisi!">
            <input class="input100" type="text" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="NPM harus diisi!">
            <input class="input100" type="text" id="npm" name="npm" placeholder="NPM" value="<?= set_value('npm'); ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-id-card-o" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Email valid: ex@abc.xyz">
            <input class="input100" type="text" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password harus diisi!">
            <input class="input100" type="password" name="pass1" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Password harus diisi!">
            <input class="input100" type="password" name="pass2" placeholder="Repeat Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn button_hover">
                Register Akun
            </button>
        </div>
        <hr>
        <div class="text-center">

            <a class="txt2" href="<?= base_url(''); ?>">
                Sudah punya akun? Login!
                <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
</div>