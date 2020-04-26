<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="card mb-3">
        <img class="card-img-top" src="<?php echo base_url('assets/'); ?>images/matem.jpg" alt="Card image cap">
        <br>
        <h1 class="h3 text-gray-800"><?= 'Selamat Datang di Web Absensi Praktikum Online' ?></h1>

        <br>
        <div class="card">
            <div class="row">
                <div class="col-lg">
                    <?= $this->session->flashdata('message'); ?>
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Pertemuan</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Jam Masuk</th>
                                <th scope="col">Jam Selesai</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($absen as $a) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $a['matkul_id']; ?></td>
                                    <td></td>
                                    <td><?= $a['tanggal']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="<?php echo site_url('user/absen/masuk/') . $a['id'] ?>" class="badge badge-success">Edit</a>
                                        <a href="<?php echo site_url('user/absen/masuk/') . $a['id'] ?>" class="badge badge-danger">Delete</a>
                                        <!--  -->
                                    </td>
                                </tr>

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
                    <h5 class="modal-title" id="newMenuModalLabel">Add User</h5>
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
                                    Active?
                                </label>
                            </div>
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