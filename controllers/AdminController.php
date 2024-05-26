<?php
// controllers/AdminController.php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config/database.php';
include_once '../models/Product.php';

class AdminController {
    public function manageProducts() {
        // echo "manageProducts method called.<br>";

        $productModel = new Product();
        $products = $productModel->getAllProducts();

        include '../views/admin/manage_products.php';
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['image']['name'];
            $target = "../assets/images/" . basename($image);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $product = new Product();
                if ($product->addProduct($name, $description, $price, $category, $image)) {
                    header('Location: /ebookstore/controllers/AdminController.php?action=manage_products&&success=' . urlencode('Product added successfully!'));
                } else {
                    header('Location: /ebookstore/views/admin/add_product.php?error=' . urlencode('Failed to add product.'));
                }
            } else {
                header('Location: /ebookstore/views/admin/add_product.php?error=' . urlencode('Failed to upload image.'));
            }
        } else {
            include '../views/admin/add_product.php';
        }
    }

    public function editProduct() {
        $product = (new Product())->getProductById($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $product['image'];

            if ($_FILES['image']['name']) {
                $image = $_FILES['image']['name'];
                $target = "../assets/images/" . basename($image);
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    header('Location: /ebookstore/views/admin/edit_product.php?id=' . $_GET['id'] . '&error=' . urlencode('Failed to upload image.'));
                    exit();
                }
            }

            $productModel = new Product();
            if ($productModel->updateProduct($_GET['id'], $name, $description, $price, $category, $image)) {
                header('Location: /ebookstore/controllers/AdminController.php?action=manage_products&&success=' . urlencode('Product updated successfully!'));
            } else {
                header('Location: /ebookstore/views/admin/edit_product.php?id=' . $_GET['id'] . '&error=' . urlencode('Failed to update product.'));
            }
        } else {
            include '../views/admin/edit_product.php';
        }
    }

    public function deleteProduct() {
        if (isset($_GET['id'])) {
            $productModel = new Product();
            if ($productModel->deleteProduct($_GET['id'])) {
                header('Location: /ebookstore/controllers/AdminController.php?action=manage_products&&success=' . urlencode('Product deleted successfully!'));
            } else {
                header('Location: /ebookstore/controllers/AdminController.php?action=manage_products&&error=' . urlencode('Failed to delete product.'));
            }
        } else {
            header('Location: /ebookstore/views/admin/manage_products.php');
        }
    }

    public function manageOrders() {
        include '../views/admin/manage_orders.php';
    }

    public function manageUsers() {
        include '../views/admin/manage_users.php';
    }
}

// Router logic to handle requests
if (isset($_GET['action'])) {
    session_start();
    if ($_SESSION['user_role'] !== 'admin') {
        header('Location: /ebookstore/views/auth/login.php?error=' . urlencode('You do not have permission to access this page.'));
        exit();
    }

    $controller = new AdminController();
    switch ($_GET['action']) {
        case 'dashboard':
            $controller->dashboard();
            break;
        case 'manage_products':
            $controller->manageProducts();
            break;
        case 'add_product':
            $controller->addProduct();
            break;
        case 'edit_product':
            $controller->editProduct();
            break;
        case 'delete_product':
            $controller->deleteProduct();
            break;
        case 'manage_orders':
            $controller->manageOrders();
            break;
        case 'manage_users':
            $controller->manageUsers();
            break;
        default:
            header('Location: /ebookstore/views/admin/dashboard.php');
            break;
    }
}
?>
