<!-- views/user/profile.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">User Profile</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <form action="/ebookstore/controllers/UserController.php?action=update_profile" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>

        <h3 class="mt-5">Address Book</h3>
        <a href="/ebookstore/views/user/add_address.php" class="btn btn-primary mb-3">Add Address</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($addresses as $address): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($address['id']); ?></td>
                        <td><?php echo htmlspecialchars($address['address']); ?></td>
                        <td>
                            <a href="/ebookstore/views/user/edit_address.php?id=<?php echo $address['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="/ebookstore/controllers/UserController.php?action=delete_address&id=<?php echo $address['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this address?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
