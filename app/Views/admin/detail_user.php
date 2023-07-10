<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="detailModal<?= $user->userid; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $user->userid; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div><?php if ($user->status === 'Aktif') : ?>
                            <img src="<?= base_url('img/' . $user->user_image) ?>" class="img img-50">
                        <?php endif ?>
                        <h5 class="modal-title" id="detailModalLabel<?= $user->userid; ?>">Detail Pengguna</h5>
                    </div>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi modal dengan detail pengguna -->
                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" value="<?= $user->userid; ?>" readonly>
                                <label for=" floatingInput">User Id</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" value="<?= $user->username; ?>" readonly>
                                <label for=" floatingInput">Username</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input class="bg-white form-control" id="floatingInput" value="<?= $user->email; ?>" readonly>
                        <label for=" floatingInput">Email</label>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white <?= ($user->status == 'Banned') ? 'text-danger' : (($user->status == 'Nonaktif') ? 'text-warning' : ''); ?>" id="floatingInput" value="<?= $user->status; ?>" readonly>
                                <label for=" floatingInput">User Status</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" value="<?= $user->name; ?>" readonly>
                                <label for=" floatingInput">User Role</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->settlement_count; ?>" readonly>
                                <label for=" floatingInput">Tiket Berhasil</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->pending_count; ?>" readonly>
                                <label for=" floatingInput">Tiket Pending</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->created_at; ?>" readonly>
                                <label for=" floatingInput">Dibuat</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating ">
                                <?php if ($user->status === 'Aktif') : ?>
                                    <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->updated_at; ?>" readonly>
                                    <label for=" floatingInput">Diedit</label>
                                <?php elseif ($user->status === 'Nonaktif') : ?>
                                    <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->deleted_at; ?>" readonly>
                                    <label for=" floatingInput">Dihapus</label>
                                <?php elseif ($user->status === 'Banned') : ?>
                                    <input class="form-control bg-white" id="floatingInput" placeholder="<?= $user->updated_at; ?>" readonly>
                                    <label for=" floatingInput">Dibanned</label>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>