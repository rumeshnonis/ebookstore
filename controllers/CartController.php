<?php
// controllers/CartController.php

include_once '../config/database.php';
include_once '../models/Product.php';

class CartController {
    public function addToCart() {
        session_start();
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $product = new Product();
        $product_details = $product->getProductById($product_id);

        if (!$product_details) {
            header('Location: /ebookstore/views/products/product_list.php?error=' . urlencode('Product not found.'));
            exit();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cart_item = [
            'id' => $product_details['id'],
            'name' => $product_details['name'],
            'price' => $product_details['price'],
            'quantity' => $quantity
        ];

        $_SESSION['cart'][] = $cart_item;
        header('Location: /ebookstore/views/cart/cart.php?success=' . urlencode('Product added to cart.'));
    }

    public function updateCart() {
        session_start();
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        header('Location: /ebookstore/views/cart/cart.php?success=' . urlencode('Cart updated.'));
    }

    public function removeFromCart() {
        session_start();
        $product_id = $_GET['product_id'];

        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }

        header('Location: /ebookstore/views/cart/cart.php?success=' . urlencode('Product removed from cart.'));
    }
}

// Router logic to handle requests
if (isset($_GET['action'])) {
    $controller = new CartController();
    switch ($_GET['action']) {
        case 'add':
            $controller->addToCart();
            break;
        case 'update':
            $controller->updateCart();
            break;
        case 'remove':
            $controller->removeFromCart();
            break;
        default:
            // Optionally handle unexpected actions
            header('Location: /ebookstore/views/cart/cart.php?error=' . urlencode('Invalid action.'));
            break;
    }
}
?>
