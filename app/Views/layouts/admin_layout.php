<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; min-height:100vh;">
        <h4>Ecommerce Admin</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/ecommerce/public/index.php/admin/dashboard" class="nav-link text-white">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/public/index.php/admin/product" class="nav-link text-white">Products</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/public/index.php/admin/orders" class="nav-link text-white">Orders</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/public/index.php/logout" class="nav-link text-danger">Logout</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="p-4 w-100">
        <?= $content ?>
    </div>

</div>

</body>
</html>
