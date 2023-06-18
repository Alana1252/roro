<html>
  <body>
    <h1>Payment Result</h1>
    <p>Order ID: <?php echo $result['order_id']; ?></p>
    <p>Status Message: <?php echo $result['status_message']; ?></p>
    <p>Gross Amount: <?php echo $result['gross_amount']; ?></p>
    <p>Payment Type: <?php echo $result['payment_type']; ?></p>
    <p>Transaction Time: <?php echo $result['transaction_time']; ?></p>
    <p>Transaction Status: <?php echo $result['transaction_status']; ?></p>
    <p>Fraud Status: <?php echo $result['fraud_status']; ?></p>
    <?php if (isset($result['va_numbers']) && !empty($result['va_numbers'])): ?>
      <p>Virtual Account Numbers:</p>
      <ul>
        <?php foreach ($result['va_numbers'] as $va): ?>
          <li>
            Bank: <?php echo $va['bank']; ?><br>
            VA Number: <?php echo $va['va_number']; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php if (isset($result['bca_va_number'])): ?>
      <p>BCA VA Number: <?php echo $result['bca_va_number']; ?></p>
    <?php endif; ?>
    <?php if (isset($result['pdf_url'])): ?>
      <p><a href="<?php echo $result['pdf_url']; ?>" target="_blank">PDF URL</a></p>
    <?php endif; ?>
    <?php if (isset($result['finish_redirect_url'])): ?>
      <p><a href="<?php echo $result['finish_redirect_url']; ?>" target="_blank">Finish Redirect URL</a></p>
    <?php endif; ?>
  </body>
</html>
