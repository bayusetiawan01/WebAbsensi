<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <br><br>
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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
                    <a href="<?php echo site_url('admin/aktivasi/') . $m['npm'] ?>" class="badge badge-success">Active</a>
                    <a href="<?php echo site_url('admin/delete/') . $m['npm'] ?>" class="badge badge-danger">Delete</a>
                  <?php } else { ?>
                    <a href="<?php echo site_url('admin/deaktivasi/') . $m['npm'] ?>" class="badge badge-warning">Nonactive</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" id="title" name="title" placeholder="Nama">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="url" name="url" placeholder="NPM">
          </div>

          <div class="form-group">
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
              <label class="form-check-label" for="is_active">
                Actif?
              </label>
            </div>
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
<br><br><br><br><br><br><br><br><br><br><br><br>