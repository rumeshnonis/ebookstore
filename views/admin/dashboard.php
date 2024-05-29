<?php
// Ensure the user is logged in and is an admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /ebookstore/views/auth/login.php?error=' . urlencode('You do not have permission to access this page.'));
    exit();
}
?>

<!-- views/admin/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header_admin.php'; ?>
    <?php include '../includes/sidebar_admin.php'; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="container">
        <h2 class="mt-5">Admin Dashboard</h2>
        <ul>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_products">Manage Products</a></li>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_orders">Manage Orders</a></li>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_users">Manage Users</a></li>
        </ul>
    </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
    feather.replace()
    </script>

</body>
</html>
