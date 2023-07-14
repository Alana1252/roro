<!DOCTYPE html>
<html>

<?php
$auth = service('authentication');
$isLoggedIn = $auth->check();
$user = $auth->user();
?>

<head>
    <title><?= $title ?> | Go-RoRo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Library Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/css/theme.css" media="all">
    <!--Sidebar-->
</head>

<body class="animsition ">

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">

            <div class="logos">
                <img src="<?= base_url('img/icon/admin.png') ?>">
            </div>
            <ul class="list-unstyled components text-center">

                <li class="deactive">
                    <a href="/">
                        <span class="icon-wrapper">
                            <i class="bi bi-house icons"></i>
                        </span>
                        <div>Dashboard</div>
                    </a>
                </li>
                <?php if (!logged_in() || in_groups('admin')) : ?>
                    <li class="deactive">
                        <a href="/admin/transaksi">
                            <span class="icon-wrapper">
                                <i class="bi bi-graph-up icons"></i>
                            </span>
                            <div>Transaksi</div>
                        </a>
                    </li>
                    <li class="deactive">
                        <a href="/admin/tiket">
                            <i class="bi bi-ticket-perforated icons"></i>
                            <div>Tiket</div>
                        </a>
                    </li>
                    <li class="deactive">
                        <a href="/admin/user">
                            <i class="bi bi-people icons"></i>
                            <div>Users</div>
                        </a>
                    </li>
                <?php elseif (in_groups('operator')) : ?><li class="deactive">
                        <a href="/operator/tiket">
                            <span class="icon-wrapper">
                                <i class="bi bi-ticket-perforated icons"></i>
                            </span>
                            <div>Tiket</div>
                        </a>
                    </li>
                    <li class="deactive">
                        <a href="/operator/print">
                            <i class="bi bi-printer icons"></i>
                            <div>Print Tiket</div>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="footer">
                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script>
                <p>Crated with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://www.facebook.com/alankamesta" target="_blank">Alan Kamesta Ginting</a></p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>


        </nav>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">

                            <li class="nav-item">
                                <div class="vl"></div>
                            </li>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="">
                                        <i class="bi bi-person mr-1" style="font-size:24px;"></i>
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User_image" />
                                                </a>
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
                                                <a href="/user/account">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="#">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
            <script src="/vendor/animsition/animsition.min.js"></script>
            <script src="/js/main.js"></script>
            <script>
                // Get the current page URL
                var currentPageUrl = window.location.pathname;

                // Select the sidebar items
                var sidebarItems = document.querySelectorAll(".list-unstyled.components li");

                // Loop through the sidebar items
                sidebarItems.forEach(function(item) {
                    // Get the link href of the current item
                    var linkHref = item.querySelector("a").getAttribute("href");

                    // Get the path from the link href
                    var linkPath = new URL(linkHref, window.location.origin).pathname;

                    // Check if the current page URL matches the link path exactly
                    if (currentPageUrl === linkPath) {
                        // Add the "active" class to the item
                        item.classList.add("active");
                    }
                });
            </script>

</body>

</html>