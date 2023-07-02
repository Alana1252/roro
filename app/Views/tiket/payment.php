<html>

<body>
  <h1>New Transaction</h1>
  <form method="post" action="/update_payment">
    <input type="" name="snap_token" value="<?= $snapToken ?>">


    <label for="kouta_kendaraan">Kouta Kendaraan:</label>
    <input type="number" name="kouta_kendaraan" value="">
    <label for="names">Kouta names:</label>
    <input type="number" name="names" value="">

    <label for="kouta_penumpang">Kouta Penumpang:</label>
    <input type="number" name="kouta_penumpang" value="">

    <!-- Add other transaction fields here -->

    <button type="submit">Update</button>
  </form>
  <button id="pay-button">Pay!</button>
  <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>

  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
  <script type="text/javascript">
    document.getElementById('pay-button').onclick = function() {
      // SnapToken acquired from previous step
      snap.pay('<?= $snapToken ?>', {
        // ...
        onSuccess: function(result) {
          tambahPaymentResult(result);
        },
        onPending: function(result) {
          tambahPaymentResult(result);
        },
        onError: function(result) {
          handlePaymentResult(result);
        }
      });
    }

    function tambahPaymentResult(result) {
      // Kirim data hasil pembayaran menggunakan metode AJAX
      fetch('/tambah/tambahPaymentResult', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(result)
        })
        .then(response => response.text())
        .then(data => {
          // Tampilkan hasil pembayaran di dalam <pre> tag
          document.getElementById('result-json').innerHTML = data;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>
</body>

</html>