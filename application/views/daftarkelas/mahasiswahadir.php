<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <?php foreach ($mahasiswa as $m) :
        $kelas_id = $m['kelas_id'];
    endforeach;
    ?>
    <br>
    <br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a class="btn btn-primary mb-3 " href="<?php echo base_url('admin/siswahadir_pdf/') . $idper ?>">Eksport PDF</a>
    <a class="btn btn-primary mb-3 " href="<?php echo base_url('admin/siswahadir_excel/') . $idper ?>">Eksport Excel</a>

    <div class="card">
        <div class="row">
            <table class="table table-hover table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Kehadiran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['npm']; ?></td>
                            <?php if ($m['status_per'] == 0) { ?>
                                <td>Tidak Hadir</td>
                            <?php } elseif ($m['status_per'] == 2) { ?>
                                <td>Perlu Izin</td>
                            <?php } elseif ($m['status_per'] == 3) { ?>
                                <td>Izin</td>
                            <?php } else { ?>
                                <td>Hadir</td>
                            <?php } ?>
                            <td>
                                <?php if ($m['status_per'] == 1) { ?>
                                    <a href="<?php echo site_url('admin/lokasi/') . $m['latitude'] . "/" . $m['longitude'] ?>" class="badge badge-success">Lihat Lokasi</a>
                                <?php } elseif ($m['status_per'] == 2) { ?>
                                    <a href="<?php echo site_url('assets/images/surat/' . $m['foto']) ?>" target="_blank" class="badge badge-warning">Lihat Surat</a>
                                    <a href="<?php echo site_url('admin/setujuizin/' . $m['absen_id']) . '/' . $idper ?>" class="badge badge-success">Setujui</a>
                                    <a href="<?php echo site_url('admin/tolakizin/' . $m['absen_id']) . '/' . $idper ?>" class="badge badge-danger">Tolak</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3">Kembali</a>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->
<!-- Modal -->
<div class="modal fade" id="eksport" tabindex="-1" role="dialog" aria-labelledby="eksportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eksport">Eksport Kehadiran Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="matkul_id" id="matkul_id" class="form-control">
                            <option value="">Pilih Eksport</option>
                            <option value="">PDF</option>
                            <option value="">Excel</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Oke</button>
                </div>
            </form>
        </div>
    </div>
</div><br><br>