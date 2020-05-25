 <!-- ============================================================== -->
 <!-- Topbar header - style you can find in pages.scss -->
 <!-- ============================================================== -->
 <header class="topbar" data-navbarbg="skin6">
     <nav class="navbar top-navbar navbar-expand-md navbar-light">
         <div class="navbar-header" data-logobg="skin5">
             <!-- This is for the sidebar toggle which is visible on mobile only -->
             <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                 <i class="ti-menu ti-close"></i>
             </a>
             <!-- ============================================================== -->
             <!-- Logo -->
             <!-- ============================================================== -->
             <div class="navbar-brand">
                 <a href="<?php echo base_url('user/'); ?>" class="logo">
                     <!-- Logo icon -->
                     <b class="logo-icon">
                         <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                         <!-- Dark Logo icon -->
                         <img src="<?php echo base_url('assets/images/logo.png'); ?>" width=40 alt="homepage" class="dark-logo" />
                         <!-- Light Logo icon -->
                         <img src="<?php echo base_url('assets/images/logo.png'); ?>" width=40 alt="homepage" class="light-logo" />
                     </b>
                     <!--End Logo icon -->
                     <!-- Logo text -->
                     <span class="logo-text">
                         <!-- dark Logo text -->
                         <img src="<?php echo base_url('assets/images/text-hitam.png'); ?>" width=110 alt="homepage" class="dark-logo" />
                         <!-- Light Logo text -->
                         <img src="<?php echo base_url('assets/images/text-putih.png'); ?>" width=110 class="light-logo" alt="homepage" />
                     </span>
                 </a>
             </div>
             <!-- ============================================================== -->
             <!-- End Logo -->
             <!-- ============================================================== -->
             <!-- ============================================================== -->
             <!-- Toggle which is visible on mobile only -->
             <!-- ============================================================== -->
             <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                 <i class="ti-more"></i>
             </a>
         </div>
         <!-- ============================================================== -->
         <!-- End Logo -->
         <!-- ============================================================== -->
         <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
             <!-- ============================================================== -->
             <!-- toggle and nav items -->
             <!-- ============================================================== -->
             <ul class="navbar-nav float-left mr-auto">
                 <!-- ============================================================== -->
                 <!-- Search -->
                 <!-- ============================================================== -->
                 <!-- <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <span id="time" class="mr-2 d-lg-inline text-gray-600 medium"></span>
                 <span class="d-lg-inline text-gray-600 medium">,</span>
                 <span class="mr-2 d-lg-inline text-gray-600 medium"><?php echo date('d-m-Y') ?></span> -->
                 <!-- <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form> -->
                 </li>
             </ul>
             <!-- ============================================================== -->
             <!-- Right side toggle and nav items -->
             <!-- ============================================================== -->
             <ul class="navbar-nav float-right">
                 <!-- ============================================================== -->
                 <!-- User profile and search -->
                 <!-- ============================================================== -->
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="<?= base_url('user/profile'); ?>" aria-haspopup="true" aria-expanded="false">

                         <span class="mr-2 d-lg-inline text-gray-600 medium"><?= $user['name']; ?></span>
                         <img src="<?= base_url('assets/images/profile/') . $user['image'] ?>" alt="user" class="rounded-circle" width="31"></a>
                 </li>
                 <!-- ============================================================== -->
                 <!-- User profile and search -->
                 <!-- ============================================================== -->
             </ul>
         </div>
     </nav>
 </header>
 <!-- ============================================================== -->
 <!-- End Topbar header -->
 <!-- ============================================================== -->

 <!-- tambahaan -->
 <script>
     // Function ini dijalankan ketika Halaman ini dibuka pada browser
     $(function() {
         setInterval(time, 1000); //fungsi yang dijalan setiap detik, 1000 = 1 detik
     });

     //Fungi ajax untuk Menampilkan Jam dengan mengakses File ajax_timestamp.php
     function time() {
         $.ajax({
             url: '<?= base_url('user/time/') ?>',
             success: function(data) {
                 $('#time').html(data);
             },
         });
     }
 </script>