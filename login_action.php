<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn kiểm tra user có trong database không
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Nếu tìm thấy user, tạo session
    if ($result->num_rows == 1) {
        $_SESSION['user'] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>alert('Sai tài khoản hoặc mật khẩu');</script>";
    }
}
?>
