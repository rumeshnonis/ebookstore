<?php
// models/Product.php

// include_once '../config/database.php';

class Product {
    private $conn;
    private $table = 'products';

    public function __construct() {
        $this->conn = Database::getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->conn->query($sql);

        if ($result === false) {
            echo "Error in SQL query: " . $this->conn->error . "<br>";
            return [];
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addProduct($name, $description, $price, $category, $image) {
        $sql = "INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdss", $name, $description, $price, $category, $image);
        return $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $category, $image) {
        $sql = "UPDATE products SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdssi", $name, $description, $price, $category, $image, $id);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getFeaturedProducts() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE is_featured = 1 LIMIT 6';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestProducts() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC LIMIT 6';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>
