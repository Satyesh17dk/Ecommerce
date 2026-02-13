<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f8f9fa;">

<!-- HEADER -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="#">🛍 My Shop</a>

    <a href="<?= base_url('cart') ?>" class="btn btn-warning position-relative">
        🛒 View Cart
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            <?= session()->get('cart_count') ?? 0 ?>
        </span>
    </a>
</nav>

<div class="container mt-4">

    <div class="row">

        <?php foreach($products as $product): ?>
        <div class="col-md-3 mb-4">

            <div class="card shadow-sm">

                <?php if(!empty($product['images'])): ?>
                    <img class="card-img-top"
                         src="<?= base_url($product['images'][0]['image_path']) ?>"
                         style="height:200px; object-fit:cover;">
                <?php endif; ?>



                <div class="card-body text-center">
                    <h5><?= $product['name'] ?></h5>
                    <p class="fw-bold text-success">₹<?= $product['price'] ?></p>

                    <form method="post" action="<?= base_url('api/cart/add') ?>">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Add To Cart
                        </button>
                    </form>
                </div>

            </div>

        </div>
        <?php endforeach; ?>

    </div>

</div>

</body>
</html>
