<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/user.css">
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
</head>

<body class="animsition ">
    <input class="menu-icon" type="checkbox" id="menu-icon" name="menu-icon" />
    <label for="menu-icon"></label>
    <nav class="nav">
        <ul class="pt-5">
            <li><a href="/">Home</a></li>
            <li><a href="/tiket">Cari Tiket</a></li>
            <li><a href="/tiket/tiket-saya">Tiket Saya</a></li>
            <li><a href="/live-cctv">Live CCTV</a></li>
            <li><a href="/logout">Logout</a></li>
        </ul>
    </nav>
    <div class="section-center">
        <h1 class="mb-0">Go-RoRo</h1>
    </div>
    <div class="card-container">
        <?php if (!logged_in() || in_groups('user')) : ?>
        <?php elseif (in_groups('admin')) : ?>
            <span class="admin">
                <?php foreach ($groups as $group) : ?>
                    <?= $group->name ?>
                <?php endforeach; ?>
            </span>
        <?php elseif (in_groups('operator')) : ?>
            <span class="operator">
                <?php foreach ($groups as $group) : ?>
                    <?= $group->name ?>
                <?php endforeach; ?>
            </span>
        <?php endif; ?>
        <img class="round" src="<?= base_url('/img/user/' . $user->user_image) ?>" alt="User Image" class="mb-3" width="150" data-toggle="modal" data-target="#uploadImageModal">
        <h3 id="username"><?= $user->username ?> <?php if ($showEditIcon) : ?><i style="font-size: 14px;" id="editUsernameBtn" onclick="editUsername()" class="bi bi-pencil-fill"></i><?php endif; ?></h3>

        <h6><?= $user->email ?></h6>
        <br>
        <div class="buttons">
            <button class="primary">
                <?= $user->status ?>
            </button>
            <button class="primary ghost">
                <?= $user->created_at ?>
            </button>
        </div>
        <div class="information">
            <h6>Information</h6>
            <ul>
                <li>Belum dibayar</li>
                <li><?= $totalPending ?> Tiket</li>
                <li> Rp.<?= number_format($totalGrossPending, 0, ',', '.') ?></li>
                <li>Sudah dibayar</li>
                <li><?= $totalSettlement ?> Tiket</li>
                <li>Rp.<?= number_format($totalGrossSettlement, 0, ',', '.') ?></li>
                <li>Total Transaksi</li>
                <li><?= $totalTransactions ?> Tiket</li>
                <li>Rp.<?= number_format($totalGrossAmount, 0, ',', '.') ?></li>

            </ul>

        </div>
    </div>

    <footer>
        <p>
            <img src="/img/icon/logo.png" alt="logo" style="max-width: 35px;"> Go-RoRo
        </p>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="uploadImageModal" tabindex="-1" role="dialog" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadImageModalLabel">Upload Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= route_to('user.upload_profile_image') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="user_image">Select Image</label>
                            <input type="file" class="form-control-file" id="profileImage" name="profile_image">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="/vendor/animsition/animsition.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        function editUsername() {
            var usernameElement = document.getElementById('username');
            var username = usernameElement.textContent;

            var inputElement = document.createElement('input');
            inputElement.type = 'text';
            inputElement.id = 'usernameInput';
            inputElement.value = username;
            inputElement.classList.add('text-center');

            var parentElement = usernameElement.parentNode;
            parentElement.replaceChild(inputElement, usernameElement);

            inputElement.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    saveUsername();
                }
            });

            inputElement.focus();
        }

        function saveUsername() {
            var inputElement = document.getElementById('usernameInput');
            var newUsername = inputElement.value;

            $.ajax({
                url: '<?= route_to('user.update_username') ?>',
                type: 'POST',
                data: {
                    new_username: newUsername
                },
                success: function(response) {
                    if (response.success) {
                        var usernameElement = document.createElement('h3');
                        usernameElement.id = 'username';
                        usernameElement.innerHTML = newUsername;
                        usernameElement.onclick = editUsername;

                        var parentElement = inputElement.parentNode;
                        parentElement.replaceChild(usernameElement, inputElement);

                        alert('Username updated successfully.');
                    } else {
                        alert('Failed to update username.');
                    }
                },
                error: function() {
                    alert('An error occurred while updating username.');
                }
            });
        }
    </script>

</body>

</html>