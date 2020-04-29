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
                <div class="card" style="height: 400px">
                    <table>
                        <tr><img src="<?= base_url() . $m['img_url'] ?>" class="card-img" height="200" alt="..."></tr>
                        <tr>
                            <h4 style="height: 70px; padding:5px"><?php echo $m['matkul']; ?></h4>
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
                        <?php foreach ($kelas as $k) : ?>
                            <a href="<?php echo base_url('admin/kelas/' . $k['id']); ?>">
                                <span><?= $k['title']; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </table>
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