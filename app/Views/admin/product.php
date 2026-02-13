<?php ob_start(); ?>

<h2>Products</h2>

<a href="#" class="btn btn-primary mb-3">Add Product</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Sample Product</td>
            <td>₹100</td>
            <td>
                <button class="btn btn-sm btn-warning">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
    </tbody>
</table>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin_layout.php';
?>
