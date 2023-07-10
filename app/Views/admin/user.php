<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="/css/style.css" rel="stylesheet" media="all">
</head>

<body>
    <?= $this->include('layout/sidebar'); ?>
    <?= $this->include('admin/detail_user'); ?>
    <?= $this->include('admin/edit_user'); ?>


    <!-- <div id="myBtnContainer">
        <button class="btn active" data-filter="all">Show all</button>
        <button class="btn" data-filter="Aktif">Aktif</button>
        <button class="btn" data-filter="Banned">Banned</button>
        <button class="btn" data-filter="Nonaktif">Nonaktif</button>
        <button class="btn" data-filter="admin">Admin</button>
        <button class="btn" data-filter="operator">Operator</button>
        <button class="btn" data-filter="user">User</button>
    </div> -->

    <div class="container">
        <h2>Data User</h2>
        <br>
        <div class="form-group has-search">
            <span class="fa fa-search form-control-feedback"></span>
            <input type="text" id="myInput" class="form-control" placeholder="Search the table for Roles, Transactions, Username or Emails.">
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Transaksi</th>
                    <th scope="col">Role</th>
                    <th scope="col">Opsi</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php if (!empty($users)) : ?>
                    <?php $visibleRows = 0; ?>
                    <?php foreach ($users as $key => $user) : ?>
                        <tr class="text-center" data-status="<?= $user->name; ?> : <?= $user->status; ?>">
                            <?php $visibleRows++; ?>
                            <th scope="row" id="row<?= $visibleRows; ?>"><?= $visibleRows; ?></th>
                            <td><?= $user->username; ?></td>
                            <td><?= $user->email; ?></td>
                            <td><?= $user->settlement_count; ?></td>
                            <td>
                                <?php if ($user->status === 'Aktif') : ?>
                                    <div class="<?= ($user->name == 'admin') ? 'admin bg-success' : (($user->name == 'operator') ? 'operator' : 'user'); ?>">
                                        <span> <?= $user->name; ?></span>
                                    </div>
                                <?php elseif ($user->status === 'Nonaktif') : ?>
                                    <div class="user bg-warning">
                                        <span> <?= $user->status; ?></span>
                                    </div>
                                <?php elseif ($user->status === 'Banned') : ?>
                                    <div class="user bg-danger">
                                        <span> <?= $user->status; ?></span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $user->userid; ?>" data-toggle="tooltip" title="Detail">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $user->userid; ?>" data-toggle="tooltip" title="Edit">
                                    <i class="bi bi-pencil-fill " style="color:white;"></i>
                                </a>
                                <a href="<?= base_url('user/delete/' . $user->userid) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="Delete">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
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
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });

            // Mengatur ulang nomor urutan
            var count = 1;
            $("#myTable tr:visible").each(function() {
                var rowId = $(this).find("th").attr("id");
                $("#" + rowId).text(count);
                count++;
            });
        });
    });
</script>
<script src="<?= base_url('js/script.js') ?>"></script>
<!-- <script>
    $(document).ready(function() {
        $(".btn").click(function() {
            var filter = $(this).attr("data-filter");
            filterSelection(filter);
        });

        function filterSelection(filter) {
            if (filter == "all") {
                $("#myTable tr").show();
            } else {
                $("#myTable tr").hide();
                $("#myTable tr[data-status*='" + filter + "']").show();
            }
        }
    });
</script> -->