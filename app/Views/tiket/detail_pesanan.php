<!DOCTYPE html>
<html>

<head>
    <title>Detail Tiket | Go-RoRo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="/css/style.css" rel="stylesheet" media="all">
</head>
<?= $this->include('layout/sidebar'); ?>

<body style="background-color:#f1f1f1;">
    <?php if ($order) : ?>
        <div class="card-detail-all">
            <div class="card-detail-isi">
                <div class="fw-bold">Kode Pemesanan</div>
                <div class="detail2"><?= $order['order_id']; ?></div>
                <div class="detail2-kelas fw-bold"><?= $order['kelas']; ?></div>
                <div class="garis-horizontal-detail"></div>
                <img class="logo-detail" src="/img/icon/logo.png" alt="Logo" />
                <div class="d-flex">
                    <div class="row ">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Keberangkatan</th>
                                    <th scope="col">Tujuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Waktu</th>
                                    <td> <?= $order['tanggal']; ?>, <?= $order['keberangkatan']; ?> WIB</td>
                                    <td><?= $order['tanggal']; ?>, <?= $order['tiba']; ?> WIB</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat</th>
                                    <td> <?= $order['asal']; ?></td>
                                    <td> <?= $order['tujuan']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php if ($order['transaction_status'] === 'settlement') : ?>
                        <div class="row">
                            <div class="detail-kapal">
                                <?= $order['kapal']; ?>
                            </div>
                            <div>
                                <img class="barcode" src="/barcode/<?php echo $order['barcode']; ?>" alt="Barcode">
                            </div>
                        </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <div>Nama Penumpang :</div>
                        <div class="kiri-20 fw-bold"><?= nl2br($order['nama_lengkap']) ?></div>
                    </div>
                    <div class="row ml-5">
                        <div>Jenis Layanan :</div>
                        <div class="kiri-20 fw-bold mb-5"><?= $order['kouta_kendaraan']; ?></div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($order['transaction_status'] === 'pending') : ?>
                <div class="row kiri-20">
                    <div>Nama Penumpang :
                        <div class="kiri-20 fw-bold"><?= nl2br($order['nama_lengkap']) ?></div>
                    </div>
                </div>
            </div>
            <div class="detail-layanan">Jenis Layanan :
                <div class="kiri-20 fw-bold"><?= $order['kouta_kendaraan']; ?></div>
            </div>
            <div class="detail-kapal2"> <?= $order['kapal']; ?></div>
            <div class="d-flex">
                <div class="row">
                    <div>Cara melakukan pembayaran:
                        <div onclick="openPDF('<?= $order['pdf_url']; ?>')" class="kiri-50 fw-bold pdf-unduh text-decoration-underline">Click untuk mengunduh PDF</div>
                    </div>
                    <div>Lakukan pembayaran sebelum:
                        <div class="kiri-50 fw-bold"><?= $formattedExpiryTime ?> WIB </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="text-center h4">
                        <div class="fw-bold">Rp.<?= number_format($order['gross_amount'], 0, ',', '.') ?></div>
                        <div class="text-warning h6">
                            Menunggu Pembayaran
                        </div>
                        <div class="detail-button" onclick="showPaymentPopup('<?= $order['snap_token'] ?>')">Bayar</div>
                    </div>
                    </figure>
                </div>
            </div>
        <?php endif; ?>
        </div>
        </div>
    <?php else : ?>
        <p>Pesanan tidak ditemukan.</p>
    <?php endif; ?>

</body>

<script>
    function printOrderInfo() {
        window.print();
    }
</script>
<script>
    function openPDF(url) {
        // Open the URL in a new tab or window
        window.open(url, '_blank');
    }
</script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
<script>
    // Fungsi untuk menampilkan pop-up pembayaran Midtrans
    function showPaymentPopup(token) {
        snap.pay(token, {
            onSuccess: function(result) {
                handlePaymentResult(result);
            },
            onPending: function(result) {
                handlePaymentResult(result);
            },
            onError: function(result) {
                handlePaymentResult(result);
            },
            onClose: function() {
                console.log('Payment popup closed');
            }
        });
    }
</script>

</html>