<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->

    <link href="/css/theme.css" rel="stylesheet" media="all">
    <!-- Fontfaces CSS-->
    <link href="/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS-->


    <!-- Vendor CSS-->
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">



</head>


<body class="animsition ">
    <!-- HEADER DESKTOP-->
    <header class="header-desktop d-none d-lg-block p-md-3">
        <?php
        $auth = service('authentication');
        $isLoggedIn = $auth->check();
        $user = $auth->user();
        ?>

        <?php if ($isLoggedIn) : ?>
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <a href="#">
                        <img class="img-cir logo-desktop" src="/img/icon/logo.png" alt="Airputih" />
                    </a>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <a href="tiket/tiket-saya">
                                    <i class="fas fa-ticket-alt text-dark"> Tiket Saya</i>
                                </a>
                            </li>
                            <li>
                                <a href="/tiket">
                                    <i class="fas fas fa-search text-dark"> Cari Tiket</i>
                                </a>
                            </li>
                            <li>
                                <a href="/live-cctv">
                                    <i class="fas bi-camera-video-fill text-dark"> Live CCTV</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item account-item--style2 clearfix js-item-menu">
                            <div class="image">
                                <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User Image">
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User Image">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <?= $user->username ?>
                                        </h5>
                                        <span class="email"><a href="#"><?= $user->email ?></a></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="user/account">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="/tiket/tiket-saya">
                                            <i class="zmdi zmdi-shopping-cart"></i>Tiket Saya</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="<?= base_url('logout'); ?>">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <a href="#">
                        <img class="img-cir logo-desktop" src="/img/icon/logo.png" alt="Airputih" />
                    </a>
                    <div class="account-wrap">
                        <a href="/login" class="btn button-shadow">Login</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </header>


    <!-- END HEADER DESKTOP-->


    <!-- HEADER MOBILE-->

    <header class="header-mobile header-mobile-2 d-block d-lg-none">

        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">

                    <img src="/img/icon/.png" alt="Logo" class="logos">

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
                    <?php if ($isLoggedIn) : ?>
                        <li>
                            <div class="account-wrap ml-4">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content">
                                        <div class="info clearfix">
                                            <div class="image mr-3">
                                                <img src="<?= base_url('img/user/' . $user->user_image) ?>" alt="User Image">
                                            </div>
                                            <div class="content">
                                                <div class="name">
                                                    <?= $user->username ?>
                                                    <div class="email"> <?= $user->email ?></div>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="tiket/tiket-saya">
                                <i class="ml-2 fas fa-ticket-alt"></i>Tiket Saya</a>
                        </li>
                        <li>
                            <a href="/tiket">
                                <i class="ml-2 fas fa-search"></i>Cari Tiket</a>
                        </li>
                        <li>
                            <a href="/live-cctv">
                                <i class="ml-2 bi-camera-video-fill"></i>Live CCTV</a>
                        </li>
                        <li>
                            <a href="#about">
                                <i class="ml-2 fa fa-gear"></i>Settings</a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="ml-2 fa fa-power-off"></i>Logout</a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="/login">
                                <i class="ml-2 fa bi bi-box-arrow-in-right"></i>Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>


    </header>

    <!-- END HEADER MOBILE -->



    <!--{Penting}-->

    <script src="/vendor/animsition/animsition.min.js"></script>
    <script src="/js/main.js"></script>



    <script type="text/javascript">
        var header = document.querySelector('.header-desktop');
        var loginbtn = document.querySelector('.button-shadow');
        var isis = document.querySelectorAll('.header__navbar ul li a i'); // Menggunakan querySelectorAll untuk memilih semua elemen "i" di dalam link
        var isScrolling = false;

        window.addEventListener('scroll', function() {
            if (!isScrolling) {
                header.classList.add('text-dark');
                for (var i = 0; i < isis.length; i++) {
                    isis[i].classList.add('text-dark');
                }
                isScrolling = true;
            }

            clearTimeout(scrollTimeout);
            var scrollTimeout = setTimeout(function() {
                if (window.pageYOffset > 350) {
                    header.style.backgroundColor = 'black';
                    loginbtn.classList.add('button-shadow1');
                    loginbtn.classList.remove('button-shadow');
                    loginbtn.style.color = 'white';

                    for (var i = 0; i < isis.length; i++) {
                        isis[i].classList.remove('text-dark');
                        ss

                    }
                } else {
                    header.style.backgroundColor = 'transparent';
                    loginbtn.classList.add('button-shadow');
                    loginbtn.classList.remove('button-shadow1');
                    loginbtn.style.color = 'black';
                    for (var i = 0; i < isis.length; i++) {
                        isis[i].classList.add('text-dark');
                    }
                }
                isScrolling = true;
            }, 100);
        });
    </script>






</body>

</html>

</div>

<script>
    function toggleNavbarCard() {
        var navbarCard = document.getElementById("navbarCard");
        navbarCard.style.display = navbarCard.style.display === "block" ? "none" : "block";
    }
</script>