<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?php echo $this->session->flashdata('message'); ?>

            <form action="<?= base_url('menu/edit'); ?>" method="post">

                <div class="form_group">
                    <label for="edit_name">Edit Name</label>
                    <input type="text" class="form-control" id="name_menu" name="Name Menu">
                    <?= form_error('name_menu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Edit</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->