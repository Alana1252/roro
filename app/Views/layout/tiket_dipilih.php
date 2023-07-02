<?php if (!empty($tiket)) : ?>
    <div>
        <p>ID Tiket: <?= $tiket['id_tiket']; ?></p>
        <p>Dewasa: <?php echo session('search_data')['kouta_penumpang']; ?></p>
        <p>Kendaraan: <?php echo session('search_data')['kouta_kendaraan']; ?></p>
        <img class="logo-tiket" src="/img/logo2.png" alt="Airputih" />

        <?= $kapalModel->getKapalName($tiket['kapal']); ?>


        <?= $tiket['tanggal_formatted']; ?>



        <?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?>


        <?= $kelas; ?>
        <?= $jamModel->getJamTiba($tiket['tiba']); ?>

        <?= $lokasiModel->getAsal($tiket['asal']); ?>

        <?= $lokasiModel->getTujuan($tiket['tujuan']); ?>

    </div>
<?php else : ?>
    <p>Tidak ada tiket yang dipilih.</p>
<?php endif; ?>