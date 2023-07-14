<?php
$auth = service('authentication');
$isLoggedIn = $auth->check();
$user = $auth->user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <script src="/vendor/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Title Page-->
    <title>Dashboard</title>


    <!-- Main CSS-->
    <link href="css/admin.css" rel="stylesheet" media="all">

</head>


<body class="animsition">
    <?= $this->include('layout/alerts'); ?>
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="/">
                            <img src="/img/icon/admin.png" alt="Admin dashboard" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="/">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            </ul>
                        </li>
                        <?php if (!logged_in() || in_groups('admin')) : ?>
                            <li>
                                <a href="/admin/transaksi">
                                    <i class="fas fa-chart-bar"></i>Transaksi</a>
                            </li>
                            <li>
                                <a href="/admin/tiket">
                                    <i class="bi bi-ticket-detailed-fill"></i>Tiket</a>
                            </li>
                            <li>
                                <a href="admin/user">
                                    <i class="bi bi-people-fill"></i>Users</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>Pages</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="admin/berita"><i class="bi bi-newspaper"></i>Berita</a>
                                    </li>
                                    <li>
                                        <a href="admin/kelas"><i class="bi bi-sort-numeric-up-alt"></i>Kelas Tiket</a>
                                    </li>
                                    <li>
                                        <a href="admin/kendaraan"><i class="bi bi-car-front-fill"></i>Kendaraan</a>
                                    </li>
                                    <li>
                                        <a href="admin/kapal"><i class="bi bi-wrench"></i></i>Penyedia Layanan</a>
                                    </li>
                                    <li>
                                        <a href="admin/jam"><i class="bi bi-clock-fill"></i>Jam Tiket</a>
                                    </li>
                                    <li>
                                        <a href="admin/lokasi"><i class="bi bi-geo-alt-fill"></i>Lokasi</a>
                                    </li>
                                </ul>
                            </li>
                        <?php elseif (in_groups('operator')) : ?>
                            <li>
                                <a href="/operator/tiket">
                                    <i class="bi bi-ticket-detailed-fill"></i>Tiket</a>
                            </li>
                            <li>
                                <a href="/operator/print">
                                    <i class="bi bi-printer-fill"></i>Print Tiket</a>
                            </li>
                        <?php endif ?>
                        <li>
                            <a href="/logout">
                                <i class="bi bi-door-open-fill"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="/img/icon/admin.png" alt="Logo" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="/">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <?php if (!logged_in() || in_groups('admin')) : ?>
                            <li>
                                <a href="/admin/transaksi">
                                    <i class="fas fa-chart-bar"></i>Transaksi</a>
                            </li>
                            <li>
                                <a href="/admin/tiket">
                                    <i class="bi bi-ticket-detailed-fill"></i>Tiket</a>
                            </li>
                            <li>
                                <a href="admin/user">
                                    <i class="bi bi-people-fill"></i>Users</a>
                            </li>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-copy"></i>More<i class="bi bi-caret-down-fill fa-xs" style="margin-left:50%"></i></a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="admin/berita"><i class="bi bi-newspaper"></i>Berita</a>
                                    </li>
                                    <li>
                                        <a href="admin/kelas"><i class="bi bi-sort-numeric-up-alt"></i>Kelas Tiket</a>
                                    </li>
                                    <li>
                                        <a href="admin/kendaraan"><i class="bi bi-car-front-fill"></i>Kendaraan</a>
                                    </li>
                                    <li>
                                        <a href="admin/kapal"><i class="bi bi-wrench"></i></i>Penyedia Layanan</a>
                                    </li>
                                    <li>
                                        <a href="admin/jam"><i class="bi bi-clock-fill"></i>Jam Tiket</a>
                                    </li>
                                    <li>
                                        <a href="admin/lokasi"><i class="bi bi-geo-alt-fill"></i>Lokasi</a>
                                    </li>
                                </ul>
                            </li>

                        <?php elseif (in_groups('operator')) : ?>
                            <li>
                                <a href="/operator/tiket">
                                    <i class="bi bi-ticket-detailed-fill"></i>Tiket</a>
                            </li>
                            <li>
                                <a href="/operator/print">
                                    <i class="bi bi-printer-fill"></i>Print Tiket</a>
                            </li>
                        <?php endif; ?>
                        <li class="has-sub">
                            <a class="js-arrow" href="/logout">
                                <i class="bi bi-door-open-fill"></i>Log Out</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">

                            </form>

                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User_image" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?= $user->username ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User_image" />
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?= $user->username ?></a>
                                                    </h5>
                                                    <span class="email"><?= $user->email ?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="user/account">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="/logout">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (!logged_in() || in_groups('admin')) : ?>
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Admin Dashboard</h2><a href="/generate">
                                            <button class="au-btn au-btn-icon au-btn--blue rounded-pill">
                                                <i class="zmdi zmdi-plus"></i>Generate Tiket</button></a>
                                    </div>
                                <?php elseif (in_groups('operator')) : ?>
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Operator Dashboard</h2>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php if (!logged_in() || in_groups('admin')) : ?>
                            <div class="row m-t-25">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="overview-item overview-item--c1">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-account-o"></i>
                                                </div>
                                                <div class="text">
                                                    <h3 class="text-white"><?= $userAktif ?></h3>
                                                    <span>Pengguna aktif</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart1"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="overview-item overview-item--c2">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </div>
                                                <div class="text">
                                                    <h3 class="text-white"><?= $tiketBerhasil ?></h3>
                                                    <span>Tiket terjual</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart2"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="overview-item overview-item--c3">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-calendar-note"></i>
                                                </div>
                                                <div class="text">
                                                    <h3 class="text-white"><?= $tiketBulan; ?></h3>
                                                    <span>Bulan ini</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart3"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="overview-item overview-item--c4">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-money"></i>
                                                </div>
                                                <div class="text">
                                                    <h3 class="text-white">Rp.<?= number_format($paymentBerhasil, 0, ',', '.') ?></h3>
                                                    <span>Total pendapatan</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart4"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php elseif (in_groups('operator')) : ?>
                                <div class="col-sm-6 col-lg-3 mt-5">
                                    <div class="overview-item overview-item--c2">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </div>
                                                <div class="text">
                                                    <h3 class="text-white"><?= $tiketBerhasil ?></h3>
                                                    <span>Tiket terjual</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                                <canvas id="widgetChart2"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-light text-center text-white" style="position:absolute; width:1238px; right:0;">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #dd4b39;" href="#!" role="button"><i class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                    <!-- Linkedin -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #0082ca;" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                    <!-- Github -->
                    <a class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i class="fab fa-github"></i></a>
                </section>
                <!-- Section: Social media -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: #1c1c1ced;">
                <img src="/img/icon/logo.png" style="max-width: 35px; max-height:35px;">
                <a class="text-white" style="font-weight: bold;" href="#">Go-RoRo</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->

    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>

    <script src="vendor/animsition/animsition.min.js"></script>

    <script src="vendor/chartjs/Chart.bundle.min.js"></script>

    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->