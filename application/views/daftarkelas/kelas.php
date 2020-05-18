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
        $queryk = "SELECT * FROM user_kelas_pertemuan AS U 
        LEFT JOIN (SELECT A.keterangan AS ket, IFNULL(COUNT(A.keterangan), 0) 
        AS jumlah FROM user_kelas_pertemuan AS A 
        JOIN user_absen AS B ON B.pertemuan_id = A.id WHERE B.status_per = 1 
        GROUP BY A.keterangan) AS C ON C.ket = U.keterangan WHERE U.kelas_id = $kelasid ";
        $vark = $this->db->query($queryk)->result_array();
        ?>
        <?php
        $random = 0;
        $tanggal = 0;
        $keterangan = "Belum ada Pertemuan";
        $id = 0;
        foreach ($pertemuan as $pt) :
            $tanggal = $pt['tanggal'];
            $keterangan = $pt['keterangan'];
            $id = $pt['id'];
            $random = $pt['time_per'];
        endforeach;
        $query = "SELECT `status_per` FROM `user_absen` WHERE `pertemuan_id` = $id";
        $var = $this->db->query($query)->result_array();
        $hadir = 0;
        $seharusnya = 0;
        $total = 0;
        foreach ($var as $v) :
            if ($v['status_per'] == 1) $hadir++;
            $seharusnya++;
        endforeach;
        foreach ($mahasiswa as $m) :
            $total++;
        endforeach;
        ?>
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3 ml-5">Kembali</a>
        <a href="" class="btn btn-primary mb-3 ml-5" data-toggle="modal" data-target="#newPertemuanModal">Tambah Pertemuan</a>
        <div class="card mb-3 col">
            <div class="row no-gutters">
                <div class="col-md-3">
                    <img id='barcode' src=<?php echo "https://api.qrserver.com/v1/create-qr-code/?data=" . $random ?> alt="" title="QR Code" width="200" height="200" />
                    <br>
                </div>
                <div class="col-md-5" style="margin-left:10px; margin-top:20px; margin-bottom:20px">
                    <h5 class="h3" style="text-align: left"><?= $keterangan; ?></h5>
                    <p class="h5" style="text-align: left">Tanggal : <?= $tanggal; ?></p>
                    <p class="h5" style="text-align: left">Mahasiswa Terdaftar Absen : <?= $seharusnya ?></p>
                    <p class="h5" style="text-align: left">Mahasiswa Total Sekarang : <?= $total ?></p>
                </div>
                <div class="col-md-3 card" style="margin: auto; margin-left:10px; background:#e34c62; height:200px; text-align:center; border-radius:25px; float:right">
                    <p style="margin: 0; color:white; font-size:18px">Total Mahasiswa Hadir</p>
                    <p id="hadir" style="margin:auto; font-size: 90px; color:white"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Grafik Kehadiran</h4>
                        <div class="kehadiran ct-charts mt-3" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <?php foreach ($mahasiswa as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['name']; ?></td>
                            <td><?= $m['npm']; ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/detailmhs/') . $m['npm'] ?>" class="badge badge-success">Detail</a>
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
    <script>
        // Function ini dijalankan ketika Halaman ini dibuka pada browser
        $(function() {
            setInterval(hadir, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
        });

        //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
        function hadir() {
            $.ajax({
                url: '<?= base_url('admin/hadir/') . $id ?>',
                success: function(data) {
                    $('#hadir').html(data);
                },
            });
        }
    </script>
    <script>
        $(function() {
            "use strict";

            // ============================================================== 
            // Grafik Kehadiran
            // ============================================================== 
            var chart = new Chartist.Line('.kehadiran', {
                labels: [<?php foreach ($vark as $v) :
                                echo '"' . $v['tanggal'] . '"' . ',';
                            endforeach; ?>],
                series: [
                    [<?php foreach ($vark as $v) :
                            if ($v['jumlah'] == NULL) echo '0,';
                            else echo $v['jumlah'] . ',';
                        endforeach; ?>],
                ]
            }, {
                low: 0,
                high: 30,
                showArea: true,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                axisY: {
                    onlyInteger: true,
                    scaleMinSpace: 40,
                    offset: 20,
                    labelInterpolationFnc: function(value) {
                        return (value);
                    }
                },

            });

            var chart = [chart];
        });
    </script>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!--  -->

    <!-- Modal -->
    <div class="modal fade" id="newPertemuanModal" tabindex="-1" role="dialog" aria-labelledby="newPertemuanLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPertemuanLabel">Tambah Pertemuan</h5>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newMahasiswaModal" tabindex="-1" role="dialog" aria-labelledby="newMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPertemuanLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="active-pink-3 active-pink-4 m-4">
                    <input type="text" id="myInput" onkeyup="myFunction()" class="boxSearch form-control" placeholder="Cari nama" />
                </div>
                <form action="<?= base_url('admin/addmhs/') . $kelasid ?>" method="post">
                    <button type="submit" class="btn btn-primary mb-3 ml-3">Tambah</button>
                    <div class="card col-lg" style="height: 400px; overflow:auto">
                        <table class=" table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NPM</th>
                                    <th scope="col">
                                        <input type="checkbox" id="pilihsemua" />
                                    </th>
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
                                                if ($m['npm'] == $a['npm'] && $a['kelas_id'] == $kelasid) {
                                                    $count = 1;
                                                }
                                            endforeach; ?>
                                            <?php if ($count == 0) { ?>
                                                <input class="form-check-input pilih" type="checkbox" value="1" name="<?= $m['npm'] ?>" id="<?= $m['npm'] ?>">

                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {

            // Fungsi Checkbox Pilih Semua
            $("#pilihsemua").click(function() { // Jika Checkbox Pilih Semua di ceklis maka semua sub checkbox akan diceklis juga
                $('.pilih').attr('checked', this.checked);
            });

            // Jika semua sub checkbox diceklis maka Checkbox Pilih Semua akan diceklis juga
            $(".pilih").click(function() {

                if ($(".pilih").length == $(".pilih:checked").length) {
                    $("#pilihsemua").attr("checked", "checked");
                } else {
                    $("#pilihsemua").removeAttr("checked");
                }

            });
        });
    </script>
    <script>
        function myFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>