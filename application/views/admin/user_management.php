<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <br><br>
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    

  <a href="<?= base_url('admin/user_pdf'); ?>" class="btn btn-primary mb-3">Eksport PDF</a>
  <a href="<?= base_url('admin/user_excel'); ?>" class="btn btn-primary mb-3">Eksport Excel</a>

  <div class="card">
    <div class="row">
      <div class="col-lg">
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
          </div>
        <?php endif; ?>

        <?= $this->session->flashdata('message'); ?>

        <table class="table table-hover table-responsive-lg">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">NPM</th>
              <th scope="col">Email</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Aksi</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($member as $m) : ?>
              <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $m['name']; ?></td>
                <td><?= $m['npm']; ?></td>
                <td><?= $m['email']; ?></td>
                <td><?= date('d F Y', $m['date_created']); ?></td>
                <td>
                  <?php if ($m['is_active'] == 0) { ?>
                    <a href="<?php echo site_url('admin/aktivasi/') . $m['npm'] ?>" class="badge badge-success">Aktifkan</a>
                    <a href="<?php echo site_url('admin/delete/') . $m['npm'] ?>" class="badge badge-danger">Delete</a>
                  <?php } else { ?>
                    <a href="<?php echo site_url('admin/deaktivasi/') . $m['npm'] ?>" class="badge badge-warning">Nonaktif</a>
                  <?php } ?>
                </td>
                <td>
                  <?php if ($m['role_id'] == 1) { ?>
                    <a href="<?php echo site_url('admin/setUser/') . $m['npm'] ?>" class="badge badge-danger">Set User</a>
                  <?php } else { ?>
                    <a href="<?php echo site_url('admin/setAdmin/') . $m['npm'] ?>" class="badge badge-success">Set Admin</a>
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
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->

<!-- Modal -->
<div class="modal fade" id="newKelasModal" tabindex="-1" role="dialog" aria-labelledby="newKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKelasLabel">Export</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pdf') ?>" method="post">
                <div class="modal-body">
                
                    <div class="form-group">
                        <select name="matkul_id" id="matkul_id" class="form-control">
                            <option value="">Pilih Export</option>
                            <option value="" href="">PDF</option>
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