<h2>📦 Orders List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>User</th>
    <th>Total</th>
    <th>Payment Status</th>
    <th>Order Status</th>
    <th>Action</th>
</tr>

<?php foreach($orders as $order): ?>

<tr>
    <td><?= $order['id'] ?></td>
    <td><?= $order['user_id'] ?></td>
    <td>₹<?= $order['total_amount'] ?></td>
    <td><?= $order['payment_status'] ?></td>
    <td><?= $order['order_status'] ?></td>
    <td>
        <a href="<?= base_url('admin/orders/view/'.$order['id']) ?>">
            View
        </a>
    </td>
</tr>

<?php endforeach; ?>

</table>
