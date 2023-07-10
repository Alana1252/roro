<?php foreach ($tiket as $tiket) : ?>
    <div class="modal fade" id="detailModal<?= $tiket->idtiket; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $tiket->idtiket; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="detailModalLabel<?= $tiket->idtiket; ?>">Detail Pengguna</h5>
                    </div>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="col-md-5">Id Tiket</label>
                        <span class="col-md-8">: <?= $tiket->idtiket; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Tanggal</label>
                        <span class="col-md-8">: <?= $tiket->tanggal; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Penyedia Layanan</label>
                        <span class="col-md-8">: <?= $tiket->kapal; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Asal -> Tujuan</label>
                        <span class="col-md-8">: <?= $tiket->tiket_asal; ?> -> <?= $tiket->tiket_tujuan; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Berangkat -> Tiba</label>
                        <span class="col-md-8">: <?= date('H:i', strtotime($tiket->jam_keberangkatan)); ?> -> <?= date('H:i', strtotime($tiket->jam_tiba)); ?> WIB</span>
                    </div>
                    <div>
                        <label class="col-md-5">Sisa Tiket</label>
                        <span class="col-md-8">: <?= $tiket->koutapenumpang; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Tiket Terjual</label>
                        <span class="col-md-8">: <?= $tiket->tiket_terjual; ?></span>
                    </div>
                    <div>
                        <label class="col-md-5">Tiket Pending</label>
                        <span class="col-md-8">: <?= $tiket->tiket_pending; ?></span>
                    </div>

                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>