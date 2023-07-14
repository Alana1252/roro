<?php foreach ($transaksi as $row) : ?>
    <div class="modal fade" id="detailModal<?= $row->order_id; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $row->order_id; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="detailModalLabel<?= $row->order_id; ?>">Detail Transaksi</h5>
                    </div>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="col-md-5">Order ID</label>
                        <span class="col-md-8">: <?= $row->order_id ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Tiket ID</label>
                        <span class="col-md-8">: <?= $row->idtiket; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Nama Pemesan</label>
                        <span class="col-md-8">: <?= $row->username ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Asal -> Tujuan</label>
                        <span class="col-md-8">: <?= $row->asal; ?> -> <?= $row->tujuan; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Berangkat -> Tiba</label>
                        <span class="col-md-8">: <?= date('H:i', strtotime($row->keberangkatan)); ?> -> <?= date('H:i', strtotime($row->tiba)); ?> WIB</span>
                    </div>
                    <div>
                        <label class="col-md-5">Jumlah Penumpang</label>
                        <span class="col-md-8">: <?= $row->kouta_penumpang ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Golongan</label>
                        <span class="col-md-8">: <?= $row->jenis ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Kelas</label>
                        <span class="col-md-8">: <?= $row->kelas ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Jumlah Pembayaran</label>
                        <span class="col-md-8">: <?= $row->gross_amount ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Tipe Pembayaran</label>
                        <span class="col-md-8">
                            <?php if ($row->payment_method === 'M') : ?>
                                : Midtrans
                            <?php elseif ($row->payment_method === 'C') : ?>
                                : Cash
                            <?php else : ?>
                                : Unknown
                            <?php endif; ?>
                        </span>
                    </div>
                    <div>
                        <label class="col-md-5">Waktu Pembayaran</label>
                        <span class="col-md-8">: <?= $row->transaction_time ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Status Pembayaran</label>
                        <span class="col-md-8">: <?= $row->transaction_status ?></span>
                    </div>
                    <div>
                        <?php if (!empty($row->barcode)) : ?>
                            <label class="col-md-5"><img src="/barcode/<?= $row->barcode ?>" alt="Barcode" class="barcode-image"></label>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="col-md-5">Nama Penumpang :</label>
                    </div>
                    <label class="col"><?= $row->nama_lengkap ?></label>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>