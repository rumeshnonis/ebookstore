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
    <div class="container">
        <h2 class="mt-5">Admin Dashboard</h2>
        <ul>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_products">Manage Products</a></li>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_orders">Manage Orders</a></li>
            <li><a href="/ebookstore/controllers/AdminController.php?action=manage_users">Manage Users</a></li>
        </ul>
    </div>
</body>
</html>
