<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="/css/style.css" rel="stylesheet" media="all">
</head>
<body>
    <?php if (!empty($selectedTiket)): ?>
        <div class="card-tiket">
            <div class="layanan-tiket">
                <img class="logo-tiket" src="/img/logo2.png" alt="Airputih" />
                <div class="card-kapal">
                    <?= $kapalModel->getKapalName($selectedTiket['kapal']); ?>
                </div>
                <div class="tanggal-tiket">
                    <?= $selectedTiket['tanggal_formatted']; ?>
                </div>
            </div>
            <div class="card-jam">
                <div class="card-keberangkatan">
                    <?= $jamModel->getJamKeberangkatan($selectedTiket['keberangkatan']); ?>
                </div>
                <div class="garis-horizontal">
                    <span class="kelas-text"><?= $selectedTiket['kelas'] ?? 'Kelas'; ?></span>
                </div>
                <div class="card-tiba">
                    <?= $jamModel->getJamTiba($selectedTiket['tiba']); ?>
                </div>
                <div class="tiket-harga">Rp.<?= isset($harga) ? $harga : '10.000'; ?></div>
                <div class="tiket-harga2">/orang</div>
            </div>
            <div class="card-lokasi">
                <div class="card-asal">
                    <?= $lokasiModel->getAsal($selectedTiket['asal']); ?>
                </div>
                <div class="card-tujuan">
                    <?= $lokasiModel->getTujuan($selectedTiket['tujuan']); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p>Tidak ada tiket yang dipilih.</p>
    <?php endif; ?>
</body>
</html>
