<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- My CSS -->
    <script src="/vendor/jquery-3.2.1.min.js"></script>
    <link href="/css/style.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>

<body style="background-color:#f1f1f1;">
    <header>
        <?= $this->include('layout/navbar'); ?>

        <?= $this->include('layout/carousel'); ?>
        <?= $this->include('layout/caritiket'); ?>
    </header>

    <main>
        <?= $this->include('layout/layanan'); ?>
        <?= $this->renderSection('content') ?>
    </main>

    <footer>
        <?= $this->include('layout/footer'); ?>
        <div class="whatsapp">
            <a href="https://api.whatsapp.com/send?phone=085363534753" target="_blank">
                <img src="/img/whatsapp.png" alt="WhatsApp">
            </a>
            <div class="whatsapp-tooltip">Hubungi Kami!</div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>