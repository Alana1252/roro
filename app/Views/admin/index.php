<!DOCTYPE html>
<html lang="en">

<head>
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

<body>
    <?= $this->include('layout/sidebar'); ?>
    <?= $this->include('layout/detail_user'); ?>
    <?= $this->include('layout/edit_user'); ?>

    <table class="table table-hover">
        <thead>
            <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Created At</th>
                <th scope="col">Role</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $key => $user) : ?>
                    <tr class="text-center">
                        <th scope="row"><?= $key + 1; ?></th>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->created_at; ?></td>
                        <td>
                            <?php foreach ($user->groups as $group) : ?>
                                <?php $groupName = $group['name']; ?>
                                <div class="<?= ($groupName === 'admin') ? 'admin' : (($groupName === 'operator') ? 'operator' : 'user'); ?>">
                                    <span><?= $groupName; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </td>
                        <td>
                            <?php foreach ($user->groups as $group) : ?>
                                <?php $groupName = $group['name']; ?>
                                <?php if ($groupName === 'admin') : ?>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $user->id; ?>" data-toggle="tooltip" title="Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                <?php elseif ($groupName === 'operator') : ?>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $user->id; ?>" data-toggle="tooltip" title="Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm edit-user" data-toggle="modal" data-target="#editModal<?= $user->id; ?>" data-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($groupName === 'user') : ?>
                                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $user->id; ?>" data-toggle="tooltip" title="Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm edit-user" data-toggle="modal" data-target="#editModal<?= $user->id; ?>" data-toggle="tooltip" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>
</body>

</html>
<script src="<?= base_url('js/script.js') ?>"></script>