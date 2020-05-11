<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <br><br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newKelasModal">Tambah Kelas Baru</a>
    <a href="<?= base_url(); ?>admin/matakuliah" class="btn btn-primary mb-3">Edit Mata Kuliah</a>

    <a href="<?= base_url(); ?>admin/kelas_pdf" class="btn btn-primary mb-3">Eksport PDF</a>

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
                            <th scope="col">Judul</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Aktif</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kelas as $k) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $k['title']; ?></td>
                                <td><?= $k['matkul']; ?></td>
                                <td><?= $k['is_active']; ?></td>
                                <td>
                                    <a href="<?= base_url(); ?>admin/deletekelas/<?= $k['id']; ?>" class="badge badge-danger">Delete</a>
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
                <h5 class="modal-title" id="newKelasLabel">Tambah Kelas Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/classmanagement'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Class title">
                    </div>

                    <div class="form-group">
                        <select name="matkul_id" id="matkul_id" class="form-control">
                            <option value="">Pilih Mata Kuliah</option>
                            <?php foreach ($matkul as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['matkul']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Aktif
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
</div><br><br>