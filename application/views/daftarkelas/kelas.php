    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <br>
        <br>
        <?php
        $tanggal = 0;
        $keterangan = "Belum ada Pertemuan";
        $id = 0;
        foreach ($pertemuan as $pt) :
            $tanggal = $pt['tanggal'];
            $keterangan = $pt['keterangan'];
            $id = $pt['id'];
        endforeach;
        $query = "SELECT `status_per` FROM `user_absen` WHERE `pertemuan_id` = $id";
        $var = $this->db->query($query)->result_array();
        $hadir = 0;
        $total = 0;
        foreach ($var as $v) :
            if ($v['status_per'] == 1) $hadir++;
            $total++;
        endforeach;
        ?>
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <div class="card mb-3 col">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <img id='barcode' src=<?php echo "https://api.qrserver.com/v1/create-qr-code/?data=" . $keterangan ?> alt="" title="QR Code" width="200" height="200" />
                    <br>
                </div>
                <div class="col-md-4" style="margin: auto">
                    <h5 class="h4" style="text-align: left"><?= $keterangan; ?></h5>
                    <p class="h5" style="text-align: left">Tanggal : <?= $tanggal; ?></p>
                    <p class="h5" style="text-align: left">Mahasiswa Hadir / Total : <?= $hadir . "/" . $total ?></p>
                </div>
            </div>
        </div>
        <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3 ml-5">Kembali</a>
        <a href="" class="btn btn-primary mb-3 ml-5" data-toggle="modal" data-target="#newPertemuanModal">Tambah Pertemuan</a>
        <div class="card">
            <h2 class="h4 mb-4 text-gray-800">Daftar Pertemuan</h2>
            <div class="row">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Siswa Hadir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pertemuan as $p) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $p['tanggal']; ?></td>
                                <td><?= $p['keterangan']; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/siswahadir/') . $p['id'] ?>" class="badge badge-success">Detail</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <a href="" class="btn btn-primary mb-3 ml-5" data-toggle="modal" data-target="#newMahasiswaModal">Tambah Praktikan</a>
        <div class="card">
            <h2 class="h4 mb-4 text-gray-800">Daftar Praktikan</h2>
            <div class="row">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NPM</th>
                            <th scope="col">Kehadiran</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['npm']; ?></td>
                            <td>
                                <a href="" class="badge badge-success">Detail</a>
                            </td>
                            <td>
                                <a href="<?php echo site_url('admin/deletemhs/') . $m['id'] . '/' . $kelasid ?>" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div><br><br><br><br><br><br><br>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!--  -->

    <!-- Modal -->
    <div class="modal fade" id="newPertemuanModal" tabindex="-1" role="dialog" aria-labelledby="newPertemuanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPertemuanLabel">Add Pertemuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/addpertemuan') ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kelas_id" name="kelas_id" value="<?php echo $kelasid; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan Pertemuan">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
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

    <div class="modal fade" id="newMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="newMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPertemuanLabel">Add Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">NPM</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($member as $m) : ?>
                            <tr>
                                <td><?= $m['name']; ?></td>
                                <td><?= $m['npm']; ?></td>
                                <td>
                                    <?php $count = 0;
                                    foreach ($akses as $a) :
                                        if ($m['npm'] == $a['npm'] && $a['kelas_id'] == $kelas['id']) {
                                            $count = 1;
                                        }
                                    endforeach; ?>
                                    <?php if ($count == 0) { ?>
                                        <a href="<?php echo site_url('admin/addmhs/') . $m['npm'] . '/' . $kelas['id'] ?>" class="badge badge-success">Tambah</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>