<?php
// Import file kết nối database
require_once 'db_connect.php';

// Khởi tạo biến để hiển thị lỗi (nếu có)
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Truy vấn kiểm tra tài khoản
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Tránh SQL Injection
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Nếu đăng nhập thành công, chuyển hướng sang trang chính
        header("Location: main.html");
        exit();
    } else {
        $error_message = "Tài khoản hoặc mật khẩu không đúng!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản Lý Nhà Sách</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="header">
    <div class="logo">
      <img alt="Logo" height="30" src="https://storage.googleapis.com/a1aa/image/aqDe1fMYnRvPk0uFXkxEogdGWEf3ExCPL35A9TejJQm1QGdQB.jpg" width="30">
      <span>QUẢN LÝ NHÀ SÁCH</span>
    </div>
    <div class="language">
      Ngôn ngữ:
      <select>
        <option>Tiếng Việt</option>
        <option>Chọn ngôn ngữ khác</option>
      </select>
    </div>
  </div>
  <div class="login-container">
    <h2>ĐĂNG NHẬP</h2>
    <?php if (!empty($error_message)): ?>
      <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
      <input name="username" placeholder="Tài khoản" type="text" required>
      <input name="password" placeholder="Mật khẩu" type="password" required>
      <div class="button">
      <a href="index.php" class="btn-login">Đăng Nhập</a>
      <a href="" class="btn-close">Đóng</a>
    </div>
    </form>
  </div>
</body>
</html>
