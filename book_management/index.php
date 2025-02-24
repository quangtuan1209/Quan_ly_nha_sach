<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Quản lý nhà sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toggles = document.querySelectorAll('.sidebar ul li a');
            toggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    var submenu = this.nextElementSibling;
                    if (submenu && submenu.tagName === 'UL') {
                        e.preventDefault();
                        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="header">
        <div class="header-title">
            Quản lý nhà sách
        </div>
        <div class="header-icons">
            <a href="login.php">
                <i class="fas fa-circle"></i>
            </a>
            <i class="fas fa-circle"></i>
            <i class="fas fa-circle"></i>
        </div>
    </div>
    <div class="title-box">
        <img alt="Book icon" height="50" src="https://storage.googleapis.com/a1aa/image/wYs3i6yIIGeMJ39SQlO8G-eNUJCOd91zS2DXkK3GCXU.jpg" width="50"/>
        <h1>QUẢN LÝ NHÀ SÁCH</h1>
    </div>
    <div class="main">
    <?php require 'includes/navbar.php'; ?>
        <div class="content">
        </div>
    </div>
</body>
</html>

