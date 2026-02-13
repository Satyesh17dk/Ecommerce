<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3>Product List</h3>

    <a href="<?= base_url('admin/product/create') ?>" class="btn btn-primary mb-3">
        Add Product
    </a>

    <table class="table table-bordered bg-white">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
            <th>Images</th>

        </tr>

        <?php foreach($products as $key => $product): ?>
        <tr>
            <td><?= $key+1 ?></td>
            <td><?= esc($product['name']) ?></td>
            <td>₹<?= $product['price'] ?></td>
            <td>
                <?= $product['status'] == 1 ? 'Active' : 'Inactive' ?>
            </td>
            <td>
                <a href="<?= base_url('admin/product/edit/'.$product['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="<?= base_url('admin/product/delete/'.$product['id']) ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this product?')">
                   Delete
                </a>
            </td>
            <td>
                <?php if(!empty($product['images'])): ?>
                    <?php foreach($product['images'] as $img): ?>
                        <img src="<?= base_url($img['image_path']) ?>" width="50" height="50">
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>

        </tr>
        <?php endforeach; ?>

    </table>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary">
        Back
    </a>
</div>

</body>
</html>
