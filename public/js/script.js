var asalSelect = document.getElementById("asal");
var tujuanSelect = document.getElementById("tujuan");

// Saat asal berubah
asalSelect.addEventListener("change", function () {
  var selectedAsal = asalSelect.value;

  if (selectedAsal === "1") {
    // Jika asal adalah Air Putih, tujuan menjadi readonly dan bernilai Sungai Selari
    tujuanSelect.value = "2";
    tujuanSelect.setAttribute("readonly", "readonly");
  } else if (selectedAsal === "2") {
    // Jika asal adalah Sungai Selari, tujuan menjadi readonly dan bernilai Air Putih
    tujuanSelect.value = "1";
    tujuanSelect.setAttribute("readonly", "readonly");
  } else {
    // Jika asal tidak dipilih, tujuan dapat dipilih kembali
    tujuanSelect.removeAttribute("readonly");
  }
});

// Saat tujuan berubah
tujuanSelect.addEventListener("change", function () {
  var selectedTujuan = tujuanSelect.value;

  if (selectedTujuan === "1") {
    // Jika tujuan adalah Air Putih, asal menjadi readonly dan bernilai Sungai Selari
    asalSelect.value = "2";
    asalSelect.setAttribute("readonly", "readonly");
  } else if (selectedTujuan === "2") {
    // Jika tujuan adalah Sungai Selari, asal menjadi readonly dan bernilai Air Putih
    asalSelect.value = "1";
    asalSelect.setAttribute("readonly", "readonly");
  } else {
    // Jika tujuan tidak dipilih, asal dapat dipilih kembali
    asalSelect.removeAttribute("readonly");
  }
});

//Input penumpang

function showFloatingCard() {
  var floatingCard = document.getElementById("floating-card");
  floatingCard.style.display = "block";
}

function hideFloatingCard() {
  var floatingCard = document.getElementById("floating-card");
  floatingCard.style.display = "none";
}

function increment(inputId) {
  var dewasaInput = document.getElementById("dewasa");
  var bayiInput = document.getElementById("bayi");
  var dewasaValue = parseInt(dewasaInput.value);
  var bayiValue = parseInt(bayiInput.value);

  if (inputId === "dewasa") {
    if (dewasaValue < 9 && dewasaValue + bayiValue < 10) {
      dewasaInput.value = dewasaValue + 1;
    }
    bayiInput.value = Math.min(10 - dewasaValue, bayiValue);
    if (dewasaValue === 0) {
      bayiInput.value = 0;
    }
  } else if (inputId === "bayi" && dewasaValue > 0) {
    if (bayiValue < 9 && dewasaValue + bayiValue < 10) {
      bayiInput.value = bayiValue + 1;
    }
    dewasaInput.value = Math.min(10 - bayiValue, dewasaValue);
  }
}

function decrement(inputId) {
  var dewasaInput = document.getElementById("dewasa");
  var bayiInput = document.getElementById("bayi");
  var dewasaValue = parseInt(dewasaInput.value);
  var bayiValue = parseInt(bayiInput.value);

  if (inputId === "dewasa") {
    if (dewasaValue > 0) {
      dewasaInput.value = dewasaValue - 1;
    }
    bayiInput.value = Math.min(10 - dewasaValue, bayiValue);
    if (dewasaValue === 1 && bayiValue > 0) {
      bayiInput.value = 0;
    }
  } else if (inputId === "bayi" && dewasaValue > 0) {
    if (bayiValue > 0) {
      bayiInput.value = bayiValue - 1;
    }
    dewasaInput.value = Math.min(10 - bayiValue, dewasaValue);
  }
}

