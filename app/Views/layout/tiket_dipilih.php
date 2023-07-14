<?php if (!empty($tiket)) : ?>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <div>Penumpang Dewasa</div>
                <div>Jenis Layanan</div>
                <div>Kelas</div>
                <div>Kapal</div>
                <div>Tanggal Keberangkatan</div>
                <div>Jam Keberangkatan -> Tiba</div>
                <div>Lokasi Keberangkatan -> Tiba</div>
            </div>
            <div class="col">
                <div> : <strong><?php echo session('search_data')['kouta_penumpang']; ?></strong></div>
                <div> : <strong><?php echo session('search_data')['kouta_kendaraan']; ?></strong></div>
                <div> : <strong><?= $kelas; ?></strong></div>
                <div> : <strong><?= $kapalModel->getKapalName($tiket['kapal']); ?></strong></div>
                <div> : <strong><?= $tiket['tanggal_formatted']; ?></strong></div>
                <div> : <strong><?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?> -> <?= $jamModel->getJamTiba($tiket['tiba']); ?></strong></div>
                <div> : <strong><?= $lokasiModel->getAsal($tiket['asal']); ?> -> <?= $lokasiModel->getTujuan($tiket['tujuan']); ?></strong></div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div>Tidak ada tiket yang dipilih.</div>
<?php endif; ?>