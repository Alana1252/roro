<html>
  <body>
    <h1>New Transaction</h1>
   
    <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?= $snapToken ?>', {
          // ...
          onSuccess: function(result){
            tambahPaymentResult(result);
          },
          onPending: function(result){
            tambahPaymentResult(result);
          },
          onError: function(result){
            handlePaymentResult(result);
          }
        });
      }

      function tambahPaymentResult(result) {
        // Kirim data hasil pembayaran menggunakan metode AJAX
        fetch('/payment/tambahPaymentResult', {
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
