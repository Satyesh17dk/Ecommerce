<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3>Add Product</h3>

    <form method="post" action="<?= base_url('admin/product/store') ?>" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Product Images</label>
            <input type="file" name="images[]" class="form-control" multiple required>
        </div>


        <button class="btn btn-success">Save</button>
    </form>
</div>

</body>
</html>
