<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet" media="all">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body style="background-color:#f1f1f1;">
    <?php if ($order) : ?>
        <div><?= $order['transaction_status']; ?></div>
        <div><?= $order['kouta_penumpang']; ?></div>

        <div>Rp.<?= number_format($order['gross_amount'], 0, ',', '.') ?></div>


        <div class="card-tujuan"><button onclick="showPaymentPopup('<?= $order['snap_token'] ?>')">Pay Now</button></div>

        <div class="card-detail-all">
            <div class="card-detail-isi">
                <div class="fw-bold">Kode Pemesanan</div>
                <div class="detail2"><?= $order['order_id']; ?></div>
                <div class="detail2-kelas fw-bold"><?= $order['kelas']; ?></div>
                <div class="garis-horizontal-detail"></div>
                <img class="logo-detail" src="/img/logo2.png" alt="Logo" />
                <div class="d-flex">
                    <div class="row">
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
                    <div class="row">
                        <div class="detail-kapal">
                            <?= $order['kapal']; ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="row">
                        <div>Nama Penumpang :</div>
                        <div class="kiri-20 fw-bold"><?= nl2br($order['nama_lengkap']) ?></div>
                    </div>
                    <div class="row">
                        <div>Jenis Layanan :</div>
                        <div class="kiri-20 fw-bold mb-5"><?= $order['kouta_kendaraan']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <p>Pesanan tidak ditemukan.</p>
    <?php endif; ?>

</body>

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