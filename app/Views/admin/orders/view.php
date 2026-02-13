<h2>📦 Order Details</h2>

<p><strong>Order ID:</strong> <?= $order['id'] ?></p>
<p><strong>User ID:</strong> <?= $order['user_id'] ?></p>
<p><strong>Total:</strong> ₹<?= $order['total_amount'] ?></p>
<p><strong>Payment Status:</strong> <?= $order['payment_status'] ?></p>
<p><strong>Order Status:</strong> <?= $order['order_status'] ?></p>

<hr>

<h3>🛒 Items</h3>

<table border="1" cellpadding="10">
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Subtotal</th>
</tr>

<?php foreach($items as $item): ?>

<tr>
    <td><?= $item['name'] ?></td>
    <td><?= $item['quantity'] ?></td>
    <td>₹<?= $item['price'] ?></td>
    <td>₹<?= $item['subtotal'] ?></td>
</tr>

<?php endforeach; ?>

</table>

<hr>

<h3>💳 Payment Details</h3>

<?php if($payment): ?>

<p><strong>Gateway:</strong> <?= $payment['payment_gateway'] ?></p>
<p><strong>Status:</strong> <?= $payment['status'] ?></p>
<p><strong>Transaction ID:</strong> <?= $payment['transaction_id'] ?? 'N/A' ?></p>

<?php else: ?>
<p>No payment record found.</p>
<?php endif; ?>
<form method="post" action="<?= base_url('api/payment/success/'.$order['id']) ?>">
    <button type="submit">Mark Payment Success</button>
</form>
