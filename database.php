<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bookstore";

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra lỗi kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
