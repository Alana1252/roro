<html lang="en">

<head>
    <title>Tiket Saya | Go-RoRo</title>
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
    <?= $this->include('layout/sidebar'); ?>
    <div class="filter-tiketsaya" id="filter-tiketsaya">
        <a href="#Semua" class="text-decoration-none text-dark fw-bold" style="color: gray;" onclick="filterTransactions('all')">Semua</a>
        <i class="fas fa-angle-right"></i>
        <a href="#Success" class="text-decoration-none" style="color: gray;" onclick="filterTransactions('Telah dibayar')">Telah dibayar</a>
        <i class="fas fa-angle-right"></i>
        <a href="#Pending" class="text-decoration-none" style="color: gray;" onclick="filterTransactions('Belum dibayar')">Belum dibayar</a>
    </div>
    <?php foreach ($orderInfos as $orderInfo) : ?>
        <?php if ($orderInfo !== null) : ?>
            <div class="card-tiket" style="margin-left: 20%;">
                <div class="penyedia-layanan">
                    <img class="logo-tiket-saya" src="/img/icon/logo.png" alt="Airputih" />
                    <div class="card-kapal-layanan">
                        <?= $orderInfo['kapal'] ?>
                    </div>

                    <div class="tanggal-tiket-saya">
                        <br><?= $orderInfo['tanggal'] ?></br>
                        <br>Jumlah penumpang: <?= $orderInfo['kouta_penumpang'] ?></br>
                    </div>
                </div>
                <div class="card-jam-saya">
                    <div class="card-keberangkatan-saya">
                        <?= $orderInfo['keberangkatan'] ?>
                    </div>
                    <div class="garis-horizontal-saya">
                        <span class="kelas-text"><?= $orderInfo['kelas'] ?></span>
                    </div>
                    <div class="card-tiba-saya">
                        <?= $orderInfo['tiba'] ?>
                    </div>
                    <div class="jumlah-harga">Rp.<?= number_format($orderInfo['gross_amount'], 0, ',', '.') ?></div>
                </div>
                <div class="card-lokasi-saya">
                    <div class="card-asal-saya">
                        <?= $orderInfo['asal'] ?>
                    </div>
                    <div class="card-tujuan-saya">
                        <?= $orderInfo['tujuan'] ?>
                    </div>

                    <?php if ($orderInfo['transaction_status'] === 'settlement') : ?>
                        <div class="card-detail-saya bg-success">
                            Telah dibayar
                        </div>
                    <?php endif; ?>
                    <?php if ($orderInfo['transaction_status'] === 'pending') : ?>
                        <div class="card-detail-saya bg-warning">
                            Belum dibayar
                        </div>
                    <?php endif; ?>
                    <div class="card-detail-button" onclick="submitForm('<?= site_url('tiket/select-detail'); ?>', '<?= $orderInfo['order_id']; ?>')">
                        <i class=" 	fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="card-tiket">
                <div class="penyedia-layanan">
                    <p>Anda tidak memiliki tiket.</p>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</body>

</html>
<script src="<?= base_url('js/script.js') ?>"></script>
<script>
    function submitForm(action, order_id) {
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', action);

        var hiddenField = document.createElement('input');
        hiddenField.setAttribute('type', 'hidden');
        hiddenField.setAttribute('name', 'order_id');
        hiddenField.setAttribute('value', order_id);

        form.appendChild(hiddenField);
        document.body.appendChild(form);

        form.submit();
    }
</script>
<script>
    function filterTransactions(status) {
        var buttons = document.getElementsByClassName('text-decoration-none');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove('text-dark');
            buttons[i].classList.remove('fw-bold');
        }
        event.target.classList.add('text-dark');
        event.target.classList.add('fw-bold');

        var cards = document.getElementsByClassName('card-tiket');
        for (var i = 0; i < cards.length; i++) {
            var card = cards[i];
            var detail = card.getElementsByClassName('card-detail-saya')[0];

            if (status === 'all') {
                card.style.display = 'block';
            } else {
                if (detail.innerText.includes(status)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        }
    }
</script>