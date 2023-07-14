<style>
    .alert {
        border-radius: 0;
        -webkit-border-radius: 0;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.11);
        display: table;
        min-width: 350px;
        z-index: 100;
    }

    .alert-white {
        background-image: linear-gradient(to bottom, #fff, #f9f9f9);
        border-top-color: #d8d8d8;
        border-bottom-color: #bdbdbd;
        border-left-color: #cacaca;
        border-right-color: #cacaca;
        color: #404040;
        padding-left: 61px;
    }

    .alert-white.rounded {
        border-radius: 3px;
        -webkit-border-radius: 3px;
    }

    .alert-white.rounded .icon {
        position: absolute;
        border-radius: 3px 0 0 3px;
        -webkit-border-radius: 3px 0 0 3px;
    }

    .alert-white .icon {
        text-align: center;
        width: 45px;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border: 1px solid #bdbdbd;
        padding-top: 15px;
    }

    .alert-white .icon:after {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
        display: block;
        content: '';
        width: 10px;
        height: 10px;
        border: 1px solid #bdbdbd;
        position: absolute;
        border-left: 0;
        border-bottom: 0;
        top: 50%;
        right: -6px;
        margin-top: -3px;
        background: #fff;
    }

    .alert-white .icon i {
        font-size: 20px;
        color: #fff;
        left: 12px;
        margin-top: -10px;
        position: absolute;
        top: 50%;
    }

    /*============ colors ========*/
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }

    .alert-white.alert-success .icon,
    .alert-white.alert-success .icon:after {
        border-color: #54a754;
        background: #60c060;
    }

    .alert-info {
        background-color: #d9edf7;
        border-color: #98cce6;
        color: #3a87ad;
    }

    .alert-white.alert-info .icon,
    .alert-white.alert-info .icon:after {
        border-color: #3a8ace;
        background: #4d90fd;
    }


    .alert-white.alert-warning .icon,
    .alert-white.alert-warning .icon:after {
        border-color: #d68000;
        background: #fc9700;
    }

    .alert-warning {
        background-color: #fcf8e3;
        border-color: #f1daab;
        color: #c09853;
    }

    .alert-danger {
        background-color: #f2dede;
        border-color: #e0b1b8;
        color: #b94a48;
    }

    .alert-white.alert-danger .icon,
    .alert-white.alert-danger .icon:after {
        border-color: #ca452e;
        background: #da4932;

    }
</style>
<?php
$auth = service('authentication');
$isLoggedIn = $auth->check();
$user = $auth->user();
?>
<?php if (session()->has('success')) : ?>
    <div class="alert alert-success alert-white rounded animate__animated position-absolute top-0 end-0 m-2 animate__slideInRight" id="successAlert">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <strong class="ml-5">Success!</strong>
        <?= session('success') ?>
    </div>
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('successAlert');
            successAlert.classList.remove('animate__slideInRight');
            successAlert.classList.add('animate__slideOutRight');
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }, 5000);
    </script>
<?php endif; ?>


<?php if (session()->has('error')) : ?>
    <div id="errorAlert" class="alert alert-danger top-0 position-absolute end-0 m-2 animate__animated animate__slideInRight" role="alert" style="max-width: 300px; z-index:500;">
        <?= session('error') ?>
    </div>
    <script>
        setTimeout(function() {
            var errorAlert = document.getElementById('errorAlert');
            errorAlert.classList.remove('animate__slideInRight');
            errorAlert.classList.add('animate__slideOutRight');
            setTimeout(function() {
                errorAlert.style.display = 'none';
            }, 1000);
        }, 5000);
    </script>
<?php endif; ?>
<?php if (in_groups('admin') && !session()->get('adminLoggedIn')) : ?>
    <div class="alert alert-success alert-white rounded animate__animated position-absolute end-0 m-5 animate__slideInRight" id="alertAdmin" style="right: 0;">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <strong class="ml-5">Welcome <?= $user->username ?>!</strong>
        Kamu login sebagai Admin.
    </div>
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('alertAdmin');
            successAlert.classList.remove('animate__slideInRight');
            successAlert.classList.add('animate__slideOutRight');
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }, 5000);
    </script>
    <?php
    // Set session adminLoggedIn to true
    session()->set('adminLoggedIn', true);
    ?>
<?php endif; ?>
<?php if (in_groups('operator') && !session()->get('adminLoggedIn')) : ?>
    <div class="alert alert-success alert-white rounded animate__animated position-absolute end-0 m-3 animate__slideInRight" id="alertAdmin" style="right: 0;">
        <div class="icon">
            <i class="fa fa-check"></i>
        </div>
        <strong class="ml-5">Welcome <?= $user->username ?>!</strong>
        Kamu login sebagai Operator.
    </div>
    <script>
        setTimeout(function() {
            var successAlert = document.getElementById('alertAdmin');
            successAlert.classList.remove('animate__slideInRight');
            successAlert.classList.add('animate__slideOutRight');
            setTimeout(function() {
                successAlert.style.display = 'none';
            }, 2000);
        }, 5000);
    </script>
    <?php
    // Set session adminLoggedIn to true
    session()->set('adminLoggedIn', true);
    ?>
<?php endif; ?>