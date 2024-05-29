<?php
// index.php at the root

// Start the session
session_start();

// Define base path
define('BASE_PATH', __DIR__);

// Include necessary files
require_once 'config/database.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/ProductController.php';
// Add other controllers as needed

// Get the request URI
$request_uri = $_SERVER['REQUEST_URI'];

// Debugging output
echo "<!-- Request URI: $request_uri -->";

// Route the request to the appropriate controller
switch ($request_uri) {
    case '/ebookstore/':
    case '/ebookstore/index.php':
        include 'views/index.php';
        break;
    case '/ebookstore/login':
        $authController = new AuthController();
        $authController->login();
        break;
    case '/ebookstore/register':
        $authController = new AuthController();
        $authController->register();
        break;
    case '/ebookstore/shop':
    case '/ebookstore/shop/':
        include 'views/shop.php';
        break;
    // Add more routes as needed
    default:
        http_response_code(404);
        echo "Page not found";
        break;
}
?>
