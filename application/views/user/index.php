<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="card mb-3">
        <img class="card-img-top" src="<?php echo base_url('assets/'); ?>images/matem.jpg" alt="Card image cap">
    </div>
    <div class="card mb-3">
        <h1 class="h3 text-gray-800"><?= 'Selamat Datang di Web Absensi Praktikum Online' ?></h1>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
    <?php foreach ($akses as $a) :
        if ($a['npm'] == $user['npm']) {
    ?>
            <div class="card mb-3 col">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <img src="<?= base_url() . $a['img_url'] ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="h4" style="text-align: left"><?= $a['matkul']; ?></h5>
                            <p class="h5" style="text-align: left"><?= $a['title']; ?></p>
                            <?php
                            $npm = $user['npm'];
                            $query = "SELECT `user_absen`.*, `user_kelas_pertemuan`.*
                            FROM `user_absen` JOIN `user_kelas_pertemuan` ON `user_absen`.`pertemuan_id` = `user_kelas_pertemuan`.`id`
                            WHERE 'user_absen'.'npm' = $npm";
                            ?>
                            <h5 class="h4" style="text-align: left"></h5>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    endforeach; ?>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!--  -->

    <!-- Modal -->
    <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="NPM">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active?
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>