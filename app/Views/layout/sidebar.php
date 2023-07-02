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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->

    <link rel="stylesheet" href="/css/theme.css" media="all">
    <!--Sidebar-->

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <div class="p-4 pt-5">
                <img src="<?= base_url('img/' . $user->user_image) ?>" class="img logo rounded-circle mb-5" id="imgBlock" class="imgBlock">
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?= $user->username ?><span class="name"></span>!</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a>Email: <?= $user->email ?></a>
                            </li>
                            <li>
                                <a>Created: <?= $user->created_at ?></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="page.php">Account Options</a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="home.php">Home</a>
                            </li>
                            <li>
                                <a href="album.php">Album</a>
                            </li>
                            <li>
                                <a href="memori.php">Memori Usages</a>
                            </li>
                            <li>
                                <a href="event.php">Event Settings</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="https://ti6a.my.id/">Go to Website</a>
                    </li>
                    <li>
                        <a href="#">Contact Me</a>
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
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="album.php">Album</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="memori.php">Memory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="event.php">Event</a>
                            </li>

                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-person-fill"></i>
                                            <i class="bi bi-sort-desc"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <p></p>
                                            <a class="dropdown-item" href="page.php" class="rounded-circle mr-2" style="height: 23px; width: 23px;">
                                                <strong class="text-left"></strong>
                                                <hr class="dropdown-divider" />
                                                <a class="dropdown-item text-center" href="/logout">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>

</head>

<body>


</body>

</html>