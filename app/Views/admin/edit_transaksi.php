<?php foreach ($transaksi as $row) : ?>
    <div class="modal fade" id="editModal<?= $row->order_id; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $row->order_id; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $row->order_id; ?>">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('transaksi/edit/' . $row->order_id); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <?php for ($i = 1; $i <= $row->kouta_penumpang; $i++) : ?>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="nama_penumpang_<?= $i ?>" name="nama_lengkap[]" required value="<?= isset($row->input_nama_lengkap[$i - 1]) ? $row->input_nama_lengkap[$i - 1] : '' ?>">
                                <label for="nama_penumpang_<?= $i ?>">Nama Penumpang <?= $i ?></label>
                            </div>
                        <?php endfor; ?>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="transaction_status">
                                        <option value="settlement" <?= ($row->transaction_status == 'settlement') ? 'selected' : ''; ?>>Telah Dibayar</option>
                                        <option value="pending" <?= ($row->transaction_status == 'pending') ? 'selected' : ''; ?>>Menunggu</option>
                                        <option value="expird" <?= ($row->transaction_status == 'expird') ? 'selected' : ''; ?>>Tidak Berlaku</option>
                                    </select>
                                    <label for="floatingSelect">Status Transaksi</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="kouta_kendaraan">
                                        <option value="0" <?= ($row->kouta_kendaraan == '0') ? 'selected' : ''; ?>>Pejalan Kaki</option>
                                        <option value="2" <?= ($row->kouta_kendaraan == '2') ? 'selected' : ''; ?>>Golongan I</option>
                                        <option value="10" <?= ($row->kouta_kendaraan == '10') ? 'selected' : ''; ?>>Golongan II</option>
                                        <option value="15" <?= ($row->kouta_kendaraan == '15') ? 'selected' : ''; ?>>Golongan III</option>
                                    </select>
                                    <label for="floatingSelect">Status Transaksi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="kelas">
                                        <option value="Ekonomi" <?= ($row->kelas == 'Ekonomi') ? 'selected' : ''; ?>>Ekonomi</option>
                                        <option value="Premium" <?= ($row->kelas == 'Premium') ? 'selected' : ''; ?>>Premium</option>
                                    </select>
                                    <label for="floatingInput">Kelas</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="payment_method">
                                        <option value="M" <?= ($row->payment_method == 'M') ? 'selected' : ''; ?>>Midtrans</option>
                                        <option value="C" <?= ($row->payment_method == 'C') ? 'selected' : ''; ?>>Cash</option>
                                    </select>
                                    <label for="floatingSelect">Status Transaksi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal: modalConfirmDelete-->

    <div class="modal fade" id="modalConfirmDelete<?= $row->order_id; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $row->order_id; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header modal-header-danger d-flex justify-content-center bg-danger">
                    <p class="heading text-white">[<?= $row->order_id; ?>]Are you sure?</p>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <i class='fas fa-times animate__animated animate__rotateIn' style='font-size:48px;color:red'></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <a href="<?= base_url('transaksi/delete/' . $row->order_id) ?>" class="btn btn-outline-danger">Yes</a>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
<?php endforeach ?>
<script>
    var koutaPenumpang = <?= $row->kouta_penumpang ?>;

    for (var i = 1; i <= koutaPenumpang; i++) {

        var label = document.createElement("label");
        label.htmlFor = "nama_penumpang_" + i;
        label.innerText = "Nama Penumpang " + i;

        var div = document.createElement("div");
        div.className = "form-floating mb-2";
        div.appendChild(input);
        div.appendChild(label);

        document.getElementById("nama_penumpang_container").appendChild(div);
    }
</script>