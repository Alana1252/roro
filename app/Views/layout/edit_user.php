<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="editModal<?= $user->id; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user->id; ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $user->id; ?>">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('admin/update-user'); ?>" method="post">
                    <div class="modal-body">
                        <p class="mt-1">
                            <label class="label" for="username">Username</label>
                            <input type="text" name="username" id="username" value="<?= $user->username; ?>">
                        </p>
                        <p class="mt-1">
                            <label class="label" for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?= $user->email; ?>">
                        </p>
                        <p class="mt-1">
                        <div class="label" for="status">Status</div>
                        <div class="value">
                            <select class="custom-select" id="inputStatusSelect" name="status">
                                <option value="Aktif" <?= ($user->status == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Nonaktif" <?= ($user->status == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                                <option value="Banned" <?= ($user->status == 'Banned') ? 'selected' : ''; ?>>Banned</option>
                            </select>

                        </div>
                        </p>
                        <p class="mt-1">
                            <label class="label" for="status_message">Reason</label>
                            <input type="text" name="status_message" id="status_message" placeholder="<?= $user->status_message; ?>">
                        </p>
                        <p class="mt-1">
                        <div class="label" for="group">Role</div>
                        <div class="value">
                            <?php foreach ($user->groups as $group) : ?>
                                <?php $groupName = $group['name']; ?>
                                <select class="custom-select" id="inputGroupSelect" name="group">
                                    <option><?= $group['name']; ?></option>
                                    <?php if ($groupName === 'operator') : ?>
                                        <option value="1">user</option>
                                        <option value="2">admin</option>
                                    <?php elseif ($groupName === 'user') : ?>
                                        <option value="3">operator</option>
                                        <option value="2">admin</option>
                                    <?php endif; ?>
                                </select>
                            <?php endforeach; ?>
                        </div>
                        </p>
                        <!-- Tambahkan detail lainnya sesuai kebutuhan -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>