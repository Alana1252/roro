<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

    <!-- Include jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="/css/style.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <title>Tambah Tiket | Go-RoRo</title>
    <style>
        .slide {
            display: none;
        }
    </style> <?= isset($script) ? $script : '' ?>
</head>

<body style="background-color:#f1f1f1;"><!-- Formulir -->
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>Detail Pesanan Anda</strong></h2>
                    <p>Perhatikan dan isi data dengan baik.</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform" onsubmit="event.preventDefault();">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="tiket"><strong>Tiket</strong></li>
                                    <li id="personal"><strong>Personal</strong></li>
                                    <li id="payment"><strong>Payment</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="slide" id="slide1">
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Personal Information</h2>
                                            <div><?= $this->include('layout/tiket_dipilih'); ?></div>
                                        </div>
                                        <a href="/tiket"><button class="btn btn-warning"><i class="bi bi-caret-left-fill"></i> Cancel</button></a>
                                        <button class="btn btn-success" onclick="nextSlide()">Next <i class="bi bi-caret-right-fill"></i></button>
                                    </fieldset>
                                </div>
                                <div class="slide" id="slide2">
                                    <fieldset>
                                        <div class="form-card">
                                            <h2 class="fs-title">Personal Information</h2>
                                            <div id="nameInputs"></div>
                                        </div>
                                        <button class="btn btn-warning" onclick="previousSlide()"><i class="bi bi-caret-left-fill"></i> Previous</button>
                                        <button class="btn btn-success" onclick="nextSlide()">Next <i class="bi bi-caret-right-fill"></i></button>
                                    </fieldset>
                                </div>
                                <div class="slide" id="slide3">
                                    <fieldset>
                                        <div class="detail-form">
                                            <P>KONFIRMASI DETAIL PESANAN ANDA</P>
                                            <div class="row detail-form-isi1">
                                                <div class="col">
                                                    <div class="">Nama Penumpang :</div>
                                                    <div id="result"></div>
                                                </div>
                                                <div class="col">
                                                    <div>Tanggal</div>
                                                    <div>Kelas</div>
                                                    <div>Jumlah Penumpang</div>
                                                    <div>Penggunaan Jasa</div>
                                                    <div>Jam Keberangkatan</div>
                                                    <div>Keberangkatan</div>
                                                </div>
                                                <div class="col">
                                                    <div>: <?= substr($tiket['tanggal_formatted'], strpos($tiket['tanggal_formatted'], ',') + 2); ?></div>
                                                    <div>: <?= $kelas; ?></div>
                                                    <div>: <?php echo session('search_data')['kouta_penumpang']; ?></div>
                                                    <div>: <?php echo $jenisKendaraan; ?></div>
                                                    <div>: <?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?></div>
                                                    <div>: <?= $lokasiModel->getAsal($tiket['asal']); ?></div>
                                                </div>
                                            </div>
                                            <div class="row detail-form-isi2">
                                                <div class="col">
                                                    <div class="">Metode Pembayaran</div>
                                                    <div class="card mscard" id="pay-button" style="max-width: 18rem;">
                                                        <img src="/img/layout/bankpng.png" alt="bank" style="height: 25px; width:100px; ">
                                                        <div class="card-body ">
                                                            <p class="card-text fw-bold" style="position: absolute; top:35%;">Rp.<?php echo number_format($jumlahHarga, 0, ',', '.'); ?></p>
                                                            <div class="card-footer bg-transparent" style="position: absolute; top:70%; width:110px;"></div>
                                                        </div>
                                                        <div class="ml-4">TEST</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <?php if ($idKendaraan != 0) : ?>
                                                        <div><?php echo $jenisKendaraan; ?></div>
                                                    <?php endif; ?>
                                                    <div>Biaya asuransi</div>
                                                    <div>Tiket <?= $kelas; ?></div>
                                                    <p></p>
                                                    <div class="pt-5">Total Harga</div>
                                                </div>
                                                <div class="col">
                                                    <?php if ($idKendaraan != 0) : ?>
                                                        <div>: Rp.<?= number_format($hargaKendaraan, 0, ',', '.'); ?></div>
                                                    <?php endif; ?>
                                                    <div>: Rp.1.500</div>
                                                    <div>: Rp.<?php echo number_format($harga, 0, ',', '.'); ?> x <?php echo session('search_data')['kouta_penumpang']; ?></div>
                                                    <div>: Rp.<?php echo number_format($hargaPenumpang, 0, ',', '.'); ?></div>
                                                    <div class="garis-putih"></div>
                                                    <div class="pt-2">: Rp.<?php echo number_format($jumlahHarga, 0, ',', '.'); ?></div>

                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-warning" onclick="previousSlide()"><i class="bi bi-caret-left-fill"></i> Previous</button>
                                        <button class="btn btn-success" onclick="nextSlide()">Next <i class="bi bi-caret-right-fill"></i></button>
                                    </fieldset>
                                </div>
                                <div class="slide" id="slide4">
                                    <fieldset>
                                        <h2>Slide 4</h2>
                                        <p>Success!</p>

                                    </fieldset>
                                </div>
                                <input type="hidden" name="snap_token" value="<?= $snapToken ?>">
                                <input type="hidden" name="kouta_kendaraan" value="<?php echo session('search_data')['kouta_kendaraan']; ?>">
                                <input type="hidden" name="kouta_penumpang" value="<?php echo session('search_data')['kouta_penumpang']; ?>">
                                <input type="hidden" name="kelas" value="<?php echo session('search_data')['kelas']; ?>">
                                <input type="hidden" name="id_tiket" value="<?= $tiket['id_tiket']; ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<html>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
