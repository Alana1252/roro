<!-- tiket_view.php -->
<?php
// Memeriksa apakah modal harus ditampilkan
if ($showModal) {
    echo view('layout/modal');
}
?>
<?php
$auth = service('authentication');
$isLoggedIn = $auth->check();
$user = $auth->user();
?>
<!DOCTYPE html>
<html>


<head>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link href="/css/style.css" rel="stylesheet" media="all">
    <?= $this->include('layout/modal'); ?>

</head>


<body>
    <?php if (!$isLoggedIn || $showModal) : ?>
        <script>
            $(document).ready(function() {
                $('#loginModal').modal('show');
            });
        </script>
    <?php endif; ?>
    <?php if ($isLoggedIn) : ?>
        <?= $this->include('layout/sidebar'); ?>
        <div class="card-caritiket" id="geser" style="margin-left: 350px;">
            <div class="ticket-align">
                <form action="<?= site_url('tiket/search'); ?>" method="get">
                    <div class="caritiket-title pt-1">Cari Tiket Anda</div>
                    <div class="caritiket-title2 selectpicker">Atur Jadwal Kedatangan Anda di Pelabuhan</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div for="Penumpang" class="text-input">Jumlah Penumpang:</div>
                                <input id="pilih-penumpang" onclick="showFloatingCard()" class="select-icon-tiket" readonly placeholder="Jumlah Penumpang" style="background-size:14px 14px; background-image: url('/img/userkelompok.png');" required>
                                <div id="floating-card" class="floating-card">
                                    <div class="form-group card-penumpang">
                                        <label for="dewasa">Dewasa<a class="font-abu"> / </a>Anak</label>
                                        <div class="text-penumpang">Usia 2 tahun atau lebih</div>
                                        <button class="btn-penumpangKurang" type="button" onclick="decrement('dewasa')">-</button>
                                        <input class="penumpang" id="dewasa" min="0" max="9" value="0" readonly>
                                        <button class="btn-penumpangTambah" type="button" onclick="increment('dewasa')">+</button>

                                    </div>
                                    <div class="form-group card-penumpang">
                                        <label for="bayi">Bayi</label>
                                        <div class="text-penumpang1">Usia 2 tahun atau kurang</div>
                                        <button class="btn-penumpangKurang" type="button" onclick="decrement('bayi')">-</button>
                                        <input class="penumpang" id="bayi" min="0" max="9" value="0" readonly>
                                        <button class="btn-penumpangTambah" type="button" onclick="increment('bayi')">+</button>
                                    </div>
                                    <button class="button-pilih" onclick="handlePilihPenumpang()">Tambah</button>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div for="asal" class="text-input">Pelabuhan Asal:</div>
                                <select id="asal" name="asal" class="select-icon-tiket" style="background-image: url('/img/ship.png');" required>
                                    <option disabled selected value="">Pilih Asal</option>
                                    <option value="2">Air Putih</option>
                                    <option value="1">Sungai Selari</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div for="tanggal" class="text-input">Tanggal Keberangkatan:</div>
                                <input type="text" id="tanggal" placeholder="Pilih Tanggal" class="select-icon-tiket" style="background-size: 14px 14px; background-image: url('/img/calendar.png');" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div for="layanan" class="text-input">Jenis Penggunaan Jasa:</div>
                                <input id="pilih-kendaraan" onclick="showFloatingKendaraan()" readonly placeholder="Berkendara atau tidak" class="select-icon-tiket" style="background-image: url('/img/car.png');" required>
                                <div id="floatingKendaraan">
                                    <div id="modeSelection" style="display: flex; flex-direction: column; align-items: center;">
                                        <div class="text-left">Jenis Penggunaan Jasa </div>
                                        <div class="card-kendaraan" onclick="selectMode('pejalan_kaki')">Pejalan Kaki
                                            <div class="lingkaran-kecil">
                                                <div id="pejalanKakiBtn"></div>
                                            </div>
                                        </div>
                                        <div class="card-kendaraan" onclick="selectMode('kendaraan')">Kendaraan
                                            <div class="lingkaran-kecil" style="margin-left: 55%;">
                                                <div id="kendaraanBtn"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cardContainer">
                                        <div id="kendaraanCard">
                                            <div class="text-left">
                                                <i class="fa fa-chevron-circle-left back-icon mr-5" onclick="goBack()"></i>
                                                Golongan Kendaraan
                                            </div>
                                            <div id="golonganContainer" style="display: none;">
                                                <div class="card-kendaraan1" onclick="selectGolongan(1)">Golongan I
                                                    <div class="lingkaran-kecil" style="margin-left: 68%;">
                                                        <div id="golongan1Btn">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-kendaraan1" onclick="selectGolongan(2)">Golongan II
                                                <div class="lingkaran-kecil" style="margin-left: 67%;">
                                                    <div id="golongan2Btn">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-kendaraan1" onclick="selectGolongan(3)">Golongan III
                                                <div class="lingkaran-kecil" style="margin-left: 65%;">
                                                    <div id="golongan3Btn">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div for="tujuan" class="text-input">Pelabuhan Tujuan:<a>
                                        <img src="/img/repeat.png" class="image-tiket" alt="Gambar">
                                    </a>
                                </div>
                                <select id="tujuan" name="tujuan" class="select-icon-tiket" style="background-image: url('/img/ship2.png');" required>
                                    <option disabled selected value="">Pilih Tujuan</option>
                                    <option value="1">Sungai Selari</option>
                                    <option value="2">Air Putih</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <div for="Kelas" class="text-input">Kelas:</div>
                                <select id="kelas" name="kelas" class="select-icon-tiket" style="background-size: 16px 16px; background-image: url('/img/kelas.png');" required readonly>
                                    <option value="Ekonomi">Ekonomi</option>
                                    <option value="Premium">Premium</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><button type="submit" class="button-cari">Cari</button></div>
                        </div>
                    </div>
                    <input name="kouta_kendaraan" id="koutaKendaraanValue" hidden required></input>
                    <input type="number" name="kouta_penumpang" required hidden>
                    <input type="hidden" id="hiddenTanggal" name="tanggal" required>
                </form>
            </div>
        </div>

        <?php if (!empty($tikets)) : ?>
            <?php foreach ($tikets as $index => $tiket) : ?>
                <div class="card-tiket geser<?= $index ?>" style="margin-left: 350px;">
                    <div class="layanan-tiket">
                        <img class="logo-tiket" src="/img/logo2.png" alt="Airputih" />
                        <div class="card-kapal">
                            <?= $kapalModel->getKapalName($tiket['kapal']); ?>
                        </div>
                        <div class="tanggal-tiket">
                            <?= $tiket['tanggal_formatted']; ?>
                        </div>
                    </div>
                    <div class="card-jam">
                        <div class="card-keberangkatan">
                            <?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?>
                        </div>
                        <div class="garis-horizontal">
                            <span class="kelas-text"><?= $tiket['kelas'] ?? 'Kelas'; ?></span>
                        </div>
                        <div class="card-tiba">
                            <?= $jamModel->getJamTiba($tiket['tiba']); ?>
                        </div>
                        <div class="tiket-harga">Rp.<?= isset($harga) ? $harga : '10.000'; ?></div>
                        <div class="tiket-harga2">/orang</div>
                    </div>
                    <div class="card-lokasi">
                        <div class="card-asal">
                            <?= $lokasiModel->getAsal($tiket['asal']); ?>
                        </div>
                        <div class="card-tujuan">
                            <?= $lokasiModel->getTujuan($tiket['tujuan']); ?>
                        </div>
                        <?php if ($tiket['kouta_kendaraan'] < $kouta_kendaraan || $tiket['kouta_penumpang'] < $kouta_penumpang) : ?>
                            <div class="button-habis">
                                Habis
                            </div>
                        <?php else : ?>
                            <form action="<?= site_url('select-ticket'); ?>" method="post">
                                <input type="hidden" name="tiket_id" value="<?= $tiket['id_tiket']; ?>">
                                <button type="submit" class="button-pilih">Pilih Tiket</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="no-tiket">
                Tidak ada tiket yang sesuai dengan pencarian Anda.
            </div>
        <?php endif; ?>
    <?php else : ?>
    <?php endif; ?>

    <script src="<?= base_url('js/script.js') ?>"></script>

</body>

</html>