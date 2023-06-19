<!-- View untuk menampilkan daftar transaksi dengan status "pending" -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
</head>

<body>
    <h1>Transaction List</h1>

    <?php if ($transactions) : ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Gross Amount</th>
                    <th>Transaction Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= $transaction['order_id']; ?></td>
                        <td><?= $transaction['gross_amount']; ?></td>
                        <td><?= $transaction['transaction_status']; ?></td>
                        <td>
                            <?php if ($transaction['transaction_status'] === 'pending') : ?>
                                <button onclick="showPaymentPopup('<?= $transaction['snap_token']; ?>')">Pay Now</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No pending transactions found.</p>
    <?php endif; ?>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-85jQuE_JFrArIBoY"></script>
    <script>
        // Fungsi untuk menampilkan pop-up pembayaran Midtrans
        function showPaymentPopup(token) {
            snap.pay(token, {
                onSuccess: function(result){
                    handlePaymentResult(result);
                },
                onPending: function(result){
                    handlePaymentResult(result);
                },
                onError: function(result){
                    handlePaymentResult(result);
                },
                onClose: function() {
                    console.log('Payment popup closed');
                }
            });
        }

        // Fungsi untuk mengirim data hasil pembayaran ke server
        function handlePaymentResult(result) {
            fetch('/payment/handleNotification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(result)
            })
            .then(response => response.text())
            .then(data => {
                console.log('Payment result handled successfully');
                console.log(data);
                location.reload(); // Reload the page after handling payment result
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>

</html>
