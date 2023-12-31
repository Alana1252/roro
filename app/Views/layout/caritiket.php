<div class="container mt-4">
    <div class="card-container-cari">
        <div class="card-cari">
            <div class="card-body">
                <form action="<?= site_url('tiket/search'); ?>" method="get">
                    <div class="caritiket-title pt-1">Cari Tiket Anda</div>
                    <div class="caritiket-title2 selectpicker">Atur Jadwal Kedatangan Anda di Pelabuhan</div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div for="Penumpang" class="text-input">Jumlah Penumpang:</div>
                                <input id="pilih-penumpang" onclick="showFloatingCard()" class="select-icon-tiket input-tiket" readonly placeholder="Jumlah Penumpang" style="background-size:14px 14px; background-image: url('/img/layout/userkelompok.png');" required>
                                <div id="floating-card" class="floating-card">
                                    <div class="form-group card-penumpang">
                                        <label for="dewasa">Dewasa<a class="font-abu"> / </a>Anak</label>
                                        <div class="text-penumpang">Usia 2 tahun atau lebih</div>
                                        <button class="btn-penumpangKurang" type="button" onclick="decrement('dewasa')">-</button>
                                        <input class="penumpang " id="dewasa" min="0" max="9" value="0" readonly>
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
                                <select id="asal" name="asal" class="select-icon-tiket select-tiket" style="background-image: url('/img/layout/ship.png');" required>
                                    <option disabled selected value="">Pilih Asal</option>
                                    <option value="2">Air Putih</option>
                                    <option value="1">Sungai Selari</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div for="tanggal" class="text-input">Tanggal Keberangkatan:</div>
                                <input type="text" id="tanggal" placeholder="Pilih Tanggal" class="select-icon-tiket input-tiket" style="background-size: 14px 14px; background-image: url('/img/layout/calendar.png');" required readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div for="layanan" class="text-input">Jenis Penggunaan Jasa:</div>
                                <input id="pilih-kendaraan" onclick="showFloatingKendaraan()" readonly placeholder="Berkendara atau tidak" class="select-icon-tiket input-tiket" style="background-image: url('/img/layout/car.png');" required>
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
                                        <img src="/img/layout/repeat.png" class="image-tiket" alt="Gambar">
                                    </a>
                                </div>
                                <select id="tujuan" name="tujuan" class="select-icon-tiket select-tiket" style="background-image: url('/img/layout/ship2.png');" required>
                                    <option disabled selected value="">Pilih Tujuan</option>
                                    <option value="1">Sungai Selari</option>
                                    <option value="2">Air Putih</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <div for="Kelas" class="text-input">Kelas:</div>
                                <select id="kelas" name="kelas" class="select-icon-tiket select-tiket" style="background-size: 16px 16px; background-image: url('/img/layout/kelas.png');" required readonly>
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
    </div>
</div>