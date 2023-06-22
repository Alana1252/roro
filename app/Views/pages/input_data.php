<!DOCTYPE html>
<html>

<head>
  <title>Pilih Mode Perjalanan</title>
  <style>
    .floating-card {
      position: absolute;
      background-color: #f0f0f0;
      border-radius: 5px;
      padding: 10px;
      z-index: 9999;
    }

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 5px;
    }

    .form-group label {
      width: 120px;
      margin-right: 10px;
    }

    .form-group input[type="number"] {
      width: 40px;
      text-align: center;
      margin-right: 10px;
    }

    .form-group button {
      padding: 2px 5px;
    }

    #floatingKendaraan {
      position: fixed;
      background-color: #fff;
      padding: 40px;
      width: 260px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;

      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .selected {
      background-color: yellow;
    }

    .card-kendaraan {
      height: 30px;
      width: 250px;
      font-size: 20px;
      border-radius: 5px;
      border: solid dimgray;
      border-width: 1px;
      color: black;
      margin-top: 10px;
      font-family: "Roboto", sans-serif;
      padding: 10px;
      align-items: center;
      display: inline-flex;
    }

    .card-left {
      margin-right: 100px;
      font-family: "Roboto", sans-serif;
    }
  </style>
</head>

<body>
  <h1>Input Penumpang</h1>
  <div style="position: relative;">
    <input id="pilih-penumpang" onclick="showFloatingCard()" readonly value="Jumlah Penumpang"></input>
    <div id="floating-card" class="floating-card" style="display: none;">
      <h2>Penumpang</h2>
      <div class="form-group">
        <label for="dewasa">Dewasa:</label>
        <input type="number" id="dewasa" name="dewasa" min="0" max="9" value="0" readonly>
        <button type="button" onclick="increment('dewasa')">+</button>
        <button type="button" onclick="decrement('dewasa')">-</button>
      </div>

      <div class="form-group">
        <label for="bayi">Bayi:</label>
        <input type="number" id="bayi" name="bayi" min="0" max="9" value="0" readonly>
        <button type="button" onclick="increment('bayi')">+</button>
        <button type="button" onclick="decrement('bayi')">-</button>
      </div>
      <button onclick="handlePilihPenumpang()">Pilih Penumpang</button>
    </div>
  </div>
  <h1>Pilih Mode Perjalanan</h1>

  <input id="pilih-kendaraan" onclick="showFloatingKendaraan()" readonly value="Berkendara atau tidak">

  <div id="floatingKendaraan">
    <div id="modeSelection" style="display: flex; flex-direction: column; align-items: center;">
      <p>Apakah anda membawa kendaraan?</p>
      <div class="card-kendaraan" onclick="selectMode('pejalan_kaki')" id="pejalanKakiBtn">Pejalan Kaki</div>
      <div class="card-kendaraan" onclick="selectMode('kendaraan')" id="kendaraanBtn">Kendaraan</div>
    </div>
    <div id="cardContainer">
      <div class="card" id="kendaraanCard">
        <div id="golonganContainer" style="display: none;">
          <div class="card-kendaraan" id="golongan1Btn" onclick="selectGolongan(1)">Golongan 1</div>
          <div class="card-kendaraan" id="golongan2Btn" onclick="selectGolongan(2)">Golongan 2</div>
          <div class="card-kendaraan" id="golongan3Btn" onclick="selectGolongan(3)">Golongan 3</div>
        </div>
        <button onclick="goBack()">Back</button>
      </div>
    </div>
  </div>

  <div id="koutaKendaraanValue" style="display: none;"></div>
  <script>
    const floatingKendaraan = document.getElementById('floatingKendaraan');
    const modeSelection = document.getElementById('modeSelection');
    const cardContainer = document.getElementById('cardContainer');
    const kendaraanCard = document.getElementById('kendaraanCard');
    const kendaraanText = document.getElementById('kendaraanText');
    const golonganContainer = document.getElementById('golonganContainer');
    const pejalanKakiBtn = document.getElementById('pejalanKakiBtn');
    const kendaraanBtn = document.getElementById('kendaraanBtn');
    const pilihKendaraanInput = document.getElementById('pilih-kendaraan');
    const koutaKendaraanValue = document.getElementById('koutaKendaraanValue');
    const golongan1Btn = document.getElementById('golongan1Btn');
    const golongan2Btn = document.getElementById('golongan2Btn');
    const golongan3Btn = document.getElementById('golongan3Btn');
    let koutaKendaraan = 0;

    function showFloatingKendaraan() {
      floatingKendaraan.style.display = 'flex';
      modeSelection.style.display = 'block';
      cardContainer.style.display = 'none';
    }

    function hideFloatingKendaraan() {
      floatingKendaraan.style.display = 'none';
    }

    function selectMode(mode) {
      modeSelection.style.display = 'none';
      cardContainer.style.display = 'block';

      if (mode === 'pejalan_kaki') {
        kendaraanCard.style.display = 'none';
        golonganContainer.style.display = 'none';
        pilihKendaraanInput.value = 'Pejalan Kaki';
        pejalanKakiBtn.classList.add('selected');
        kendaraanBtn.classList.remove('selected');
        koutaKendaraan = 0; // Set koutaKendaraan to 0 for "Pejalan Kaki" mode
        koutaKendaraanValue.textContent = 'Kouta Kendaraan: ' + koutaKendaraan;
        koutaKendaraanValue.style.display = 'block';
        hideFloatingKendaraan();
      } else if (mode === 'kendaraan') {
        kendaraanCard.style.display = 'block';
        golonganContainer.style.display = 'block';
        koutaKendaraanValue.style.display = 'block'; // Show the koutaKendaraanValue element
      }
    }



    function selectGolongan(golongan) {
      pilihKendaraanInput.value = 'Kendaraan - Golongan ' + golongan;
      hideFloatingKendaraan();
      pejalanKakiBtn.classList.remove('selected');
      kendaraanBtn.classList.add('selected');

      // Mengatur kouta kendaraan berdasarkan golongan
      if (golongan === 1) {
        koutaKendaraan = 2; // Kouta kendaraan jika memilih golongan 1 adalah 2
        golongan1Btn.classList.add('selected');
        golongan2Btn.classList.remove('selected');
        golongan3Btn.classList.remove('selected');
      } else if (golongan === 2) {
        golongan1Btn.classList.remove('selected');
        golongan2Btn.classList.add('selected');
        golongan3Btn.classList.remove('selected');
        koutaKendaraan = 10; // Kouta kendaraan jika memilih golongan 2 adalah 10
      } else if (golongan === 3) {
        golongan1Btn.classList.remove('selected');
        golongan2Btn.classList.remove('selected');
        golongan3Btn.classList.add('selected');
        koutaKendaraan = 15; // Kouta kendaraan jika memilih golongan 2 adalah 10
      } else {
        koutaKendaraan = 0; // Kouta kendaraan untuk golongan lainnya adalah 0
      }

      koutaKendaraanValue.textContent = 'Kouta Kendaraan: ' + koutaKendaraan;
      koutaKendaraanValue.style.display = 'block';
    }

    function goBack() {
      modeSelection.style.display = 'block';
      cardContainer.style.display = 'none';
      kendaraanCard.style.display = 'none';
      golonganContainer.style.display = 'none';
      pejalanKakiBtn.classList.remove('selected');
      kendaraanBtn.classList.remove('selected');
      pilihKendaraanInput.value = 'Berkendara atau tidak';
      koutaKendaraanValue.style.display = 'none';
    }

    document.addEventListener('click', function(event) {
      var targetElement = event.target;
      if (!floatingKendaraan.contains(targetElement) && targetElement.id !== 'pilih-kendaraan') {
        hideFloatingKendaraan();
      }
    });
  </script>









  <script>
    function showFloatingCard() {
      var floatingCard = document.getElementById('floating-card');
      floatingCard.style.display = 'block';
    }

    function hideFloatingCard() {
      var floatingCard = document.getElementById('floating-card');
      floatingCard.style.display = 'none';
    }

    function increment(inputId) {
      var dewasaInput = document.getElementById('dewasa');
      var bayiInput = document.getElementById('bayi');
      var dewasaValue = parseInt(dewasaInput.value);
      var bayiValue = parseInt(bayiInput.value);

      if (inputId === 'dewasa') {
        if (dewasaValue < 9 && (dewasaValue + bayiValue) < 10) {
          dewasaInput.value = dewasaValue + 1;
        }
        bayiInput.value = Math.min(10 - dewasaValue, bayiValue);
        if (dewasaValue === 0) {
          bayiInput.value = 0;
        }
      } else if (inputId === 'bayi' && dewasaValue > 0) {
        if (bayiValue < 9 && (dewasaValue + bayiValue) < 10) {
          bayiInput.value = bayiValue + 1;
        }
        dewasaInput.value = Math.min(10 - bayiValue, dewasaValue);
      }
    }

    function decrement(inputId) {
      var dewasaInput = document.getElementById('dewasa');
      var bayiInput = document.getElementById('bayi');
      var dewasaValue = parseInt(dewasaInput.value);
      var bayiValue = parseInt(bayiInput.value);

      if (inputId === 'dewasa') {
        if (dewasaValue > 0) {
          dewasaInput.value = dewasaValue - 1;
        }
        bayiInput.value = Math.min(10 - dewasaValue, bayiValue);
        if (dewasaValue === 1 && bayiValue > 0) {
          bayiInput.value = 0;
        }
      } else if (inputId === 'bayi' && dewasaValue > 0) {
        if (bayiValue > 0) {
          bayiInput.value = bayiValue - 1;
        }
        dewasaInput.value = Math.min(10 - bayiValue, dewasaValue);
      }
    }

    function updateButtonValue() {
      var dewasaInput = document.getElementById('dewasa');
      var bayiInput = document.getElementById('bayi');
      var button = document.getElementById('pilih-penumpang');
      var dewasaValue = parseInt(dewasaInput.value);
      var bayiValue = parseInt(bayiInput.value);
      var buttonValue = '';

      if (dewasaValue === 0 && bayiValue === 0) {
        buttonValue = 'Jumlah Penumpang';
      } else {
        if (dewasaValue > 0) {
          buttonValue += dewasaValue + ' Dewasa';
        }

        if (bayiValue > 0) {
          if (buttonValue !== '') {
            buttonValue += ', ';
          }
          buttonValue += bayiValue + ' Bayi';
        }
      }

      button.value = buttonValue;
    }

    function handlePilihPenumpang() {
      var dewasaInput = document.getElementById('dewasa');
      var bayiInput = document.getElementById('bayi');
      var dewasaValue = parseInt(dewasaInput.value);
      var bayiValue = parseInt(bayiInput.value);

      if (dewasaValue === 0 && bayiValue > 0) {
        alert('Tidak dapat menambahkan penumpang bayi tanpa penumpang dewasa.');
        return;
      }

      updateButtonValue();

      var kouta_penumpang = bayiValue * 0 + dewasaValue * 1;
      console.log('Kouta Penumpang:', kouta_penumpang);
      hideFloatingCard();
    }
    document.addEventListener('click', function(event) {
      var floatingCard = document.getElementById('floating-card');
      var targetElement = event.target;
      if (!floatingCard.contains(targetElement) && targetElement.id !== 'pilih-penumpang') {
        hideFloatingCard();
      }
    });
  </script>



</body>

</html>