<?php 
include "config/app.php"; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Negeri 1 Cerme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="stylesheet" href="assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <style>
    :root {
        --bs-body-bg: #8aa3cf;
    }

    marquee {
        background: #333;
        margin: 30px auto;
        display: block;
        color: #fff;
    }

    marquee:nth-child(2) {
        background: #25396F;
    }

    marquee:nth-child(3) {
        background: #25396F;
    }

    marquee:nth-child(4) {
        background: #25396F;
    }

    .ticker-up li {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .ticker-down li {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .ticker-left li {
        display: inline-block;
        font-size: 18px;
        line-height: 40px;
    }

    .ticker-right li {
        display: inline-block;
        font-size: 18px;
        line-height: 40px;
    }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logosmknew.png"
                                    style="width:200px; height:auto" alt="Logo"></a>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <?php  if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "siswa")) {   ?>
                        <li class="sidebar-title">Menu</li>
                        <?php  } ?>

                        <?php  if ($_SESSION['level'] == "siswa") { ?>
                        <li class="sidebar-item  ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="fas fa-address-card"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <?php  } ?>

                        <?php  if ($_SESSION['level'] == "admin") {  ?>
                        <li class="sidebar-item  ">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <?php  } ?>

                        <?php  if ($_SESSION['level'] == "admin" || ($_SESSION['level'] == "petugas")) {   ?>
                        <li class="sidebar-title">Data</li>

                        <li class="sidebar-item  ">
                            <a href="siswa.php" class='sidebar-link'>
                                <i class="fas fa-user-graduate"></i>
                                <span>Siswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="kelas.php" class='sidebar-link'>
                                <i class="fas fa-school"></i>
                                <span>Kelas</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="spp.php" class='sidebar-link'>
                                <i class="fas fa-folder"></i>
                                <span>SPP</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="akun.php" class='sidebar-link'>
                                <i class="fas fa-user-circle"></i>
                                <span>Akun</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Features</li>
                        <li class="sidebar-item  ">
                            <a href="pembayaran.php" class='sidebar-link'>
                                <i class="fas fa-money-check"></i>
                                <span>Pembayaran</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="report.php" class='sidebar-link'>
                                <i class="fas fa-print"></i>
                                <span>Report</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="history.php" class='sidebar-link'>
                                <i class="fas fa-history"></i>
                                <span>Histori Pembayaran</span>
                            </a>
                        </li>
                        <?php  } ?>
                        <?php  if ($_SESSION['level'] == "siswa") { ?>
                        <li class="sidebar-item  ">
                            <a href="historibayar.php" class='sidebar-link'>
                                <i class="fas fa-history"></i>
                                <span>Histori Pembayaran</span>
                            </a>
                        </li>
                        <?php  } ?>



                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                    height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                            opacity=".3"></path>
                                        <g transform="translate(-210 -1)">
                                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                            <circle cx="220.5" cy="11.5" r="4"></circle>
                                            <path
                                                d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="form-check form-switch fs-6">
                                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                    <label class="form-check-label"></label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                    </path>
                                </svg>
                            </ul>
                            <p> ‎ ‎ ‎ ‎ </p>

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown"
                                    class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="assets/images/faces/profil.png" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name"><?= $_SESSION['namanya']?></h6>
                                        <p class="user-dropdown-status text-sm text-muted"><?= $_SESSION['level']?></p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="topbarUserDropdown">
                                    <li><a type="button" class="dropdown-item" dropdown-item data-bs-toggle="modal"
                                            data-bs-target="#modalLogout"><i class="fas fa-sign-out-alt"></i> Logout
                                        </a></li>
                                </ul>
                            </div>
                            <div class="modal fade text-left" id="modalLogout" tabindex="-1" role="dialog"
                                aria-labelledby="modalEdit" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modalEdit">Konfirmasi </h4>
                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <b>
                                                    <p>Apakah Anda Yakin Ingin Logout?</p>
                                                </b>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <a href="logout.php" class="btn btn-danger ml-1"><i
                                                        class="bx bx-check d-block d-sm-none"></i><span
                                                        class="d-none d-sm-block">Logout</span></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                </nav>
            </header>
            <marquee direction="left" height="40px" width="100%" style="margin-top: -20px;" scrollamount="10"
                onmouseover="this.stop();" onmouseout="this.start();">
                <ul class="ticker-right">
                    <li> Selamat Datang di Website Pembayaran SPP Stellar Academy</li>
            </marquee>