function updateButtonValue() {
  var dewasaInput = document.getElementById("dewasa");
  var bayiInput = document.getElementById("bayi");
  var button = document.getElementById("pilih-penumpang");
  var dewasaValue = parseInt(dewasaInput.value);
  var bayiValue = parseInt(bayiInput.value);
  var buttonValue = "";

  if (dewasaValue === 0 && bayiValue === 0) {
    buttonValue = "Jumlah Penumpang";
  } else {
    if (dewasaValue > 0) {
      buttonValue += dewasaValue + " Dewasa";
    }

    if (bayiValue > 0) {
      if (buttonValue !== "") {
        buttonValue += ", ";
      }
      buttonValue += bayiValue + " Bayi";
    }
  }

  button.value = buttonValue;
}

function handlePilihPenumpang() {
  var dewasaInput = document.getElementById("dewasa");
  var bayiInput = document.getElementById("bayi");
  var dewasaValue = parseInt(dewasaInput.value);
  var bayiValue = parseInt(bayiInput.value);

  if (dewasaValue === 0 && bayiValue > 0) {
    alert("Tidak dapat menambahkan penumpang bayi tanpa penumpang dewasa.");
    return;
  }

  updateButtonValue();
  hideFloatingCard();
  var kouta_penumpang = bayiValue * 0 + dewasaValue * 1;
  var inputKoutaPenumpang = document.querySelector('input[name="kouta_penumpang"]');
  inputKoutaPenumpang.value = kouta_penumpang;
}
document.addEventListener("click", function (event) {
  var floatingCard = document.getElementById("floating-card");
  var targetElement = event.target;
  if (!floatingCard.contains(targetElement) && targetElement.id !== "pilih-penumpang") {
    hideFloatingCard();
  }
});

const floatingKendaraan = document.getElementById("floatingKendaraan");
const modeSelection = document.getElementById("modeSelection");
const cardContainer = document.getElementById("cardContainer");
const kendaraanCard = document.getElementById("kendaraanCard");
const kendaraanText = document.getElementById("kendaraanText");
const golonganContainer = document.getElementById("golonganContainer");
const pejalanKakiBtn = document.getElementById("pejalanKakiBtn");
const kendaraanBtn = document.getElementById("kendaraanBtn");
const pilihKendaraanInput = document.getElementById("pilih-kendaraan");
const koutaKendaraanValue = document.getElementById("koutaKendaraanValue");
const golongan1Btn = document.getElementById("golongan1Btn");
const golongan2Btn = document.getElementById("golongan2Btn");
const golongan3Btn = document.getElementById("golongan3Btn");
let koutaKendaraan = 0;

function showFloatingKendaraan() {
  floatingKendaraan.style.display = "flex";
  modeSelection.style.display = "flex";
  cardContainer.style.display = "none";
}

function hideFloatingKendaraan() {
  floatingKendaraan.style.display = "none";
}

function selectMode(mode) {
  modeSelection.style.display = "none";
  cardContainer.style.display = "flex";

  if (mode === "pejalan_kaki") {
    kendaraanCard.style.display = "none";
    golonganContainer.style.display = "none";
    pilihKendaraanInput.value = "Pejalan Kaki";
    pejalanKakiBtn.classList.add("selected");
    kendaraanBtn.classList.remove("selected");
    koutaKendaraan = 0; // Set koutaKendaraan to 0 for "Pejalan Kaki" mode
    koutaKendaraanValue.value = +koutaKendaraan;
    hideFloatingKendaraan();
  } else if (mode === "kendaraan") {
    kendaraanCard.style.display = "block";
    golonganContainer.style.display = "flex";
  }
}

