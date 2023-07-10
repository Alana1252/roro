<?php foreach ($tiket as $tiket) : ?>
    <div class="modal fade" id="editModal<?= $tiket->idtiket; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $tiket->idtiket; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $tiket->idtiket; ?>">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('tiket/edit/' . $tiket->idtiket); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row g-2 mb-3">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="id_tiket" value="<?= $tiket->idtiket; ?>" readonly>
                                    <label for="floatingInput">ID Tiket</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="floatingInput" name="kouta_penumpang" value="<?= $tiket->koutapenumpang; ?>">
                                    <label for="floatingInput">Sisa Tiket</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="tanggal" value=" <?= $tiket->tanggal; ?>" readonly>
                            <label for="floatingInput">Tanggal</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select" name="kapal">
                                <?php foreach ($kapalData as $kapal) : ?>
                                    <option value="<?= $kapal->id_kapal; ?>"><?= $kapal->kapal; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="floatingSelectGrid">Penyedia Layanan</label>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGridAsal" aria-label="Floating label select" name="asal">
                                        <option selected value="<?= $tiket->value_asal; ?>"><?= $tiket->tiket_asal; ?></option>
                                        <?php if ($tiket->tiket_asal != 'Air Putih') : ?>
                                            <option value="2">Air Putih</option>
                                        <?php endif; ?>
                                        <?php if ($tiket->tiket_asal != 'Sungai Selari') : ?>
                                            <option value="1">Sungai Selari</option>
                                        <?php endif; ?>
                                    </select>

                                    <label for="floatingSelectGridAsal">Asal Perjalanan</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGridTujuan" aria-label="Floating label select" name="tujuan">
                                        <option selected value="<?= $tiket->value_tujuan; ?>"><?= $tiket->tiket_tujuan; ?></option>
                                        <?php if ($tiket->tiket_tujuan != 'Air Putih') : ?>
                                            <option value="2">Air Putih</option>
                                        <?php endif; ?>
                                        <?php if ($tiket->tiket_tujuan != 'Sungai Selari') : ?>
                                            <option value="1">Sungai Selari</option>
                                        <?php endif; ?>
                                    </select>
                                    <label for="floatingSelectGridTujuan">Tujuan Perjalanan</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select" name="keberangkatan">
                                        <option selected value="<?= $tiket->tiket_keberangkatan; ?>"><?= date('H:i', strtotime($tiket->jam_keberangkatan)); ?> WIB</option>
                                        <?php foreach ($jamData as $jam) : ?>
                                            <?php if ($jam->id_jam != $tiket->tiket_keberangkatan) : ?>
                                                <option value="<?= $jam->id_jam; ?>"><?= date('H:i', strtotime($jam->keberangkatan)); ?> WIB</option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelectGrid">Jam Keberangkatan</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select" name="tiba">
                                        <option selected value="<?= $tiket->tiket_tiba; ?>"><?= date('H:i', strtotime($tiket->jam_tiba)); ?> WIB</option>
                                        <?php foreach ($jamData as $jam) : ?>
                                            <?php if ($jam->id_jam != $tiket->tiket_tiba) : ?>
                                                <option value="<?= $jam->id_jam; ?>"><?= date('H:i', strtotime($jam->keberangkatan)); ?> WIB</option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="floatingSelectGrid">Jam Tiba</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>




    <!--Modal: modalConfirmDelete-->

    <div class="modal fade" id="modalConfirmDelete<?= $tiket->idtiket; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?= $tiket->idtiket; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <div class="modal-content text-center">
                <!--Header-->
                <div class="modal-header modal-header-danger d-flex justify-content-center bg-danger">
                    <p class="heading text-white">[<?= $tiket->idtiket; ?>]Are you sure?</p>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <i class='fas fa-times animate__animated animate__rotateIn' style='font-size:48px;color:red'></i>
                </div>

                <!--Footer-->
                <div class="modal-footer flex-center">
                    <a href="<?= base_url('tiket/delete/' . $tiket->idtiket) ?>" class="btn btn-outline-danger">Yes</a>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
<?php endforeach ?>


<!--Modal: modalConfirmDeleteAllTiket-->
<div class="modal fade" id="modalConfirmDeleteAll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header modal-header-danger d-flex justify-content-center bg-danger">
                <p class="heading text-white">Delete all ticket?</p>

            </div>

            <!--Body-->
            <div class="modal-body">
                <i class='fas fa-times animate__animated animate__rotateIn' style='font-size:48px;color:red'></i>
            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">
                <a href="/tiket/delete/all" class="btn btn-outline-danger">Yes</a>
                <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">No</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#floatingSelectGridAsal").change(function() {
            var selectedAsal = $(this).val();
            var selectedTujuan = $("#floatingSelectGridTujuan").val();

            // Jika asal perjalanan Air Putih dipilih
            if (selectedAsal == 2) {
                // Set nilai tujuan ke Sungai Selari
                $("#floatingSelectGridTujuan").val(1);
            }
            // Jika asal perjalanan Sungai Selari dipilih
            else if (selectedAsal == 1) {
                // Set nilai tujuan ke Air Putih
                $("#floatingSelectGridTujuan").val(2);
            }
        });

        $("#floatingSelectGridTujuan").change(function() {
            var selectedAsal = $("#floatingSelectGridAsal").val();
            var selectedTujuan = $(this).val();

            // Jika tujuan perjalanan Air Putih dipilih
            if (selectedTujuan == 2) {
                // Set nilai asal ke Sungai Selari
                $("#floatingSelectGridAsal").val(1);
            }
            // Jika tujuan perjalanan Sungai Selari dipilih
            else if (selectedTujuan == 1) {
                // Set nilai asal ke Air Putih
                $("#floatingSelectGridAsal").val(2);
            }
        });
    });
</script>