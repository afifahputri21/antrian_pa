<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        //KODE 1 ADALAH ADMIN
        //KODE 2 ADALAH PEGAWAI
        if ($user['role_id'] == 1) {
        ?>
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">ADMIN </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->


                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Hak Akses
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('Dashboard/') ?>">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Akun/') ?>">
                        <i class="fas fa-user-alt"></i>
                        <span>Akun</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Akun/hak_akses') ?>">
                        <i class="fas fa-user-lock"></i>
                        <span>Manajemen Hak Akses</span>
                    </a>
                </li>

                <div class="sidebar-heading">
                    Tenaga Kesehatan
                </div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Perawat/') ?>">
                        <i class="fas fa-user-nurse"></i>
                        <span>Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Poli/') ?>">
                        <i class="fas fa-user-md"></i>
                        <span>Poliknik</span>
                    </a>
                </li>

                <div class="sidebar-heading">
                    Pelayanan dan Administrasi
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Pasien/admin') ?>">
                        <i class="fas fa-user-alt"></i>
                        <span>Akun Pasien</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Anggota/') ?>">
                        <i class="fas fa-users"></i>
                        <span>Anggota Keluarga Pasien</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Antrian/admin') ?>">
                        <i class="fas fa-sort-alpha-up"></i>
                        <span>Antrian</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('RM/') ?>">
                        <i class="far fa-folder-open"></i>
                        <span>Rekam Medis</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('Laporan/') ?>">
                        <i class="far fa-file-alt"></i>
                        <span>Laporan</span>
                    </a>
                </li>

            <?php
        } elseif ($user['role_id'] == 2) {
            ?> <!-- Sidebar -->
                <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="sidebar-brand-text mx-3">RESEPSIONIS </div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->


                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Menu
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Dashboard/') ?>">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="<?= site_url('Pasien/') ?>">
                            <i class="fas fa-user-alt"></i>
                            <span>Pasien</span>
                        </a>
                        <!-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Static Navigation</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                        </nav>
                    </div> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="<?= site_url('Anggota/') ?>">
                            <i class="fas fa-users"></i>
                            <span>Anggota Keluarga Pasien</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="<?= site_url('Antrian/') ?>">
                            <i class="fas fa-sort-alpha-up"></i>
                            <span>Antrian</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="<?= site_url('RM/') ?>">
                            <i class="far fa-folder-open"></i>
                            <span>Rekam Medis</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="<?= site_url('Laporan/') ?>">
                            <i class="far fa-file-alt"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                <?php
            } else {
                ?>
                    <!-- Sidebar -->
                    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                        <!-- Sidebar - Brand -->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                            <div class="sidebar-brand-icon">
                                <i class="fas fa-user-nurse"></i>
                            </div>
                            <div class="sidebar-brand-text mx-3">TENAGA KESEHATAN </div>
                        </a>

                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

                        <!-- Nav Item - Dashboard -->


                        <!-- Divider -->
                        <hr class="sidebar-divider">

                        <!-- Heading -->
                        <div class="sidebar-heading">
                            Menu
                        </div>

                        <!-- Nav Item - Pages Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= site_url('Dashboard/') ?>">
                                <i class="fas fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Admin/gigi') ?>">
                                <i class="fas fa-tooth"></i>
                                <span>Poli Gigi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Admin/lansia') ?>">
                                <i class="fas fa-wheelchair"></i>
                                <span>Poli Lansia</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Admin/kia') ?>">
                                <i class="fas fa-users"></i>
                                <span>Poli KIA (Ibu dan Anak)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Admin/umum') ?>">
                                <i class="fas fa-user-md"></i>
                                <span>Poli Umum</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Admin/anak') ?>">
                                <i class="fas fa-baby"></i>
                                <span>Poli Anak</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="<?= site_url('Auth/logout') ?>">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>Log out</span>
                            </a>
                        </li>

                    <?php
                }
                    ?>


                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                    </ul>

                    <!-- End of Sidebar -->

                    <!-- Content Wrapper -->
                    <div id="content-wrapper" class="d-flex flex-column">

                        <!-- Main Content -->
                        <div id="content">

                            <!-- Topbar -->
                            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                                <!-- Sidebar Toggle (Topbar) -->
                                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                    <i class="fa fa-bars"></i>
                                </button>

                                <!-- Topbar Search -->
                                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Topbar Navbar -->
                                <ul class="navbar-nav ml-auto">

                                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                                    <li class="nav-item dropdown no-arrow d-sm-none">
                                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-search fa-fw"></i>
                                        </a>
                                        <!-- Dropdown - Messages -->
                                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                            <form class="form-inline mr-auto w-100 navbar-search">
                                                <div class="input-group">
                                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button">
                                                            <i class="fas fa-search fa-sm"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>

                                    <?php
                                    // if ($user['role'] == 'User') {
                                    ?>
                                    <!-- Nav Item - Alerts
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="<?= base_url('Profil/pembelian'); ?>">
                                <i class="fas fa-history fa-fw"></i>
                                 Counter - Alerts -->
                                    <!-- <span class="badge badge-danger badge-counter">
                                    !
                                </span>
                            </a>
                            Dropdown - Alerts -->
                                    </li>
                                    <!-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#">
                                <i class="fas fa-shopping-cart fa-fw"></i>
                                Counter - Alerts 
                                <span class="badge badge-danger badge-counter">

                                </span>
                            </a> -->
                                    <!-- Dropdown - Alerts -->
                                    </li>

                                    <?php
                                    // } 
                                    ?>


                                    <div class="topbar-divider d-none d-sm-block"></div>

                                    <!-- Nav Item - User Information -->
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                                            <img class="img-profile rounded-circle" src="<?= base_url('assets/assets/img/profile/') . $user['image'] ?>">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Profile
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Settings
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Activity Log
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="Auth/logout" data-toggle="modal" data-target="#logoutModal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Logout
                                            </a>
                                        </div>
                                    </li>

                                </ul>

                            </nav>