<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-box p-4 shadow rounded bg-white">
        <h2 class="text-center mb-4">Đăng nhập</h2>
        <form action="actions/login_action.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </div>
            <div class="text-center mt-3">
                <a href="#" class="btn btn-danger w-100">Thoát</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

