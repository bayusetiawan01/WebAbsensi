<div class="wrap-login100">
    <div class="login100-pic js-tilt" data-tilt>
        <img src="<?php echo base_url('assets/'); ?>images/gambar-3.png" alt="IMG">
    </div>

    <form class="login100-form validate-form" method="post" action="<?= base_url('auth/changepassword') ?>">
        <span class="login100-form-title">
            Ganti Passwordmu
            <h5><?= $this->session->userdata('reset_email') ?></h5>
        </span>
        <small>
            <?= $this->session->flashdata('message'); ?>
        </small>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" id="password1" name="password1" placeholder="Enter new password ...">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" id="password2" name="password2" placeholder="Repeat password ...">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
                <i class="fa fa-key" aria-hidden="true"></i>
            </span>
            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn button_hover">
                Ganti Password
            </button>
        </div>

    </form>
</div>