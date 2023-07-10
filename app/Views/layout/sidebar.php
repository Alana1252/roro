<!DOCTYPE html>
<html>

<?php
$auth = service('authentication');
$isLoggedIn = $auth->check();
$user = $auth->user();
?>

<head>
    <title>AirPutih | Members</title>
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
        <nav id="sidebar" class="">
            <div class="p-4 pt-5">
                <img src="<?= base_url('img/' . $user->user_image) ?>" class="img logo rounded-circle mb-5" id="imgBlock" class="imgBlock">
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?= $user->username ?><span class="name"></span>!</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a><i class="fa fa-envelope"></i> <?= $user->email ?></a>
                            </li>
                            <li>
                                <a><i class="fa fa-user-plus"></i> <?= $user->created_at ?></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/account/my-account"><i class="bi bi-person-fill-gear"></i> Account Options</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle "><i class="bi bi-back"></i> Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="/home"><i class="bi bi-house-fill "></i> Home</a>
                            </li>
                            <li>
                                <a href="/admin/tiket"><i class="bi bi-ticket-perforated-fill"></i> Tiket</a>
                            </li>
                            <li>
                                <a href="/admin/transaksi"><i class="bi bi-cash-stack"></i> Transaksi</a>
                            </li>
                            <li>
                                <a href="/admin/user"><i class="bi bi-people-fill"></i> Users</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/home"><i class="bi bi-cassette-fill"></i> Go to Website</a>
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-sign-out"></i> Log Out</a>
                    </li>
                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script>
                    <p>Crated with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://www.facebook.com/alankamesta" target="_blank">Alan Kamesta Ginting</a></p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>

            </div>
        </nav>
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                                <a class="nav-link" href="/home">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/tiket">Tiket</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/transaksi">Transaksi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/user">User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/more">More</a>
                            </li>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </ul>
                    </div>
                </div>
            </nav>
            <script src="/vendor/animsition/animsition.min.js"></script>
            <script src="/js/main.js"></script>
</body>

</html>