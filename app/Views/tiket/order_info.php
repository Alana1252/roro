<!-- tiket/order_info.php -->

<h1>Order Information</h1>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orderInfos as $orderInfo) : ?>
            <?php if ($orderInfo !== null) : ?>
                <tr>
                    <td><?= $orderInfo['order_id'] ?></td>
                    <td><?= $orderInfo['status_message'] ?></td>
                    <td><?= $orderInfo['transaction_status'] ?></td>
                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        
    </tbody>
</table>
