<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <?php
    $queryMatkul = " SELECT * FROM `user_matkul`";
    $matkul = $this->db->query($queryMatkul)->result_array();
    ?>
    <!-- Looping Menu-->
    <div class="row">
        <?php foreach ($matkul as $m) : ?>
            <div class="column">
                <div class="card" style="height: 200px">
                    <h4 style="height: 70px; padding:5px"><?php echo $m['matkul']; ?></h4>
                    <?php
                    $matkulId = $m['id'];
                    $queryKelas = "SELECT * 
                                        FROM `user_kelas` JOIN `user_matkul`
                                        ON `user_kelas`.`matkul_id` = `user_matkul`.`id` 
                                        WHERE `user_kelas`.`matkul_id` = $matkulId 
                                        AND `user_kelas`.`is_active` = 1";
                    $kelas = $this->db->query($queryKelas)->result_array();
                    ?>
                    <?php foreach ($kelas as $k) : ?>
                        <a href="<?php echo base_url($k['url']); ?>">
                            <span><?= $k['title']; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- SUB MENU -->

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->