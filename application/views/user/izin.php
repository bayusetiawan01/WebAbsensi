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
        <div class="card mb-3 col-lg">
            <div>
                <?php echo form_open_multipart('user/setizin/' . $pointer); ?>
                <div class="col-lg">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Pilih file</label>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            <br>
            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->