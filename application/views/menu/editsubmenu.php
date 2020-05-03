<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <br><br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php echo form_open('menu/proses_edit') ?>

    	<?php $i = 1; ?>
         	<?php foreach ($subMenu as $sm) : ?>
    			<div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $sm['title']; ?>">
                        <?= form_error('title', '<small class"text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

    	<?php $i++; ?>
          <?php endforeach; ?>
    	</div>
    <?php echo form_close(); ?>
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->