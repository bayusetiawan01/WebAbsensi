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
            <?= form_error('matakuliah', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <table class="table table-hover">

                <a href="<?= base_url(); ?>admin/kelas" class="btn btn-primary mb-3 mr-3">Class Management</a>
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMatkulModal">Tambah Mata Kuliah</a>

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($matkul as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['matkul']; ?></td>
                            <td>
                                <a href="<?= base_url(); ?>kelas/edit/<?= $m['matkul']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url(); ?>kelas/hapusmenu/<?= $m['matkul']; ?>" class="badge badge-danger" onclick="return confirm('sure?');">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>



        </div>
    </div>

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->

<!-- Modal -->
<div class="modal fade" id="newMatkulModal" tabindex="-1" role="dialog" aria-labelledby="newMatkulModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/matakuliah'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="matkul" name="matkul" placeholder="Nama Mata Kuliah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>

                </div>
            </form>
        </div>
    </div>
</div>