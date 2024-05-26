<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'config/database.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $conn = Database::getConnection();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE users SET confirmed = 1 WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        header('Location: views/auth/login.php?success=' . urlencode('Email confirmed! You can now login.'));
    } else {
        echo "Failed to confirm email.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No email provided.";
}
?>
