<?php
// models/Address.php

include_once '../config/database.php';

class Address {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function addAddress($user_id, $address) {
        $sql = "INSERT INTO addresses (user_id, address) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $address);
        return $stmt->execute();
    }

    public function updateAddress($address_id, $user_id, $address) {
        $sql = "UPDATE addresses SET address = ? WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sii", $address, $address_id, $user_id);
        return $stmt->execute();
    }

    public function deleteAddress($address_id, $user_id) {
        $sql = "DELETE FROM addresses WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $address_id, $user_id);
        return $stmt->execute();
    }

    public function getUserAddresses($user_id) {
        $sql = "SELECT * FROM addresses WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
