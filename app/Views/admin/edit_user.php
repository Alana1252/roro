<?php foreach ($users as $user) : ?>
    <div class="modal fade" id="editModal<?= $user->userid; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $user->userid; ?>" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" id="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel<?= $user->userid; ?>">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= site_url('user/edit/' . $user->userid); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-floating mb-2">
                            <input type="username" class="form-control" id="floatingInput" name="username" value="<?= $user->username; ?>">
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" value="<?= $user->email; ?>">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="status">
                                        <option value="Aktif" <?= ($user->status == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Nonaktif" <?= ($user->status == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                                        <option value="Banned" <?= ($user->status == 'Banned') ? 'selected' : ''; ?>>Banned</option>
                                    </select>
                                    <label for="floatingSelect">Account Status</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInput" name="status_message" value="<?= ($user->status_message !== '') ? $user->status_message : ''; ?>" placeholder="<?= ($user->status_message === '') ? 'Placeholder Text' : ''; ?>">
                                    <label for="floatingInput">Reason Status</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="group">
                                        <?php if ($user->name === 'operator') : ?>
                                            <option value="3">Operator</option>
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        <?php elseif ($user->name === 'user') : ?>
                                            <option value="1">User</option>
                                            <option value="3">Operator</option>
                                            <option value="2">Admin</option>
                                        <?php elseif ($user->name === 'admin') : ?>
                                            <option value="2">Admin</option>
                                            <option value="1">User</option>
                                            <option value="3">Operator</option>
                                        <?php endif; ?>
                                    </select>
                                    <label for="floatingSelect">Account Role</label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-white" id="floatingInput" value="<?= $user->userid; ?>" readonly>
                                    <label for=" floatingInput">User Id</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <img id="photo-preview" class="img foto-card mb-2" src="<?= base_url('img/' . $user->user_image) ?>" alt="User Photo">
                            <div class="form-group">
                                <input type="file" id="photo" class="form-control form-control-file" name="photo" onchange="uploadFile(this)">
                            </div>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
<?php endforeach; ?>