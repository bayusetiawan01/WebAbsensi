<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    
    <?php 
        $query = "SELECT D.matkul, B.keterangan, A.status_per FROM user_absen AS A JOIN user_kelas_pertemuan AS B ON A.pertemuan_id = B.id JOIN user_kelas AS C ON B.kelas_id = C.id JOIN user_matkul AS D ON D.id = C.matkul_id WHERE A.npm = $npm";
        $kehadiran = $this->db->query($query)->result_array();
    ?>

    <br>
    <br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <h2 class="h3 mb-4 text-gray-800"><?= $npm ?></h2>
    
    <!-- <a class="btn btn-primary mb-3 ml-5" href="<?php echo base_url('admin/siswahadir_pdf/') . $idper ?>">Eksport PDF</a> -->

    <div class="card">
        <div class="row">
            <table class="table table-hover table-responsive-lg">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">Pertemuan</th>
                        <th scope="col">Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kehadiran as $q) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $q['matkul']; ?></td>
                            <td><?= $q['keterangan']; ?></td>
                            <?php if ($q['status_per'] == 0) { ?>
                                <td>Tidak Hadir</td>
                            <?php } else { ?>
                                <td>Hadir</td>
                            <?php } ?>
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
