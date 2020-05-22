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
    <link href="<?php echo base_url('assets/vendor/qrcode/'); ?>css/style.css" rel="stylesheet">
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
                <button title="Play" class="btn btn-success mb-3" id="play" type="button" data-toggle="tooltip">Play</span></button>
                <div>
                    <div class="" id="QR-Code">
                        <div class="panel-heading">
                            <div class="navbar-form">
                                <div class="form-group card">
                                    <select class="form-control" id="camera-select"></select>
                                </div>
                            </div>
                        </div><br><br>
                        <div>
                            <div class="panel panel-info row">
                                <div class="col-md-6" style="text-align:center">
                                    <div style="position: relative;display: inline-block;">
                                        <canvas width="320" id="webcodecam-canvas"></canvas>
                                        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center">
                                    <div class="thumbnail" id="result">
                                        <div style="overflow: hidden; text-align:center; margin:auto;">
                                            <img width="320" height="240" id="scanned-img" style="margin:auto;" src="">
                                        </div>
                                        <br>
                                        <div class="caption card" style="width: 100%;">
                                            <h3>Scanned result</h3>
                                            <p id="scanned-QR"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="<?= base_url('assets/vendor/qrcode/') ?>js/qrcodelib.js"></script>
                    <script>
                        var WebCodeCamJS = function(element) {
                            this.Version = {
                                name: 'WebCodeCamJS',
                                version: '2.7.0',
                                author: 'Tóth András',
                            };
                            var mediaDevices = window.navigator.mediaDevices;
                            mediaDevices.getUserMedia = function(c) {
                                return new Promise(function(y, n) {
                                    (window.navigator.getUserMedia || window.navigator.mozGetUserMedia || window.navigator.webkitGetUserMedia).call(navigator, c, y, n);
                                });
                            }
                            HTMLVideoElement.prototype.streamSrc = ('srcObject' in HTMLVideoElement.prototype) ? function(stream) {
                                this.srcObject = !!stream ? stream : null;
                            } : function(stream) {
                                if (!!stream) {
                                    this.src = (window.URL || window.webkitURL).createObjectURL(stream);
                                } else {
                                    this.removeAttribute('src');
                                }
                            };
                            var videoSelect, lastImageSrc, con, beepSound, w, h, lastCode;
                            var display = Q(element),
                                DecodeWorker = null,
                                video = html('<video muted autoplay playsinline></video>'),
                                sucessLocalDecode = false,
                                localImage = false,
                                flipMode = [1, 3, 6, 8],
                                isStreaming = false,
                                delayBool = false,
                                initialized = false,
                                localStream = null,
                                options = {
                                    decodeQRCodeRate: 5,
                                    decodeBarCodeRate: 3,
                                    successTimeout: 500,
                                    codeRepetition: true,
                                    tryVertical: true,
                                    frameRate: 15,
                                    width: 320,
                                    height: 240,
                                    constraints: {
                                        video: {
                                            mandatory: {
                                                maxWidth: 1280,
                                                maxHeight: 720
                                            },
                                            optional: [{
                                                sourceId: true
                                            }]
                                        },
                                        audio: false,
                                    },
                                    zoom: 0,
                                    beep: 'audio/beep.mp3',
                                    decoderWorker: 'js/DecoderWorker.js',
                                    brightness: 0,
                                    autoBrightnessValue: 0,
                                    contrast: 0,
                                    threshold: 0,
                                    resultFunction: function(res) {
                                        console.log(res.format + ": " + res.code);
                                    },
                                    cameraSuccess: function(stream) {
                                        console.log('cameraSuccess');
                                    },
                                    canPlayFunction: function() {
                                        console.log('canPlayFunction');
                                    },
                                    getDevicesError: function(error) {
                                        console.log(error);
                                    },
                                    getUserMediaError: function(error) {
                                        console.log(error);
                                    },
                                    cameraError: function(error) {
                                        console.log(error);
                                    }
                                };

                            function init() {
                                var constraints = changeConstraints();
                                try {
                                    mediaDevices.getUserMedia(constraints).then(cameraSuccess).catch(function(error) {
                                        options.cameraError(error);
                                        return false;
                                    });
                                } catch (error) {
                                    options.getUserMediaError(error);
                                    return false;
                                }
                                return true;
                            }
                            //window.onload = play();

                            function play() {
                                if (!localStream) {
                                    init();
                                }
                                const p = video.play();
                                if (p && (typeof Promise !== 'undefined') && (p instanceof Promise)) {
                                    p.catch(e => null);
                                }
                                delay();
                            }

                            function stop() {
                                delayBool = true;
                                const p = video.pause();
                                if (p && (typeof Promise !== 'undefined') && (p instanceof Promise)) {
                                    p.catch(e => null);
                                }
                                video.streamSrc(null);
                                con.clearRect(0, 0, w, h);
                                if (localStream) {
                                    for (var i = 0; i < localStream.getTracks().length; i++) {
                                        localStream.getTracks()[i].stop();
                                    }
                                }
                                localStream = null;
                            }

                            function pause() {
                                delayBool = true;
                                const p = video.pause();
                                if (p && (typeof Promise !== 'undefined') && (p instanceof Promise)) {
                                    p.catch(e => null);
                                }
                            }

                            function delay() {
                                delayBool = true;
                                if (!localImage) {
                                    setTimeout(function() {
                                        delayBool = false;
                                        if (options.decodeBarCodeRate) {
                                            tryParseBarCode();
                                        }
                                        if (options.decodeQRCodeRate) {
                                            tryParseQRCode();
                                        }
                                    }, options.successTimeout);
                                }
                            }

                            function beep() {
                                if (options.beep) {
                                    beepSound.play();
                                }
                            }

                            function cameraSuccess(stream) {
                                localStream = stream;
                                video.streamSrc(stream);
                                options.cameraSuccess(stream);
                            }

                            function cameraError(error) {
                                options.cameraError(error);
                            }

                            function setEventListeners() {
                                video.addEventListener('canplay', function(e) {
                                    if (!isStreaming) {
                                        if (video.videoWidth > 0) {
                                            h = video.videoHeight / (video.videoWidth / w);
                                        }
                                        display.setAttribute('width', w);
                                        display.setAttribute('height', h);
                                        isStreaming = true;
                                        if (options.decodeQRCodeRate || options.decodeBarCodeRate) {
                                            delay();
                                        }
                                    }
                                }, false);
                                video.addEventListener('play', function() {
                                    setInterval(function() {
                                        if (!video.paused && !video.ended) {
                                            var z = options.zoom;
                                            if (z === 0) {
                                                z = optimalZoom();
                                            }
                                            con.drawImage(video, (w * z - w) / -2, (h * z - h) / -2, w * z, h * z);
                                            var imageData = con.getImageData(0, 0, w, h);
                                            if (options.brightness !== 0 || options.autoBrightnessValue) {
                                                imageData = brightness(imageData, options.brightness);
                                            }
                                            if (options.contrast !== 0) {
                                                imageData = contrast(imageData, options.contrast);
                                            }
                                            con.putImageData(imageData, 0, 0);
                                        }
                                    }, 1E3 / options.frameRate);
                                }, false);
                            }

                            function setCallBack() {
                                DecodeWorker.onmessage = function(e) {
                                    if (localImage || (!delayBool && !video.paused)) {
                                        if (e.data.success === true && e.data.success != 'localization') {
                                            sucessLocalDecode = true;
                                            delayBool = true;
                                            delay();
                                            setTimeout(function() {
                                                if (options.codeRepetition || lastCode != e.data.result[0].Value) {
                                                    beep();
                                                    lastCode = e.data.result[0].Value;
                                                    options.resultFunction({
                                                        format: e.data.result[0].Format,
                                                        code: e.data.result[0].Value,
                                                        imgData: lastImageSrc
                                                    });
                                                }
                                            }, 0);
                                        }
                                        if ((!sucessLocalDecode || !localImage) && e.data.success != 'localization') {
                                            if (!localImage) {
                                                setTimeout(tryParseBarCode, 1E3 / options.decodeBarCodeRate);
                                            }
                                        }
                                    }
                                };
                                qrcode.callback = function(a) {
                                    if (localImage || (!delayBool && !video.paused)) {
                                        sucessLocalDecode = true;
                                        delayBool = true;
                                        delay();
                                        setTimeout(function() {
                                            if (options.codeRepetition || lastCode != a) {
                                                beep();
                                                lastCode = a;
                                                options.resultFunction({
                                                    format: 'QR Code',
                                                    code: a,
                                                    imgData: lastImageSrc
                                                });
                                            }
                                        }, 0);
                                    }
                                };
                            }

                            function tryParseBarCode() {
                                display.style.transform = 'scale(' + (options.flipHorizontal ? '-1' : '1') + ', ' + (options.flipVertical ? '-1' : '1') + ')';
                                if (options.tryVertical && !localImage) {
                                    flipMode.push(flipMode[0]);
                                    flipMode.splice(0, 1);
                                } else {
                                    flipMode = [1, 3, 6, 8];
                                }
                                lastImageSrc = display.toDataURL();
                                DecodeWorker.postMessage({
                                    scan: con.getImageData(0, 0, w, h).data,
                                    scanWidth: w,
                                    scanHeight: h,
                                    multiple: false,
                                    decodeFormats: ["Code128", "Code93", "Code39", "EAN-13", "2Of5", "Inter2Of5", "Codabar"],
                                    rotation: flipMode[0]
                                });
                            }

                            function tryParseQRCode() {
                                display.style.transform = 'scale(' + (options.flipHorizontal ? '-1' : '1') + ', ' + (options.flipVertical ? '-1' : '1') + ')';
                                try {
                                    lastImageSrc = display.toDataURL();
                                    qrcode.decode();
                                } catch (e) {
                                    if (!localImage && !delayBool) {
                                        setTimeout(tryParseQRCode, 1E3 / options.decodeQRCodeRate);
                                    }
                                }
                            }

                            function optimalZoom() {
                                return video.videoHeight / h;
                            }

                            function getImageLightness() {
                                var pixels = con.getImageData(0, 0, w, h),
                                    d = pixels.data,
                                    colorSum = 0,
                                    r, g, b, avg;
                                for (var x = 0, len = d.length; x < len; x += 4) {
                                    r = d[x];
                                    g = d[x + 1];
                                    b = d[x + 2];
                                    avg = Math.floor((r + g + b) / 3);
                                    colorSum += avg;
                                }
                                return Math.floor(colorSum / (w * h));
                            }

                            function brightness(pixels, adjustment) {
                                adjustment = adjustment === 0 && options.autoBrightnessValue ? Number(options.autoBrightnessValue) - getImageLightness() : adjustment;
                                var d = pixels.data;
                                for (var i = 0; i < d.length; i += 4) {
                                    d[i] += adjustment;
                                    d[i + 1] += adjustment;
                                    d[i + 2] += adjustment;
                                }
                                return pixels;
                            }

                            function contrast(pixels, cont) {
                                var data = pixels.data;
                                var factor = (259 * (cont + 255)) / (255 * (259 - cont));
                                for (var i = 0; i < data.length; i += 4) {
                                    data[i] = factor * (data[i] - 128) + 128;
                                    data[i + 1] = factor * (data[i + 1] - 128) + 128;
                                    data[i + 2] = factor * (data[i + 2] - 128) + 128;
                                }
                                return pixels;
                            }

                            function convolute(pixels, weights, opaque) {
                                var sw = pixels.width,
                                    sh = pixels.height,
                                    w = sw,
                                    h = sh,
                                    side = Math.round(Math.sqrt(weights.length)),
                                    halfSide = Math.floor(side / 2),
                                    src = pixels.data,
                                    tmpCanvas = document.createElement('canvas'),
                                    tmpCtx = tmpCanvas.getContext('2d'),
                                    output = tmpCtx.createImageData(w, h),
                                    dst = output.data,
                                    alphaFac = opaque ? 1 : 0;
                                for (var y = 0; y < h; y++) {
                                    for (var x = 0; x < w; x++) {
                                        var sy = y,
                                            sx = x,
                                            r = 0,
                                            g = 0,
                                            b = 0,
                                            a = 0,
                                            dstOff = (y * w + x) * 4;
                                        for (var cy = 0; cy < side; cy++) {
                                            for (var cx = 0; cx < side; cx++) {
                                                var scy = sy + cy - halfSide,
                                                    scx = sx + cx - halfSide;
                                                if (scy >= 0 && scy < sh && scx >= 0 && scx < sw) {
                                                    var srcOff = (scy * sw + scx) * 4,
                                                        wt = weights[cy * side + cx];
                                                    r += src[srcOff] * wt;
                                                    g += src[srcOff + 1] * wt;
                                                    b += src[srcOff + 2] * wt;
                                                    a += src[srcOff + 3] * wt;
                                                }
                                            }
                                        }
                                        dst[dstOff] = r;
                                        dst[dstOff + 1] = g;
                                        dst[dstOff + 2] = b;
                                        dst[dstOff + 3] = a + alphaFac * (255 - a);
                                    }
                                }
                                return output;
                            }

                            function buildSelectMenu(selectorVideo, ind) {
                                videoSelect = Q(selectorVideo);
                                videoSelect.innerHTML = '';
                                try {
                                    if (mediaDevices && mediaDevices.enumerateDevices) {
                                        mediaDevices.enumerateDevices().then(function(devices) {
                                            devices.forEach(function(device) {
                                                gotSources(device);
                                            });
                                            if (typeof ind === 'string') {
                                                Array.prototype.find.call(videoSelect.children, function(a, i) {
                                                    if (a['innerText' in HTMLElement.prototype ? 'innerText' : 'textContent'].toLowerCase().match(new RegExp(ind, 'g'))) {
                                                        videoSelect.selectedIndex = i;
                                                    }
                                                });
                                            } else {
                                                videoSelect.selectedIndex = videoSelect.children.length <= ind ? 0 : ind;
                                            }
                                        }).catch(function(error) {
                                            options.getDevicesError(error);
                                        });
                                    } else if (mediaDevices && !mediaDevices.enumerateDevices) {
                                        html('<option value="true">On</option>', videoSelect);
                                        options.getDevicesError(new NotSupportError('enumerateDevices Or getSources is Not supported'));
                                    } else {
                                        throw new NotSupportError('getUserMedia is Not supported');
                                    }
                                } catch (error) {
                                    options.getDevicesError(error);
                                }
                            }

                            function gotSources(device) {
                                if (device.kind === 'video' || device.kind === 'videoinput') {
                                    var face = (!device.facing || device.facing === '') ? 'unknown' : device.facing;
                                    var text = device.label || 'camera ' + (videoSelect.length + 1) + ' (facing: ' + face + ')';
                                    html('<option value="' + (device.id || device.deviceId) + '">' + text + '</option>', videoSelect);
                                }
                            }

                            function changeConstraints() {
                                var constraints = JSON.parse(JSON.stringify(options.constraints));
                                if (videoSelect && videoSelect.length !== 0) {
                                    switch (videoSelect[videoSelect.selectedIndex].value.toString()) {
                                        case 'true':
                                            if (navigator.userAgent.search("Edge") == -1 && navigator.userAgent.search("Chrome") != -1) {
                                                constraints.video.optional = [{
                                                    sourceId: true
                                                }];
                                            } else {
                                                constraints.video.deviceId = undefined;
                                            }
                                            break;
                                        case 'false':
                                            constraints.video = false;
                                            break;
                                        default:
                                            if (navigator.userAgent.search("Edge") == -1 && navigator.userAgent.search("Chrome") != -1) {
                                                constraints.video.optional = [{
                                                    sourceId: videoSelect[videoSelect.selectedIndex].value
                                                }];
                                            } else if (navigator.userAgent.search("Firefox") != -1) {
                                                constraints.video.deviceId = {
                                                    exact: videoSelect[videoSelect.selectedIndex].value
                                                };
                                            } else {
                                                constraints.video.deviceId = videoSelect[videoSelect.selectedIndex].value;
                                            }
                                            break;
                                    }
                                }
                                constraints.audio = false;
                                return constraints;
                            }

                            function Q(el) {
                                if (typeof el === 'string') {
                                    var els = document.querySelectorAll(el);
                                    return typeof els === 'undefined' ? undefined : els.length > 1 ? els : els[0];
                                }
                                return el;
                            }

                            function download(filename, url) {
                                var a = window.document.createElement('a'),
                                    bd = document.querySelector('body');
                                bd.appendChild(a);
                                a.setAttribute('href', url);
                                a.setAttribute('download', filename);
                                a.click();
                                bd.removeChild(a);
                            }

                            function mergeRecursive(target, source) {
                                if (typeof target !== 'object') {
                                    target = {};
                                }
                                for (var property in source) {
                                    if (source.hasOwnProperty(property)) {
                                        var sourceProperty = source[property];
                                        if (typeof sourceProperty === 'object') {
                                            target[property] = mergeRecursive(target[property], sourceProperty);
                                            continue;
                                        }
                                        target[property] = sourceProperty;
                                    }
                                }
                                for (var a = 2, l = arguments.length; a < l; a++) {
                                    mergeRecursive(target, arguments[a]);
                                }
                                return target;
                            }

                            function html(innerhtml, appendTo) {
                                var item = document.createElement('div');
                                if (innerhtml) {
                                    item.innerHTML = innerhtml;
                                }
                                if (appendTo) {
                                    appendTo.appendChild(item.children[0]);
                                    return item;
                                }
                                return item.children[0];
                            }

                            function NotSupportError(message) {
                                this.name = 'NotSupportError';
                                this.message = (message || '');
                            }
                            NotSupportError.prototype = Error.prototype;
                            return {
                                init: function(opt) {
                                    if (initialized) {
                                        return this;
                                    }
                                    if (!display || display.tagName.toLowerCase() !== 'canvas') {
                                        console.log('Element type must be canvas!');
                                        alert('Element type must be canvas!');
                                        return false;
                                    }
                                    con = display.getContext('2d');
                                    if (opt) {
                                        options = mergeRecursive(options, opt);
                                        if (options.beep) {
                                            beepSound = new Audio(options.beep);
                                        }
                                    }
                                    display.width = w = options.width;
                                    display.height = h = options.height;
                                    qrcode.sourceCanvas = display;
                                    initialized = true;
                                    setEventListeners();
                                    DecodeWorker = new Worker(options.decoderWorker);
                                    if (options.decodeQRCodeRate || options.decodeBarCodeRate) {
                                        setCallBack();
                                    }
                                    return this;
                                },
                                play: function() {
                                    localImage = false;
                                    setTimeout(play, 100);
                                    return this;
                                },
                                stop: function() {
                                    stop();
                                    return this;
                                },
                                pause: function() {
                                    pause();
                                    return this;
                                },
                                buildSelectMenu: function(selector, ind) {
                                    buildSelectMenu(selector, ind ? ind : 0);
                                    return this;
                                },
                                getOptimalZoom: function() {
                                    return optimalZoom();
                                },
                                getLastImageSrc: function() {
                                    return display.toDataURL();
                                },
                                isInitialized: function() {
                                    return initialized;
                                },
                                getWorker: function() {
                                    return DecodeWorker;
                                },
                                options: options
                            };
                        };
                    </script>
                    <script>
                        (function(undefined) {
                            "use strict";

                            function Q(el) {
                                if (typeof el === "string") {
                                    var els = document.querySelectorAll(el);
                                    return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
                                }
                                return el;
                            }
                            var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
                            var scannerLaser = Q(".scanner-laser"),
                                play = Q("#play"),
                                scannedImg = Q("#scanned-img"),
                                scannedQR = Q("#scanned-QR"),
                                contrast = Q("#contrast"),
                                contrastValue = Q("#contrast-value"),
                                brightness = Q("#brightness"),
                                brightnessValue = Q("#brightness-value"),
                                flipVertical = Q("#flipVertical"),
                                flipVerticalValue = Q("#flipVertical-value"),
                                flipHorizontal = Q("#flipHorizontal"),
                                flipHorizontalValue = Q("#flipHorizontal-value");
                            var args = {
                                autoBrightnessValue: 100,
                                resultFunction: function(res) {
                                    [].forEach.call(scannerLaser, function(el) {
                                        fadeOut(el, 0.5);
                                        setTimeout(function() {
                                            fadeIn(el, 0.5);
                                        }, 300);
                                    });
                                    scannedImg.src = res.imgData;
                                    scannedQR[txt] = res.format + ": " + res.code;
                                    window.location = '<?php echo site_url('user/sethadir/' . $absenid . '/' . $time . '/' . $code . '/' . $lat . '/' . $long) ?>?res=' + res.code;
                                },
                                getDevicesError: function(error) {
                                    var p, message = "Error detected with the following parameters:\n";
                                    for (p in error) {
                                        message += p + ": " + error[p] + "\n";
                                    }
                                    alert(message);
                                },
                                getUserMediaError: function(error) {
                                    var p, message = "Error detected with the following parameters:\n";
                                    for (p in error) {
                                        message += p + ": " + error[p] + "\n";
                                    }
                                    alert(message);
                                },
                                cameraError: function(error) {
                                    var p, message = "Error detected with the following parameters:\n";
                                    if (error.name == "NotSupportedError") {
                                        var ans = confirm("Your browser does not support getUserMedia via HTTP!\n(see: https:goo.gl/Y0ZkNV).\n You want to see github demo page in a new window?");
                                        if (ans) {
                                            window.open("https://andrastoth.github.io/webcodecamjs/");
                                        }
                                    } else {
                                        for (p in error) {
                                            message += p + ": " + error[p] + "\n";
                                        }
                                        alert(message);
                                    }
                                },
                            };
                            var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back").init(args);

                            play.addEventListener("click", function() {
                                if (!decoder.isInitialized()) {
                                    scannedQR[txt] = "Scanning ...";
                                } else {
                                    scannedQR[txt] = "Scanning ...";
                                    decoder.play();
                                }
                            }, false);
                            pause.addEventListener("click", function(event) {
                                scannedQR[txt] = "Paused";
                                decoder.pause();
                            }, false);
                            stop.addEventListener("click", function(event) {
                                scannedQR[txt] = "Stopped";
                                decoder.stop();
                            }, false);
                            Page.changeZoom = function(a) {
                                if (decoder.isInitialized()) {
                                    var value = typeof a !== "undefined" ? parseFloat(a.toPrecision(2)) : zoom.value / 10;
                                    zoomValue[txt] = zoomValue[txt].split(":")[0] + ": " + value.toString();
                                    decoder.options.zoom = value;
                                    if (typeof a != "undefined") {
                                        zoom.value = a * 10;
                                    }
                                }
                            };
                            Page.changeContrast = function() {
                                if (decoder.isInitialized()) {
                                    var value = contrast.value;
                                    contrastValue[txt] = contrastValue[txt].split(":")[0] + ": " + value.toString();
                                    decoder.options.contrast = parseFloat(value);
                                }
                            };
                            Page.changeBrightness = function() {
                                if (decoder.isInitialized()) {
                                    var value = brightness.value;
                                    brightnessValue[txt] = brightnessValue[txt].split(":")[0] + ": " + value.toString();
                                    decoder.options.brightness = parseFloat(value);
                                }
                            };
                            var getZomm = setInterval(function() {
                                var a;
                                try {
                                    a = decoder.getOptimalZoom();
                                } catch (e) {
                                    a = 0;
                                }
                                if (!!a && a !== 0) {
                                    Page.changeZoom(a);
                                    clearInterval(getZomm);
                                }
                            }, 500);

                            function fadeOut(el, v) {
                                el.style.opacity = 1;
                                (function fade() {
                                    if ((el.style.opacity -= 0.1) < v) {
                                        el.style.display = "none";
                                        el.classList.add("is-hidden");
                                    } else {
                                        requestAnimationFrame(fade);
                                    }
                                })();
                            }

                            function fadeIn(el, v, display) {
                                if (el.classList.contains("is-hidden")) {
                                    el.classList.remove("is-hidden");
                                }
                                el.style.opacity = 0;
                                el.style.display = display || "block";
                                (function fade() {
                                    var val = parseFloat(el.style.opacity);
                                    if (!((val += 0.1) > v)) {
                                        el.style.opacity = val;
                                        requestAnimationFrame(fade);
                                    }
                                })();
                            }
                            document.querySelector("#camera-select").addEventListener("change", function() {
                                if (decoder.isInitialized()) {
                                    decoder.stop().play();
                                }
                            });
                        }).call(window.Page = window.Page || {});
                    </script>
                    <script>
                        document.getElementById("play").click();
                    </script>
                    <!-- =====================================================================================-->
                    <br><br><br><br><br><br><br>
                </div>
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