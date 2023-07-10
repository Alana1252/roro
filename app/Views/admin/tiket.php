<!DOCTYPE html>
<html>

<head>
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



</head>

<body>
    <?= $this->include('layout/alerts'); ?>
    <?= $this->include('layout/sidebar'); ?>
    <?= $this->include('admin/detail_tiket'); ?>
    <?= $this->include('admin/edit_tiket'); ?>
    <h2>Data Tiket</h2>
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
                        <div id="dropdownOptions" class="dropdown-menu animate__animated animate__fadeInDown" style="margin-top: -15px; z-index:1; min-width: 430px;">
                            <div class="row ">
                                <div class="col">
                                    <option class="dropdown-item select" onclick="filterTable('all')">Semua</option>
                                </div>
                                <div class="col ">
                                    <option class="dropdown-item" onclick="filterTable('today')">Hari Ini</option>
                                </div>
                                <div class="col">
                                    <option class="dropdown-item" onclick="filterTable('1week')">Mingguan</option>
                                </div>
                                <div class="col">
                                    <option class="dropdown-item" onclick="filterTable('1month')">Bulanan</option>
                                </div>
                                <div class="col">
                                    <option class="dropdown-item" onclick="filterTable('1year')">Tahunan</option>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 offset-md-4">
                <div class="row">
                    <div class="col">
                        <a href="<?= route_to('exportTiket') ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Export Ke Excel</a>
                    </div>
                    <div class="col">
                        <a href="/tiket/generate" class="btn btn-warning text-white btn-sm"><i class="fas fa-cog"></i> Buat Tiket Baru</a>
                    </div>
                    <div class="col">
                        <a data-toggle="modal" data-target="#modalConfirmDeleteAll" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Keberangkatan</th>
                <th>Tiba</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Sisa Tiket</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php if (!empty($tiket)) : ?>
                <?php foreach ($tiket as $key => $tiket) : ?>
                    <tr>
                        <td><?= $tiket->id_tiket; ?></td>
                        <td><?= date('d-m-Y', strtotime($tiket->tanggal)); ?></td>
                        <td><?= date('H:i', strtotime($tiket->jam_keberangkatan)); ?> WIB</td>
                        <td><?= date('H:i', strtotime($tiket->jam_tiba)); ?> WIB</td>
                        <td><?= $tiket->tiket_asal; ?></td>
                        <td><?= $tiket->tiket_tujuan; ?></td>
                        <?php if ($tiket->koutapenumpang === '0') : ?>
                            <td class="text-danger">Habis</td>
                        <?php elseif ($tiket->koutapenumpang > '50') : ?>
                            <td class="text-success"><?= $tiket->koutapenumpang; ?></td>
                        <?php elseif ($tiket->koutapenumpang <= '50') : ?>
                            <td class="text-warning"><?= $tiket->koutapenumpang; ?></td>
                        <?php endif; ?>
                        <td>
                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailModal<?= $tiket->idtiket; ?>" data-toggle="tooltip" title="Detail">
                                <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?= $tiket->idtiket; ?>" data-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-fill " style="color:white;"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modalConfirmDelete<?= $tiket->idtiket; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7">No ticket found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
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

    function filterTable(filterType) {
        var currentDate = new Date();
        var table = document.getElementById("myTable");
        var rows = table.getElementsByTagName("tr");
        var input = document.getElementById("myInput");
        var dropdown = document.getElementById("dropdownOptions");
        var dropdownItems = dropdown.getElementsByClassName("dropdown-item");


        for (var i = 0; i < rows.length; i++) {
            var dateCell = rows[i].getElementsByTagName("td")[1];
            var dateParts = dateCell.textContent.split("-");
            var date = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);

            if (filterType === "today") {
                if (isSameDate(currentDate, date)) {
                    rows[i].style.display = "";
                    input.placeholder = "Menampilkan tiket hari ini...";
                    dropdownItems[0].classList.remove("select");
                    dropdownItems[1].classList.add("select");
                    dropdownItems[2].classList.remove("select");
                    dropdownItems[3].classList.remove("select");
                    dropdownItems[4].classList.remove("select");

                } else {
                    rows[i].style.display = "none";
                }
            } else if (filterType === "1week") {
                if (isWithinDateRange(currentDate, date, 7)) {
                    rows[i].style.display = "";
                    input.placeholder = "Menampilkan tiket dalam 1 minggu terakhir...";
                    dropdownItems[0].classList.remove("select");
                    dropdownItems[1].classList.remove("select");
                    dropdownItems[2].classList.add("select");
                    dropdownItems[3].classList.remove("select");
                    dropdownItems[4].classList.remove("select");
                } else {
                    rows[i].style.display = "none";
                }
            } else if (filterType === "1month") {
                if (isWithinDateRange(currentDate, date, 30)) {
                    rows[i].style.display = "";
                    input.placeholder = "Menampilkan tiket dalam 1 bulan terakhir...";
                    dropdownItems[0].classList.remove("select");
                    dropdownItems[1].classList.remove("select");
                    dropdownItems[2].classList.remove("select");
                    dropdownItems[3].classList.add("select");
                    dropdownItems[4].classList.remove("select");
                } else {
                    rows[i].style.display = "none";
                }
            } else if (filterType === "1year") {
                if (isWithinDateRange(currentDate, date, 365)) {
                    rows[i].style.display = "";
                    input.placeholder = "Menampilkan tiket dalam 1 tahun terakhir...";
                    dropdownItems[0].classList.remove("select");
                    dropdownItems[1].classList.remove("select");
                    dropdownItems[2].classList.remove("select");
                    dropdownItems[3].classList.remove("select");
                    dropdownItems[4].classList.add("select");

                } else {
                    rows[i].style.display = "none";
                }
            } else if (filterType === "all") {
                rows[i].style.display = "";
                input.placeholder = "Menampilkan seluruh tiket yang ada...";
                dropdownItems[0].classList.add("select");
                dropdownItems[1].classList.remove("select");
                dropdownItems[2].classList.remove("select");
                dropdownItems[3].classList.remove("select");
                dropdownItems[4].classList.remove("select");

            }
            dropdown.classList.remove("show");

        }
    }

    function isSameDate(date1, date2) {
        return (
            date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate()
        );
    }

    function isWithinDateRange(currentDate, date, days) {
        var diffTime = Math.abs(currentDate.getTime() - date.getTime());
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays <= days;
    }

    function toggleDropdown() {
        var dropdown = document.getElementById("dropdownOptions");
        dropdown.classList.toggle("show");
    }

    function typeInputPlaceholder(placeholderText, inputElement) {
        var currentIndex = 0;
        var typingSpeed = 100; // Kecepatan pengetikan dalam milidetik

        function typeNextCharacter() {
            if (currentIndex < placeholderText.length) {
                var currentPlaceholder = inputElement.getAttribute("placeholder");
                var nextCharacter = placeholderText.charAt(currentIndex);
                inputElement.setAttribute("placeholder", currentPlaceholder + nextCharacter);
                currentIndex++;
                setTimeout(typeNextCharacter, typingSpeed);
            }
        }

        typeNextCharacter();
    }

    // Menggunakan fungsi typeInputPlaceholder untuk input dengan ID "myInput"
    var inputElement = document.getElementById("myInput");
    var placeholderText = inputElement.getAttribute("placeholder");
    inputElement.setAttribute("placeholder", "");
    typeInputPlaceholder(placeholderText, inputElement);
</script>