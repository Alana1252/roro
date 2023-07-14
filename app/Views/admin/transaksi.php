<!-- admin/transaksi.php -->

<!DOCTYPE html>
<html>

<head>


    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boostrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Icons Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Animated css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- CSS sendiri -->
    <link href="/css/style.css" rel="stylesheet" media="all">
    <!-- Export to Excel -->
    <script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.0/dist/js/tableexport.min.js"></script>

    <style>
        .barcode-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <?= $this->include('layout/alerts'); ?>
    <?= $this->include('admin/sidebar'); ?>
    <?= $this->include('admin/detail_transaksi'); ?>
    <?= $this->include('admin/edit_transaksi'); ?>

    <div class="container">
        <h1><?= $title ?></h1>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-search">
                        <div class=" input-group">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback" style="z-index:3;"></span>
                                <input type="text" style="min-width: 500px; z-index:2;" id="myInput" class="form-control" placeholder="Cari tiket melalui, ID, Tanggal Keberangkatan, Tiba, Asal, Tujuan, Sisa Tiket...." onclick="toggleDropdown()">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Keberangkatan</th>
                    <th>Asal</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Layanan</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Opsi</th>

                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach ($transaksi as $row) : ?>
                    <tr>
                        <td><?= $row->order_id ?></td>
                        <td><?= $row->username ?></td>
                        <td><?= date('H:i', strtotime($row->keberangkatan)); ?> WIB</td>
                        <td><?= $row->asal ?></td>
                        <td><?= $row->tanggal ?></td>
                        <td><?= $row->kouta_penumpang ?></td>
                        <td><?= $row->kelas ?></td>
                        <td><?= $row->nama_pertama ?></td>
                        <td><?= $row->transaction_status ?></td>

                        <td>
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $row->order_id; ?>" data-toggle="tooltip" title="Detail">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $row->order_id; ?>" data-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-fill " style="color:white;"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modalConfirmDelete<?= $row->order_id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>