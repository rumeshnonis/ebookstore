<?php
// config/database.php

class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            self::$conn = new mysqli('localhost', 'root', '', 'ebookshop'); // Adjust your database credentials accordingly
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
?>
