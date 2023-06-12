<?php

use App\Models\UserModel;
use Myth\Auth\Authentication\LocalAuthenticator;

// Load the UserModel
$userModel = new UserModel();

// Get an instance of LocalAuthenticator
$auth = new LocalAuthenticator($userModel);

// Check if the user is logged in
if ($auth->check()) {
    // User is logged in
    // ...
} else {
    // User is not logged in
    // ...
}

// ...
?>


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
  
    <!-- Bootstrap CSS -->
  
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS-->


    <!-- Vendor CSS-->
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
 
   

</head>

  
<body class="animsition ">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop d-none d-lg-block p-md-3" >
    <div class="section__content section__content--p35">
        <div class="header3-wrap">
            <a href="#">
                <img class="img-cir logo-desktop"src="/img/logo.png" alt="Airputih" />
            </a>
            <div class="header__navbar">
                <ul class="list-unstyled">
                    <li class="has-sub">
                        <a href="#album">
                            <i class="fas fa-image text-dark"> Album</i>
                        </a>   
                    </li>
                    <li>
                        <a href="#member">
                            <i class="fas fa-child text-dark"> Members</i>
                        </a>
                    </li>
                    <li>
                        <a href="#event">
                            <i class="fas fa-trophy text-dark"> Events</i>
                        </a>
                    </li>
                </ul>
            </div>
                
            <div class="account-wrap">
                <div class="account-item account-item--style2 clearfix js-item-menu">
                    <div class="image">
                        <img src="" alt="User Photo">
                    </div>
                    <div class="content">
                        <?php if ($isLoggedIn): ?>
                            <a class="js-acc-btn" href="#"><?= $userName ?></a>
                        <?php else: ?>
                            <a class="js-acc-btn" href="login.php">Login</a>
                        <?php endif; ?>
                    </div>
                    <div class="account-dropdown js-dropdown">
                        <div class="info clearfix">
                            <div class="image">
                                <a href="#">
                                    <img src="" alt="User Photo">
                                </a>
                            </div>
                            <div class="content">
                                <h5 class="name">
                                    <a href="#"></a>
                                </h5>
                                <span class="email"></span>
                            </div>
                        </div>
                    
                        <div class="account-dropdown__body">
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-account"></i>Account</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                            </div>
                            <div class="account-dropdown__item">
                                <a href="#">
                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                            </div>
                        </div>
                        <div class="account-dropdown__footer">
                            <a href="logout.php">
                                <i class="zmdi zmdi-power"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
        <!-- END HEADER DESKTOP-->

           
        <!-- HEADER MOBILE-->
       
        <header class="header-mobile header-mobile-2 d-block d-lg-none">
           
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                       
  <img src="/img/logo.png" alt="Logo" class="logos">

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
                       <li>
                            <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                             
                            <div class="image" style="width: 25px; height: auto; margin-left: 20px; margin-top: 17px;">
                                <img src="" alt="User Photo">
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#"></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image ">
                                                 <img src="" alt="User Photo">
                                        </div>
                                        <div class="content">
                                            <div class="name">
                                           
                                            <div class="email"></div>
                                        </div></div>
                                        <div class="account-dropdown__body">
                                        </div>
                                        <div class="account-dropdown__item">
                                                <i class="zmdi zmdi-settings"></i> Settings
                                    </div>

                                </div>
                            </div>
                             
                        </div>
                            </div>
                             </li>
                        <li>
                            <a href="#album">
                                <i class="ml-2 fa fa-photo"></i>Album</a>
                        </li>
                        <li>
                            <a href="#member">
                                <i class="ml-2 fa fa-group"></i>Member</a>
                        </li>
                        <li>
                            <a href="#event">
                                <i class="ml-2 fa fa-gamepad"></i>Event</a>
                        </li>
                        <li>
                            <a href="#about">
                                <i class="ml-3 fa fa-info"></i>About</a>
                        </li>
                        <li>
                            <a href="login/logout.php">
                                <i class="ml-2 fa fa-power-off"></i>Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>


        </header>
         
        <!-- END HEADER MOBILE -->



    <!--{Penting}-->
    <script src="/vendor/jquery-3.2.1.min.js"></script>
    <script src="/vendor/animsition/animsition.min.js"></script>
    <script src="/js/main.js"></script>
   

    
    <script type="text/javascript">
  var header = document.querySelector('.header-desktop');
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
        for (var i = 0; i < isis.length; i++) {
          isis[i].classList.remove('text-dark');
        }
      } else {
        header.style.backgroundColor = 'transparent';
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

<script>function toggleNavbarCard() {
  var navbarCard = document.getElementById("navbarCard");
  navbarCard.style.display = navbarCard.style.display === "block" ? "none" : "block";
}
</script>