function selectGolongan(golongan) {
  pilihKendaraanInput.value = "Kendaraan - Golongan " + golongan;
  hideFloatingKendaraan();
  pejalanKakiBtn.classList.remove("selected");
  kendaraanBtn.classList.add("selected");

  // Mengatur kouta kendaraan berdasarkan golongan
  if (golongan === 1) {
    koutaKendaraan = 2; // Kouta kendaraan jika memilih golongan 1 adalah 2
    golongan1Btn.classList.add("selected");
    golongan2Btn.classList.remove("selected");
    golongan3Btn.classList.remove("selected");
  } else if (golongan === 2) {
    golongan1Btn.classList.remove("selected");
    golongan2Btn.classList.add("selected");
    golongan3Btn.classList.remove("selected");
    koutaKendaraan = 10; // Kouta kendaraan jika memilih golongan 2 adalah 10
  } else if (golongan === 3) {
    golongan1Btn.classList.remove("selected");
    golongan2Btn.classList.remove("selected");
    golongan3Btn.classList.add("selected");
    koutaKendaraan = 15; // Kouta kendaraan jika memilih golongan 2 adalah 10
  } else {
    koutaKendaraan = 0; // Kouta kendaraan untuk golongan lainnya adalah 0
  }

  koutaKendaraanValue.value = +koutaKendaraan;
  var inputkoutaKendaraanValue = document.querySelector('input[name="kouta_kendaraan"]');
  inputkoutaKendaraanValue.value = kouta_kendaraan;
}

function goBack() {
  modeSelection.style.display = "flex";
  cardContainer.style.display = "none";
  kendaraanCard.style.display = "none";
  golonganContainer.style.display = "none";
  pejalanKakiBtn.classList.remove("selected");
  kendaraanBtn.classList.remove("selected");
  pilihKendaraanInput.value = "Berkendara atau tidak";
}

document.addEventListener("click", function (event) {
  var targetElement = event.target;
  if (!floatingKendaraan.contains(targetElement) && targetElement.id !== "pilih-kendaraan") {
    hideFloatingKendaraan();
  }
});

$(function () {
  $("#tanggal").datepicker({
    dateFormat: "mm-dd-yy", // Mengatur format tanggal yang ditampilkan pada input
    altField: "#hiddenTanggal", // Menggunakan input tersembunyi untuk menyimpan nilai dengan format "yyyy-mm-dd"
    altFormat: "yy-mm-dd", // Mengatur format tanggal yang disimpan di input tersembunyi
    defaultDate: new Date(), // Mengatur tanggal default ke hari ini
    minDate: 0, // Memuat tanggal minimal yang bisa dipilih
    showButtonPanel: true,
    currentText: "Go-RoRo",
    onClose: function (dateText, inst) {
      if ($(this).val() === "") {
        $(this).datepicker("setDate", new Date());
      }
    },
  });
});

// Sidebar
(function ($) {
  "use strict";

  var fullHeight = function () {
    $(".js-fullheight").css("height", $(window).height());
    $(window).resize(function () {
      $(".js-fullheight").css("height", $(window).height());
    });
  };
  fullHeight();

  // Tambahkan kelas "active" saat halaman dimuat
  $(document).ready(function () {
    $("#sidebar").addClass("active");
    $(".footer").hide();
  });

  $("#sidebarCollapse").on("click", function () {
    $("#sidebar").toggleClass("active");

    // Animasikan pergerakan geser menggunakan efek slide
    if ($("#sidebar").hasClass("active")) {
      $("#geser").animate({ "margin-left": "350px" }, 500);
      $(".footer").hide();
      $(".card-tiket").each(function (index) {
        $(this).animate({ "margin-left": "350px" }, 500);
      });
    } else {
      $("#geser").animate({ "margin-left": "200px" }, 500);
      $(".footer").show();
      $(".card-tiket").each(function (index) {
        $(this).animate({ "margin-left": "200px" }, 500);
      });
    }
  });
})(jQuery);

function redirectToDetailTiket() {
  var dewasaValue = parseInt(document.getElementById("dewasa").value);
  var bayiValue = parseInt(document.getElementById("bayi").value);
  var jenisJasaValue = document.getElementById("jenis-jasa").value;

  var url = "detail-tiket?dewasa=" + dewasaValue + "&bayi=" + bayiValue + "&jenis_jasa=" + jenisJasaValue;
  window.location.href = url;
}

function selectImage(imageIndex) {
  // Reset semua input radio keadaan tidak terpilih
  var radioButtons = document.getElementsByName("gambar");
  for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].checked = false;
  }

  // Tandai input radio terpilih
  document.getElementById("radio" + imageIndex).checked = true;
}
