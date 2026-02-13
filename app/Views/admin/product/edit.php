<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3>Edit Product</h3>

    <form method="post" action="<?= base_url('admin/product/update/'.$product['id']) ?>">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                   value="<?= esc($product['name']) ?>" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" step="0.01" 
                   value="<?= $product['price'] ?>" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="1" <?= $product['status']==1?'selected':'' ?>>Active</option>
                <option value="0" <?= $product['status']==0?'selected':'' ?>>Inactive</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
