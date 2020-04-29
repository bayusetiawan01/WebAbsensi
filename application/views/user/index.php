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
                    <div class="col-md-5">
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
                            <!-- Cari Pertemuan Terakhir-->
                            <?php $vara = "Belum ada kelas.";
                            $varb = 0;
                            $varc = 0;
                            foreach ($kehadiran as $k) :
                                if ($k['kelas_id'] == $a['id']) {
                                    $vara = $k['keterangan'];
                                    $varb = $k['tanggal'];
                                    $varc = $k['time_per'];
                                    $vard = $k['status_per'];
                                }
                            endforeach; ?>
                            <br>
                            <h4 style="text-align:left"><?= $vara ?></h4>
                            <h5 style="text-align:left">Tanggal : <?= $varb ?></h5>
                            <br>
                            <?php if ($vard == 1) { ?>
                                <button type="button" class="btn btn-success">Anda Sudah Menghadiri Kelas</button>
                            <?php } else if (time() - $varc <= 300) { ?>
                                <button type="button" class="btn btn-success">Hadiri Kelas</button>
                            <?php } else if ($varc == 0) { ?>
                                <button type="button" class="btn btn-dark">Kelas Belum Tersedia</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-secondary">Terlambat Menghadiri Kelas</button>
                            <?php } ?>
                            <button type="button" class="btn btn-info">Detail Absensi</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kehadiran as $k) :
                                    if ($k['kelas_id'] == $a['id']) { ?>
                                        <td><?= $k['tanggal']; ?></td>
                                        <?php if ($k['status_per'] == 0) { ?>
                                            <td>Tidak Hadir</td>
                                        <?php } else { ?>
                                            <td>Hadir</td>
                                        <?php } ?>
                                <?php }
                                endforeach; ?>
                            </tbody>
                        </table>
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