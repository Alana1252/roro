<!-- admin/transaksi.php -->

<!DOCTYPE html>
<html>

<head>


    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link href="/css/style.css" rel="stylesheet" media="all">


    <style>
        .barcode-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <?= $this->include('admin/sidebar'); ?>
    <?= $this->include('admin/detail_transaksi'); ?>
    <?= $this->include('operator/date'); ?>

    <div class="container">
        <h1><?= $title ?></h1>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-search">
                        <div class="input-group">
                            <div class="form-group has-search">
                                <span class="fa fa-search form-control-feedback" style="z-index:3;"></span>
                                <input type="text" style="min-width: 500px; z-index:2;" id="myInput" class="form-control" placeholder="Cari tiket melalui, ID, Tanggal Keberangkatan, Tiba, Asal, Tujuan, Sisa Tiket....">
                            </div>
                        </div>
                    </div>
                </div>

                <div class=" col-md-4 offset-md-4">
                    <div class="row">
                        <div class="col">
                            <input type="text" id="myTanggal" placeholder="Pilih Tanggal" class="select-icon-tiket input-tiket" style="background-size: 14px 14px; background-image: url('/img/calendar.png');" onclick="showDatePickerModal()" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table class=" table table-hover mt-2">
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
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="<?= base_url('js/script.js') ?>"></script>
    <script>
        function showDatePickerModal() {
            $('#datePickerModal').modal('show');
        }

        function updateInputDate() {
            var selectedDate = $('#selectedDate').val();
            $('#myTanggal').val(selectedDate);
            filterTable();
        }

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            var tanggalInput = document.getElementById("myTanggal").value;

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4]; // Kolom tanggal berada pada indeks ke-4
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 && (tanggalInput == "" || tanggalInput == txtValue)) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }


        $(document).ready(function() {
            $('#selectedDate').datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function(dateText) {
                    $('#selectedDate').val(dateText);
                    filterTable();
                }
            });
        });
    </script>


</body>

</html>