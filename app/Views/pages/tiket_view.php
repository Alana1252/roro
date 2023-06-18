<!-- tiket_view.php -->

<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- Latest compiled and minified JavaScript -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<link href="/css/style.css" rel="stylesheet" media="all">
   
</head>
<body>
<form action="<?= site_url('tiket/search'); ?>" method="get">
<div class="container card-caritiket">
<div class="ticket-align">
    <div class="caritiket-title">Cari Tiket Anda</div>
    <div class="caritiket-title2 selectpicker">Atur Jadwal Kedatangan Anda di Pelabuhan</div>
  <div class="row">
    <div class="col">
    <div for="asal">Pelabuhan Asal:</div>
    <select id="asal" name="asal" class="select-icon-tiket" style="background-image: url('/img/ship.png');">
  <option value="2">Air Putih</option>
  <option value="1">Sungai Selari</option>
</select>
    </div>
    <div class="col">
    <div for="tanggal">Tanggal Keberangkatan:</div>
      <input type="date" id="tanggal" name="tanggal" min="<?= date('Y-m-d'); ?>" required>
    </div>
  </div>
  <div class="row">
    <div class="col">
    <div for="tujuan">Pelabuhan Tujuan:<a ><img src="/img/repeat.png" class="image-tiket" alt="Gambar"></a></div>
      <select id="tujuan" name="tujuan" class="select-icon-tiket" style="background-image: url('/img/ship2.png');">
        <option value="1">Sungai Selari</option>
        <option value="2">Air Putih</option>
      </select>
    </div>
    <div class="col">
      2 of 3
    </div>
    <div class="col">
      3 of 3
    </div>
  </div>
</div>
</div>

  
      
      
      
      <select id="kelas" name="kelas">
        <option value="Ekonomi">Ekonomi</option>
        <option value="Premium">Premium</option>
      </select>
      <button type="submit">Cari</button>
    </form>
  </div>
  </div>

  



    <?php if (!empty($tikets)): ?>
        <?php foreach ($tikets as $tiket): ?>
            <div class="card-tiket">
            <div class="layanan-tiket">
  <img class="logo-tiket" src="/img/logo.png" alt="Airputih" />
  <div class="card-kapal">
    <?= $kapalModel->getKapalName($tiket['kapal']); ?>
  </div>
  <div class="tanggal-tiket">
<?=$tiket['tanggal_formatted'];?>
  </div>
</div>
                        <div class="card-jam">
                        <div class="card-keberangkatan">
                            <?= $jamModel->getJamKeberangkatan($tiket['keberangkatan']); ?>
                        </div>
                        <div class="garis-horizontal">
                <span class="kelas-text"><?= $tiket['kelas'] ?? 'Kelas'; ?></span>
            </div>
                        <div class="card-tiba">
                            <?= $jamModel->getJamTiba($tiket['tiba']); ?>
                        </div>
                        <div class="tiket-harga">Rp.<?= isset($harga) ? $harga : '10.000'; ?></div>
                        <div class="tiket-harga2">/orang</div>
                        </div>
                        <div class="card-lokasi">
                        <div class="card-asal">
                            <?= $lokasiModel->getAsal($tiket['asal']); ?>
                        </div>
                        <div class="card-tujuan">
                            <?= $lokasiModel->getTujuan($tiket['tujuan']); ?>
                        </div>
                    <div class="button-pilih">
                        Pilih
                    </div>
                        </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada tiket yang tersedia untuk pencarian ini.</p>
    <?php endif; ?>
</html>

<script>
        var asalSelect = document.getElementById('asal');
        var tujuanSelect = document.getElementById('tujuan');
        
        // Saat asal berubah
        asalSelect.addEventListener('change', function() {
            var selectedAsal = asalSelect.value;
            
            if (selectedAsal === '1') {
                // Jika asal adalah Air Putih, tujuan menjadi readonly dan bernilai Sungai Selari
                tujuanSelect.value = '2';
                tujuanSelect.setAttribute('readonly', 'readonly');
            } else if (selectedAsal === '2') {
                // Jika asal adalah Sungai Selari, tujuan menjadi readonly dan bernilai Air Putih
                tujuanSelect.value = '1';
                tujuanSelect.setAttribute('readonly', 'readonly');
            } else {
                // Jika asal tidak dipilih, tujuan dapat dipilih kembali
                tujuanSelect.removeAttribute('readonly');
            }
        });
        
        // Saat tujuan berubah
        tujuanSelect.addEventListener('change', function() {
            var selectedTujuan = tujuanSelect.value;
            
            if (selectedTujuan === '1') {
                // Jika tujuan adalah Air Putih, asal menjadi readonly dan bernilai Sungai Selari
                asalSelect.value = '2';
                asalSelect.setAttribute('readonly', 'readonly');
            } else if (selectedTujuan === '2') {
                // Jika tujuan adalah Sungai Selari, asal menjadi readonly dan bernilai Air Putih
                asalSelect.value = '1';
                asalSelect.setAttribute('readonly', 'readonly');
            } else {
                // Jika tujuan tidak dipilih, asal dapat dipilih kembali
                asalSelect.removeAttribute('readonly');
            }
        });
    </script>

<script>
  $(document).ready(function() {
    // Inisialisasi Select2 pada elemen select
    $('.select-with-icon').select2({
      templateResult: function(data) {
        var $option = $(data.element);
        
        // Menampilkan gambar ikon hanya pada opsi yang dipilih
        if (data.id && $option.data('icon') && data.element.selected) {
          var $container = $('<span></span>');
          var $icon = $('<span class="select2-icon"></span>');
          $icon.css({
            'background-image': 'url(' + $option.data('icon') + ')',
            'background-repeat': 'no-repeat',
            'background-position': 'right center',
            'background-size': '16px 16px', /* Sesuaikan ukuran ikon */
            'padding-right': '20px' /* Sesuaikan jarak ikon dari teks */
          });
          $container.append($icon);
          $container.append(data.text);
          return $container;
        }
        
        return data.text;
      },
      templateSelection: function(data) {
        var $option = $(data.element);
        
        // Menampilkan gambar ikon hanya pada opsi yang dipilih
        if (data.id && $option.data('icon')) {
          var $selectedOption = $('<span></span>');
          var $selectedIcon = $('<span class="select2-icon"></span>');
          $selectedIcon.css({
            'background-image': 'url(' + $option.data('icon') + ')',
            'background-repeat': 'no-repeat',
            'background-position': 'right center',
            'background-size': '16px 16px', /* Sesuaikan ukuran ikon */
            'padding-right': '20px', /* Sesuaikan jarak ikon dari teks */
            'margin-right': '20px' /* Sesuaikan jarak ikon dari teks */
          });
          $selectedOption.append($selectedIcon);
          $selectedOption.append(data.text);
          return $selectedOption;
        }
        
        return data.text;
      }
    });
  });
</script>
<script>
  document.querySelector('.image-tiket').addEventListener('click', function() {
    var asalSelect = document.getElementById('asal');
    var tujuanSelect = document.getElementById('tujuan');
    
    var selectedAsal = asalSelect.value;
    var selectedTujuan = tujuanSelect.value;
    
    asalSelect.value = selectedTujuan;
    tujuanSelect.value = selectedAsal;
  });
</script>