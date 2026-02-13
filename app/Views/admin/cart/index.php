<!DOCTYPE html>
<html>
<head>
    <title>Cart List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">Cart Items (User ID: 1)</h3>

    <table class="table table-bordered bg-white shadow">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($cartItems as $key => $item): ?>
                <?php $subtotal = $item['price'] * $item['quantity']; ?>
                <?php $total += $subtotal; ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($item['name']) ?></td>
                    <td>₹<?= $item['price'] ?></td>

                    <td>
                        <form method="post" action="<?= base_url('admin/cart/update/'.$item['id']) ?>">
                            <div class="input-group">
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" class="form-control" min="1">
                                <button class="btn btn-success btn-sm">Update</button>
                            </div>
                        </form>
                    </td>

                    <td>₹<?= $subtotal ?></td>

                    <td>
                        <a href="<?= base_url('admin/cart/delete/'.$item['id']) ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this item?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4>Total: ₹<?= $total ?></h4>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary mt-3">
        Back to Dashboard
    </a>
</div>

</body>
</html>
