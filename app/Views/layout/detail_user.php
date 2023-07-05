<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="detailModal<?= $user->id; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?= $user->id; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <img src="<?= base_url('img/' . $user->user_image) ?>" class="img img-50">
                        <h5 class="modal-title" id="detailModalLabel<?= $user->id; ?>">Detail Pengguna</h5>
                    </div>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi modal dengan detail pengguna -->
                    <p>
                    <div class="label">Id</div>
                    <div class="value">: <?= $user->id; ?></div>
                    </p>
                    <p>
                    <div class="label">Nama</div>
                    <div class="value">: <?= $user->username; ?></div>
                    </p>
                    <p>
                    <div class="label">Email</div>
                    <div class="value">: <?= $user->email; ?></div>
                    </p>
                    <p>
                    <div class="label">Status</div>
                    <div class="value">: <?= $user->status ? $user->status : 'Aktif'; ?></div>
                    </p>
                    <p>
                    <div class="label">Tiket Berhasil</div>
                    <div class="value">: <?= $transactionModel->countSuccessfulTickets($user->id ?? ''); ?></div>
                    </p>
                    <p>
                    <div class="label">Tiket Pending</div>
                    <div class="value">: <?= $transactionModel->countPendingTickets($user->id ?? ''); ?></div>
                    </p>
                    <p>
                        <?php foreach ($user->groups as $group) : ?>
                    <div class="label">Role</div>
                    <div class="value">: <?= $group['name']; ?></div>
                <?php endforeach; ?>
                </p>
                <p>
                <div class="label">Dibuat</div>
                <div class="value">: <?= $user->created_at; ?></div>
                </p>
                <p>
                <div class="label">Diedit</div>
                <div class="value">: <?= $user->updated_at; ?></div>
                </p>
                <!-- Tambahkan detail lainnya sesuai kebutuhan -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>