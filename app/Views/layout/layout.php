<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- My CSS -->
    <script src="/vendor/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link href="/css/style.css" rel="stylesheet" media="all">
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
                <img src="/img/layout/whatsapp.png" alt="WhatsApp">
            </a>
            <div class="whatsapp-tooltip">Hubungi Kami!</div>
        </div>
    </footer>

    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>