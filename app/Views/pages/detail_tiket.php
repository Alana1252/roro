<h1>Detail Tiket</h1>

<?php if (!empty($tiket)) : ?>
    <p>ID Tiket: <?= $tiket['id_tiket']; ?></p>
    <p>Informasi Tiket:</p>
    <ul>
        <li>Kapal: <?= $kapalModel->getKapalName($tiket['kapal']); ?></li>
        <li>Tanggal: <?= $tiket['tanggal']; ?></li>
        <li>Jam Keberangkatan: <?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?></li>
        <li>Jam Tiba: <?= $jamModel->getJamTiba($tiket['tiba']); ?></li>
        <li>Asal: <?= $lokasiModel->getAsal($tiket['asal']); ?></li>
        <li>Tujuan: <?= $lokasiModel->getTujuan($tiket['tujuan']); ?></li>
        <li>Harga: Rp. <?= $harga; ?> / orang</li>
        <li>Kelas: <?= $kelas; ?></li>
    </ul>
<?php else : ?>
    <p>Tidak ada tiket yang dipilih.</p>
<?php endif; ?>