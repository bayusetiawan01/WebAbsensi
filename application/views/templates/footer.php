<footer class="footer text-center">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Calon Asisten Laboratorium Matematika Unpad <?= date('Y'); ?></span>
        </div>

    </div>

    All Rights Reserved by Bayu and Shenya
</footer>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!-- Javascript untuk scroolbar -->
<script src="<?php echo base_url('assets/js/sparkline.js'); ?>"></script>
<!--Untuk efek gelombang -->
<script src="<?php echo base_url('assets/js/waves.js'); ?>"></script>
<!--Untuk menu -->
<script src="<?php echo base_url('assets/js/sidebarmenu.js'); ?>"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
<!--Untuk grafik-->
<script src="<?php echo base_url('assets/js/chartist.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/chartist-plugin-tooltip.min.js'); ?>"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeaccess/'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        });
    });
</script>

</body>

</html>