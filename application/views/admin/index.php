<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <br><br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row" style="text-align:center">
        <div class="col-md-5 card" style="margin: auto; margin-bottom:50px; margin-left:10px; background:#e34c62; height:150px; text-align:center; border-radius:25px; float:right">
            <p id="time" style="margin:auto; font-size: 6vw; color:white"></p>
        </div>
        <div class="col-md-3 card" style="margin: auto; margin-bottom:50px; margin-left:10px; background:#e34c62; height:150px; text-align:center; border-radius:25px; float:right">
        </div>
        <div class="col-md-3 card" style="margin: auto; margin-bottom:50px; margin-left:10px; background:#e34c62; height:150px; text-align:center; border-radius:25px; float:right">
        </div>
    </div>


    <?php
    $queryMatkul = " SELECT * FROM `user_matkul`";
    $matkul = $this->db->query($queryMatkul)->result_array();
    ?>
    <!-- Looping Menu-->
    <div class="row">
        <?php foreach ($matkul as $m) : ?>
            <div class="column">
                <div class="card" style="height: 500px;">
                    <table>
                        <tr><img src="<?= base_url() . $m['img_url'] ?>" style="margin: auto; margin-top: 10px; margin-bottom: 10px" class="card-img" alt="lesson logo"></tr>
                        <tr>
                            <h4 style="height: 70px; padding:5px;"><?php echo $m['matkul']; ?></h4>
                        </tr>
                        <?php
                        $matkulId = $m['id'];
                        $queryKelas = "SELECT * 
                                        FROM `user_matkul` JOIN `user_kelas`
                                        ON `user_kelas`.`matkul_id` = `user_matkul`.`id` 
                                        WHERE `user_kelas`.`matkul_id` = $matkulId 
                                        AND `user_kelas`.`is_active` = 1";
                        $kelas = $this->db->query($queryKelas)->result_array();
                        ?>
                        <br>
                        <?php foreach ($kelas as $k) : ?>
                            <a class="btn btn-primary" style="margin: 2px" href="<?php echo base_url('admin/kelas/' . $k['id']); ?>">
                                <span><?= $k['title']; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <script>
        // Function ini dijalankan ketika Halaman ini dibuka pada browser
        $(function() {
            setInterval(time, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
        });

        //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
        function time() {
            $.ajax({
                url: '<?= base_url('admin/time/') ?>',
                success: function(data) {
                    $('#time').html(data);
                },
            });
        }
    </script>
    <!-- SUB MENU -->

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->