<script type="text/javascript">
    let isPaymentResultAdded = false; // Tambahkan variabel ini di luar fungsi
    document.getElementById('pay-button').onclick = function() {
        // SnapToken acquired from previous step
        snap.pay('<?= $snapToken ?>', {
            // ...
            onSuccess: function(result) {
                tambahPaymentResult(result);
                setTimeout(function() {
                    isPaymentResultAdded = true; // Setelah 3 detik, set isPaymentResultAdded menjadi true
                }, 3000);
            },
            onPending: function(result) {
                tambahPaymentResult(result);
                setTimeout(function() {
                    isPaymentResultAdded = true; // Setelah 3 detik, set isPaymentResultAdded menjadi true
                }, 3000);
            },
            onError: function(result) {
                handlePaymentResult(result);
                setTimeout(function() {
                    isPaymentResultAdded = true; // Setelah 3 detik, set isPaymentResultAdded menjadi true
                }, 3000);
            }
        });
    }

    function tambahPaymentResult(result) {
        // Kirim data hasil pembayaran menggunakan metode AJAX
        fetch('/tambah/tambahPaymentResult', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(result)
            })
            .then(response => response.text())
            .then(data => {
                // Tampilkan hasil pembayaran di dalam <pre> tag
                document.getElementById('result-json').innerHTML = data;
            })
            .catch(error => {

            });
    }
</script>



<script>
    let currentSlide = 1;
    const formWizard = document.getElementById('formWizard');
    const nameInputsContainer = document.getElementById('nameInputs');
    const nameInputs = document.querySelectorAll('#nameInputs input');
    const resultContainer = document.getElementById('result');
    const personalIcon = document.getElementById('personal');
    const paymentIcon = document.getElementById('payment');
    const confirmIcon = document.getElementById('confirm');
    const names = [];

    function showSlide(slideNumber) {
        const slides = document.getElementsByClassName('slide');
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = 'none';
        }
        slides[slideNumber - 1].style.display = 'block';
    }

    function createNameInputs() {
        const koutaPenumpang = <?php echo json_encode(session('search_data')['kouta_penumpang']); ?>;

        if (nameInputsContainer.children.length === 0) {
            for (let i = 0; i < koutaPenumpang; i++) {
                const nameLabel = document.createElement('label');
                nameLabel.textContent = `Nama Panjang Penumpang ${i + 1}:`;

                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.required = true;
                nameInput.id = `name${i + 1}`;
                nameInput.name = `names[${i}]`;

                nameInputsContainer.appendChild(nameLabel);
                nameInputsContainer.appendChild(nameInput);
                nameInputsContainer.appendChild(document.createElement('br'));
            }
        }
    }

    function collectNames() {
        const koutaPenumpang = <?php echo json_encode(session('search_data')['kouta_penumpang']); ?>;

        names.length = 0;
        for (let i = 0; i < koutaPenumpang; i++) {
            const nameInput = document.getElementById(`name${i + 1}`);
            names.push(nameInput.value);
        }
    }

    function displayResult() {
        resultContainer.innerHTML = '';
        const resultList = document.createElement('ul');

        names.forEach(name => {
            const listItem = document.createElement('li');
            listItem.textContent = name;
            resultList.appendChild(listItem);
        });

        resultContainer.appendChild(resultList);
    }

    function addDataToTable() {
        $(document).ready(function() {
            $('#msform').on('submit', function(e) {
                e.preventDefault();

                // Mengambil data form
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '/tambah/update_payment',
                    data: formData,
                    success: function(response) {
                        // Handle the success response here, if needed
                        // For example, you can display a success message or perform any additional actions

                    },
                    error: function(xhr, status, error) {
                        // Handle the error response here, if needed
                        // For example, you can display an error message or perform any error handling
                    }
                });
            });
        });
    }

    function nextSlide() {
        if (currentSlide === 1) {
            currentSlide++;
            showSlide(currentSlide);
            createNameInputs();
            personalIcon.classList.add('active');
        } else if (currentSlide === 2) {
            const nameInputs = document.querySelectorAll('#nameInputs input');
            let allInputsFilled = true;

            nameInputs.forEach(input => {
                if (input.value.trim() === '') {
                    allInputsFilled = false;
                    input.classList.add('error');
                } else {
                    input.classList.remove('error');
                }
            });

            if (allInputsFilled) {
                currentSlide++;
                showSlide(currentSlide);
                collectNames();
                displayResult();
                addDataToTable();
                paymentIcon.classList.add('active');
            } else {
                alert('Please fill in all the name fields.');
            }
        } else if (currentSlide === 3) {
            if (isPaymentResultAdded) { // Periksa apakah isPaymentResultAdded bernilai true sebelum melanjutkan ke slide berikutnya
                collectNames();
                displayResult();
                currentSlide++;
                showSlide(currentSlide);
                confirmIcon.classList.add('active');
            } else {
                alert('Please complete the payment before proceeding.'); // Tampilkan pesan kesalahan jika tambahPaymentResult belum dijalankan atau belum menghasilkan hasil
            }
        }
    }

    function previousSlide() {
        if (currentSlide === 4) {
            currentSlide--;
            showSlide(currentSlide);
            confirmIcon.classList.remove('active');
        } else if (currentSlide === 3) {
            currentSlide--;
            showSlide(currentSlide);
            paymentIcon.classList.remove('active');
        } else if (currentSlide === 2) {
            currentSlide--;
            showSlide(currentSlide);
            personalIcon.classList.remove('active');
        }
    }

    showSlide(currentSlide);
</script>


</body>

</html>