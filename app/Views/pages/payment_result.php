<html>
  <body>
    <h1>Payment Result</h1>
    <p>Order ID: <?= $result['order_id']; ?></p>
    <p>Status Message: <?= $result['status_message']; ?></p>
    <p>Gross Amount: <?= $result['gross_amount']; ?></p>
    <p>Payment Type: <?= $result['payment_type']; ?></p>
    <p>Transaction Time: <?= $result['transaction_time']; ?></p>
    <p>Transaction Status: <?= $result['transaction_status']; ?></p>
    <?php if (isset($result['va_numbers']) && !empty($result['va_numbers'])): ?>
      <p>Virtual Account Numbers:</p>
      <ul>
        <?php foreach ($result['va_numbers'] as $va): ?>
          <li>
            Bank: <?= $va['bank']; ?><br>
            VA Number: <?= $va['va_number']; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php if (isset($result['bca_va_number'])): ?>
      <p>BCA VA Number: <?= $result['bca_va_number']; ?></p>
    <?php endif; ?>
    
    <?php if (isset($result['pdf_url'])): ?>
      <p><a href="<?= $result['pdf_url']; ?>" target="_blank">PDF URL</a></p>
    <?php endif; ?>
    <?php if (isset($result['finish_redirect_url'])): ?>
      <p><a href="<?= $result['finish_redirect_url']; ?>" target="_blank">Finish Redirect URL</a></p>
    <?php endif; ?>
    
  </body>
</html>
