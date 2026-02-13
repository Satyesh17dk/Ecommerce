<?php ob_start(); ?>

<h2>Dashboard</h2>
<p>Welcome Admin</p>

<?php 
$content = ob_get_clean();
include __DIR__ . '/../layouts/admin_layout.php';
?>
