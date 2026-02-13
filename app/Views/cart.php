<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f8f9fa;">

<!-- HEADER -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="<?= base_url('shop') ?>">🛍 My Shop</a>

    <a href="<?= base_url('cart') ?>" class="btn btn-warning position-relative">
        🛒 Cart
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= session()->get('cart_count') ?? 0 ?>
        </span>
    </a>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">🛒 Your Cart</h2>

    <?php if(empty($items)): ?>
        <div class="alert alert-info">
            Your cart is empty.
        </div>
        <a href="<?= base_url('shop') ?>" class="btn btn-primary">
            Continue Shopping
        </a>
    <?php else: ?>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th width="180">Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php $grandTotal = 0; ?>

                <?php foreach($items as $item): 
                    $grandTotal += $item['total'];
                ?>

                <tr>
                    <td><?= $item['name'] ?></td>
                    <td>₹<?= $item['price'] ?></td>

                    <!-- UPDATE QUANTITY -->
                    <td>
                        <form method="post" action="<?= base_url('api/cart/update/'.$item['id']) ?>" class="d-flex">
                            <input type="number"
                                   name="quantity"
                                   value="<?= $item['quantity'] ?>"
                                   min="1"
                                   class="form-control me-2">

                            <button type="submit" class="btn btn-sm btn-success">
                                Update
                            </button>
                        </form>
                    </td>

                    <td class="fw-bold">₹<?= $item['total'] ?></td>

                    <!-- DELETE -->
                    <td>
                        <form method="post" action="<?= base_url('api/cart/delete/'.$item['id']) ?>">
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Remove this item?')">
                                Remove
                            </button>
                        </form>

                    </td>
                </tr>

                <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>

    <!-- TOTAL SECTION -->
    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="mb-3">Cart Summary</h4>

                    <div class="d-flex justify-content-between">
                        <span>Grand Total:</span>
                        <strong>₹<?= $grandTotal ?></strong>
                    </div>

                    <hr>

                    <form method="post" action="<?= base_url('api/cart/checkout') ?>">
                        <button type="submit" class="btn btn-success w-100">
                            Proceed To Checkout
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <div class="mt-4">
        <a href="<?= base_url('shop') ?>" class="btn btn-secondary">
            ← Continue Shopping
        </a>
    </div>

    <?php endif; ?>

</div>

</body>
</html>
