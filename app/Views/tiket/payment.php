<html>
  <body>
  <?php if (!empty($pendingTransactions)) : ?>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
            <?php foreach ($pendingTransactions as $transaction) : ?>
                <tr>
                    <td><?php echo $transaction['order_id']; ?></td>
                    <td><?php echo $transaction['gross_amount']; ?></td>
                    <td>
                        <!-- Menampilkan tombol "Bayar Sekarang" yang akan memanggil fungsi 'payNow' saat diklik -->
                        <button id="pay-button">Bayar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>No pending transactions.</p>
    <?php endif; ?>
    
    <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('<?=$snapToken?>', {
  // ...
  onSuccess: function(result){
    handlePaymentResult(result);
  },
  onPending: function(result){
    handlePaymentResult(result);
  },
  onError: function(result){
    handlePaymentResult(result);
  }
});

function handlePaymentResult(result) {
  fetch('/payment/handlePaymentResult', {
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

      }
    </script>

  </body>
</html>
