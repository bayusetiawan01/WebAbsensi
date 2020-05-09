<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/logo.png'); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('assets/css/chartist.min.css'); ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Load Leaflet: http://leafletjs.com/ -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js" integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log==" crossorigin=""></script>

    <!-- Esri Leaflet Plugin: https://esri.github.io/esri-leaflet/ -->
    <script src="https://unpkg.com/esri-leaflet@2.1.3/dist/esri-leaflet.js" integrity="sha512-pijLQd2FbV/7+Jwa86Mk3ACxnasfIMzJRrIlVQsuPKPCfUBCDMDUoLiBQRg7dAQY6D1rkmCcR8286hVTn/wlIg==" crossorigin=""></script>

    <!-- ESRI Renderer Plugin: https://github.com/Esri/esri-leaflet-renderers -->
    <!-- Renders feature layer using default symbology as defined by ArcGIS REST service -->
    <!-- Currently doesn't work with ESRI cluster plugin -->
    <script src="https://unpkg.com/esri-leaflet-renderers@2.0.6/dist/esri-leaflet-renderers.js" integrity="sha512-mhpdD3igvv7A/84hueuHzV0NIKFHmp2IvWnY5tIdtAHkHF36yySdstEVI11JZCmSY4TCvOkgEoW+zcV/rUfo0A==" crossorigin=""></script>

    <!-- Load Leaflet Basemap Providers: https://github.com/leaflet-extras/leaflet-providers -->
    <!-- Modified to include USGS TNM web services -->
    <script src="<?= base_url('assets/vendor/leaflet/') ?>JS/leaflet-providers.js"></script>

    <!-- 2.5D OSM Buildings Classic: https://github.com/kekscom/osmbuildings -->
    <script src="https://cdn.osmbuildings.org/OSMBuildings-Leaflet.js"></script>

    <!-- Load Font Awesome icons -->
    <script src="https://use.fontawesome.com/a64989e3a8.js"></script>

    <!-- Grouped Layer Plugin: https://github.com/ismyrnow/leaflet-groupedlayercontrol  -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/') ?>CSS/leaflet.groupedlayercontrol.min.css">
    <script src="<?= base_url('assets/vendor/leaflet/') ?>JS/leaflet.groupedlayercontrol.min.js" type="text/javascript"></script>

    <!-- Overview mini map Plugin: https://github.com/Norkart/Leaflet-MiniMap -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/') ?>CSS/Control.MiniMap.css">
    <script src="<?= base_url('assets/vendor/leaflet/') ?>JS/Control.MiniMap.min.js" type="text/javascript"></script>

    <!-- Leaflet Drawing Plugin: https://github.com/codeofsumit/leaflet.pm -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.css">
    <script src="https://unpkg.com/leaflet.pm@latest/dist/leaflet.pm.min.js"></script>

    <!-- Leaflet WMS Plugin: https://github.com/heigeo/leaflet.wms -->
    <script src="<?= base_url('assets/vendor/leaflet/') ?>JS/leaflet.wms.js"></script>

    <!-- Logo Credit Plugin: https://github.com/gregallensworth/L.Control.Credits -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/') ?>CSS/leaflet-control-credits.css" />
    <script type="text/javascript" src="<?= base_url('assets/vendor/leaflet/') ?>JS/leaflet-control-credits.js"></script>

    <style>
        #map {
            height: 100%;
            position: sticky !important;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
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
                        <a href="<?php echo base_url('admin/overview/'); ?>" class="logo">
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
                            </form>
                        </li> -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline text-gray-600 medium"><?= $user['name']; ?></span>
                                <img src="<?= base_url('assets/images/profile/') . $user['image'] ?>" alt="usir" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i> My Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><i class="ti-shift-right m-r-5 m-l-5"></i> Logout</a>
                            </div>
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
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">

                        <hr class="sidebar-divider">
                        <!-- Query Menu -->
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = " SELECT `user_menu`.`id`, `menu` 
                                    FROM `user_menu` JOIN `user_access_menu`
                                    ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                                    WHERE `user_access_menu`.`role_id` = $role_id
                                    ORDER BY `user_access_menu`.`menu_id` ASC ";
                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>
                        <!-- Looping Menu-->
                        <?php foreach ($menu as $m) : ?>
                            <div class="sidebar-heading" style="text-align:center;color:aliceblue; padding:10px;border-bottom: 3px solid #e34c62;">
                                <strong><?php echo $m['menu']; ?></strong>
                            </div>
                            <!-- SUB MENU -->
                            <?php
                            $menuId = $m['id'];
                            $querySubMenu = "SELECT * 
                                        FROM `user_sub_menu` JOIN `user_menu`
                                        ON `user_sub_menu`.`menu_id` = `user_menu`.`id` 
                                        WHERE `user_sub_menu`.`menu_id` = $menuId 
                                        AND `user_sub_menu`.`is_active` = 1";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>
                            <?php foreach ($subMenu as $sm) : ?>

                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url($sm['url']); ?>" aria-expanded="false">
                                        <i class="<?= $sm['icon']; ?>"></i>
                                        <span class="hide-menu"><?= $sm['title']; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                        <hr class="sidebar-divider mt-3">

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('auth/logout/'); ?>" aria-expanded="false">
                                <i class="mdi mdi-logout"></i>
                                <span class="hide-menu">Logout</span>
                            </a>
                        </li>

                        <hr class="sidebar-divider">

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">

                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo ucfirst($this->uri->segment(2)) ?></li>
                        </ol> -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <br><br>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3 ml-5">Kembali</a>
                <div class="card" style="height: 600px">
                    <div id="map"></div>

                    <script>
                        setTimeout(function() {
                            map.invalidateSize()
                        }, 400);
                        var map = L.map('map', {
                            center: [<?= $longitude ?>, <?= $latitude ?>],
                            zoom: 18
                        });
                        var marker = L.marker([<?= $longitude ?>, <?= $latitude ?>], {
                            title: "My marker"
                        }).addTo(map);

                        var defaultBase = L.tileLayer.provider('OpenTopoMap').addTo(map);

                        var baseLayers = {
                            'OSM Topo': defaultBase,
                            'Stamen Toner': L.tileLayer.provider('Stamen.TonerLite'),
                            'USGS TNM': L.tileLayer.provider('USGSTNM'),
                            'ESRI Imagery': L.tileLayer.provider('Esri.WorldImagery'),
                            'ESRI Ocean Basemap': L.tileLayer.provider('Esri.OceanBasemap'),
                        };

                        //ESRI ArcGIS layers from Hawaii GIS Program; dynamic layer example
                        //Using a relative url to call layer instead of http
                        var WaterQualSites = L.esri.dynamicMapLayer({
                            url: '//geodata.hawaii.gov/arcgis/rest/services/HumanHealthSafety/MapServer',
                            layers: [2],
                            useCors: false
                        });

                        //add popup to Water quality sites dynamic map layer
                        WaterQualSites.bindPopup(function(error, featureCollection) {
                            if (error || featureCollection.features.length === 0) {
                                return false;
                            } else {
                                return 'Name: ' + featureCollection.features[0].properties.name + '<br>' + 'ID: ' + featureCollection.features[0].properties.identifier;
                            }
                        });

                        //ESRI ArcGIS layers from Hawaii GIS Program; polygon feature layer example
                        //Using a relative url to call layer instead of http
                        var AgBaseline = L.esri.featureLayer({
                            url: '//geodata.hawaii.gov/arcgis/rest/services/LandUseLandCover/MapServer/4',
                            style: function(feature) {
                                return {
                                    fillOpacity: 0.5
                                }
                            }
                        });

                        //add popup to AgBaseline feature layer
                        AgBaseline.bindPopup(function(evt) {
                            return L.Util.template('<p>{cropcatego}<br>{island}</p>', evt.feature.properties);
                        });

                        //ESRI ArcGIS layers from Hawaii GIS Program; line feature layer example; can override the styling
                        //Using a relative url to call layer
                        var Trails = L.esri.featureLayer({
                            url: '//geodata.hawaii.gov/arcgis/rest/services/Terrestrial/MapServer/34',
                            style: function(feature) {
                                return {
                                    color: '#328000',
                                    weight: 2
                                }
                            }
                        });

                        //PacIOOS GeoServer Example; adding a single layer with properties
                        //Using a relative url to call layer instead of http
                        var EconSeaLevRise = L.tileLayer.wms('http://geo.pacioos.hawaii.edu/geoserver/wms?', {
                            layers: 'PACIOOS:hi_tt_all_slrxa_econ_2030',
                            format: 'image/png',
                            opacity: 0.5,
                            tiled: 'true'
                        });

                        //Another example using PacIOOS GeoServer examples; setting properties first then add layers     
                        var options = {
                            transparent: 'true',
                            format: 'image/png',
                            opacity: 0.5,
                            tiled: 'true'
                            //info_format: 'text/html'
                        };

                        //Using a relative url to call layer instead of http
                        var source = L.WMS.source('http://geo.pacioos.hawaii.edu/geoserver/wms?', options);
                        var CREDREASites = source.getLayer('PACIOOS:hi_cred_all_rea_sites');
                        var VegShoreline = source.getLayer('PACIOOS:hi_hcgg_all_shore_veg');

                        //Load OSM Buildings then disable it on first load; can only be viewed at certain scales
                        var osmb = new OSMBuildings(map).load();
                        map.removeLayer(osmb);

                        //Overlay grouped layers    
                        var groupOverLays = {
                            "Hawaii State GIS": {
                                "Water Quality Monitoring Sites": WaterQualSites,
                                "Na Ala Hele Trails": Trails,
                                "Agricultural Baseline": AgBaseline
                            },

                            "PacIOOS Layers": {
                                "Economic Loss from Sea Level Rise (0.5ft) ": EconSeaLevRise,
                                "CRED REA Sites": CREDREASites,
                                "Vegetation Shoreline": VegShoreline
                            },

                            "OSM Bldg Classic": {
                                "2.5D Buildings": osmb
                            }
                        };

                        //add layer switch control
                        L.control.groupedLayers(baseLayers, groupOverLays).addTo(map);


                        //add scale bar to map
                        L.control.scale({
                            position: 'bottomleft'
                        }).addTo(map);

                        // Overview mini map
                        var Esri_WorldTopoMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
                            attribution: '&copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community'
                        });

                        //define Drawing toolbar options
                        var options = {
                            position: 'topleft', // toolbar position, options are 'topleft', 'topright', 'bottomleft', 'bottomright'
                            drawMarker: true, // adds button to draw markers
                            drawPolyline: true, // adds button to draw a polyline
                            drawRectangle: true, // adds button to draw a rectangle
                            drawPolygon: true, // adds button to draw a polygon
                            drawCircle: true, // adds button to draw a cricle
                            cutPolygon: true, // adds button to cut a hole in a polygon
                            editMode: true, // adds button to toggle edit mode for all layers
                            removalMode: true, // adds a button to remove layers
                        };

                        // add leaflet.pm controls to the map
                        map.pm.addControls(options);

                        //Logo position: bottomright
                        var credctrl = L.controlCredits({
                            image: "Images/opengislab_106x23.png",
                            link: "https://www.opengislab.com/",
                            text: "Leaflet map example by Stephanie @ <u>opengislab.com<u/>"
                        }).addTo(map);
                    </script>
                </div><br>
            </div>
            <footer class="footer text-center">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Calon Asisten Laboratorium Matematika Unpad <?= date('Y'); ?></span>
                    </div>

                </div>

                All Rights Reserved by Bayu and Shenya
            </footer>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
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
    <script src="<?php echo base_url('assets/js/dashboard1.js'); ?>"></script>

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