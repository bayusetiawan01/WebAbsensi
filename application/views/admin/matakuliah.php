<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <br><br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
            <?= form_error('matakuliah', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url(); ?>admin/classmanagement" class="btn btn-primary mb-3 mr-3">Class Management</a>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMatkulModal">Tambah Mata Kuliah</a>
            <div class="card">
                <table class="table table-hover">
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
                                    <a href="<?= base_url(); ?>admin/deletematkul/<?= $m['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newMatkulModal" tabindex="-1" role="dialog" aria-labelledby="newMatkulModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('admin/matakuliah'); ?>
                <div class="form-group row">
                    <input type="text" class="form-control" id="matkul" name="matkul" placeholder="Nama Mata Kuliah">
                    <?= form_error('name', '<small class"text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
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
</div>
<!-- Modal -->