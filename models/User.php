<?php
// models/User.php

// include_once '../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function updateProfile($user_id, $username, $email) {
        $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $email, $user_id);
        return $stmt->execute();
    }

    public function register($username, $email, $password, $role) {
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $role);
        return $stmt->execute();
    }

    public function login($email) {
        $sql = "SELECT id, username, password, role FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $exists = $stmt->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function storeToken($email, $token) {
        $sql = "UPDATE users SET reset_token = ?, reset_token_expire = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        return $stmt->execute();
    }

    public function resetPassword($token, $hashed_password) {
        $sql = "UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = ? AND reset_token_expire > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $hashed_password, $token);
        return $stmt->execute();
    }
}
?>
