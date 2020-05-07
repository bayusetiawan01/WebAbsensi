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
    <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3 ml-5">Kembali</a>
    <div class="card">
        <div class="row">
            <table class="table table-hover table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NPM</th>
                        <th scope="col">Kehadiran</th>
                        <th scope="col">View Location</th>
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
                            <?php } else { ?>
                                <td>Hadir</td>
                            <?php } ?>
                            <td>
                                <a href="<?php echo site_url('admin/lokasi/') . $m['latitude'] . "/" . $m['longitude'] ?>" class="badge badge-success">Lihat Lokasi</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->