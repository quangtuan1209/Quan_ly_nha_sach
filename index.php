<?php
// Kết nối cơ sở dữ liệu
require_once 'db_connect.php';

// Thông báo lỗi hoặc thành công
$message = "";

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_book'])) {
        // Lấy dữ liệu từ form
        $maSach = $_POST['ma_sach'] ?? '';
        $tenSach = $_POST['ten_sach'] ?? '';
        $tacGia = $_POST['tac_gia'] ?? '';
        $donGia = $_POST['don_gia'] ?? '';
        $nhaXuatBan = $_POST['nha_xuat_ban'] ?? '';
        $theLoai = $_POST['the_loai'] ?? '';

        // Kiểm tra dữ liệu không được để trống
        if ($maSach && $tenSach && $tacGia && $donGia && $nhaXuatBan && $theLoai) {
            // Chèn vào cơ sở dữ liệu
            $stmt = $conn->prepare("INSERT INTO books (ma_sach, ten_sach, tac_gia, don_gia, nha_xuat_ban, the_loai) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $maSach, $tenSach, $tacGia, $donGia, $nhaXuatBan, $theLoai);
            if ($stmt->execute()) {
                $message = "Thêm sách thành công!";
            } else {
                $message = "Thêm sách thất bại: " . $conn->error;
            }
        } else {
            $message = "Vui lòng nhập đầy đủ thông tin!";
        }
    }

    // Cập nhật sách (nếu có)
    if (isset($_POST['update_book'])) {
        $maSach = $_POST['ma_sach'] ?? '';
        $tenSach = $_POST['ten_sach'] ?? '';
        $tacGia = $_POST['tac_gia'] ?? '';
        $donGia = $_POST['don_gia'] ?? '';
        $nhaXuatBan = $_POST['nha_xuat_ban'] ?? '';
        $theLoai = $_POST['the_loai'] ?? '';

        // Kiểm tra dữ liệu không được để trống
        if ($maSach && $tenSach && $tacGia && $donGia && $nhaXuatBan && $theLoai) {
            // Cập nhật vào cơ sở dữ liệu
            $stmt = $conn->prepare("UPDATE books SET ten_sach = ?, tac_gia = ?, don_gia = ?, nha_xuat_ban = ?, the_loai = ? WHERE ma_sach = ?");
            $stmt->bind_param("ssssss", $tenSach, $tacGia, $donGia, $nhaXuatBan, $theLoai, $maSach);
            if ($stmt->execute()) {
                $message = "Cập nhật sách thành công!";
            } else {
                $message = "Cập nhật sách thất bại: " . $conn->error;
            }
        } else {
            $message = "Vui lòng nhập đầy đủ thông tin!";
        }
    }

    // Xóa sách
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_book'])) {
        $maSach = $_POST['delete_book'];
        $stmt = $conn->prepare("DELETE FROM books WHERE ma_sach = ?");
        $stmt->bind_param("s", $maSach);
        if ($stmt->execute()) {
            $message = "Xóa sách thành công!";
        } else {
            $message = "Xóa sách thất bại: " . $conn->error;
        }
    }
    
}


// Lấy dữ liệu sách từ cơ sở dữ liệu
$result = $conn->query("SELECT * FROM books");
$books = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhà sách</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="layout.css">
</head>
<body>
    <div class="header">
        <div class="title">Quản lý nhà sách</div>
        <div class="header-icons">
            <a href="login.php"><i class="fas fa-times"></i></a>
        </div>
    </div>
    <div class="sidebar">
    <ul>
            <li onclick="toggleSubMenu(this)">
                <i class="fas fa-book"></i> Sách
                <i class="fas fa-chevron-right arrow"></i>
                <ul>
                    <li><a href="quanly_sach.php"><i class=""></i> Dữ liệu sách</a></li>
                    <li><a href="nhap_sach.php"><i class=""></i> Nhập sách</a></li>
                    <li><a href="ban_sach.php"><i class=""></i>Bán sách</a></li>
                    <li><a href="timkiem_sach.php"><i class=""></i>Tìm kiếm sách</a></li>
                </ul>
            </li>
            <li onclick="toggleSubMenu(this)">
                <i class="fas fa-user"></i> Khách hàng
                <i class="fas fa-chevron-right arrow"></i>
                <ul>
                    <li><a href="thu-tien.php"><i class=""></i> Thu tiền</a></li>
                    <li><a href="search_khach"><i class=""></i> Tìm kiếm khách</a></li>
                    
                </ul>
            </li>
            <li onclick="toggleSubMenu(this)">
                <i class="fas fa-chart-bar"></i> Báo cáo
                <i class="fas fa-chevron-right arrow"></i>
                <ul>
                    <li><a href="baocao_ton.php"><i class=""></i> Báo cáo tồn</a></li>
                    <li><a href="baocao_congno.php"><i class=""></i> Báo cáo công nợ</a></li>
                </ul>
            </li>
            <li><i class="fas fa-cog"></i> Tùy chỉnh</li>
        </ul>
    </div>

    </div>
    <div class="main-content">
        <h2>Quản lý thông tin sách</h2>
        <div class="buttons">
    <!-- Khi nhấn nút, sẽ gọi hàm JavaScript để hiển thị form và ẩn thông báo -->
    <button onclick="showAddForm()">Thêm Sách</button>
    <button onclick="document.querySelector('.input-form').style.display = 'none';">Cập Nhật Sách</button>
</div>

<!-- Phần thông báo -->
<?php if (!empty($message)): ?>
    <p id="message" style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<script>
    // Hàm hiển thị form thêm sách và ẩn thông báo
    function showAddForm() {
        document.querySelector('.input-form').style.display = 'block'; // Hiện form thêm sách
        const messageElement = document.getElementById('message'); // Lấy phần tử thông báo
        if (messageElement) {
            messageElement.style.display = 'none'; // Ẩn thông báo
        }
    }
</script>

        <div class="input-form">
            <form action="" method="POST">
                <div class="form-group">
                    <input type="text" name="ma_sach" placeholder="Mã Sách" required>
                    <input type="text" name="ten_sach" placeholder="Tên Sách" required>
                    <input type="text" name="tac_gia" placeholder="Tác Giả" required>
                    <input type="text" name="don_gia" placeholder="Đơn Giá" required>
                    <input type="text" name="nha_xuat_ban" placeholder="Nhà Xuất Bản" required>
                    <input type="text" name="the_loai" placeholder="Thể Loại" required>
                </div>
                <div class="buttons">
                    <button type="submit" name="add_book">Lưu</button>
                    <button type="button" onclick="document.querySelector('.input-form').style.display = 'none';">Hủy</button>
                </div>
            </form>
        </div>

        <!-- Hiển thị danh sách sách -->
        <h3>Danh sách sách</h3>
        <table>
            <thead>
                <tr>
                    <th>Mã Sách</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Đơn Giá</th>
                    <th>Nhà Xuất Bản</th>
                    <th>Thể Loại</th>
                    <th>Thực hiện</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?= htmlspecialchars($book['ma_sach']) ?></td>
                        <td><?= htmlspecialchars($book['ten_sach']) ?></td>
                        <td><?= htmlspecialchars($book['tac_gia']) ?></td>
                        <td><?= htmlspecialchars($book['don_gia']) ?></td>
                        <td><?= htmlspecialchars($book['nha_xuat_ban']) ?></td>
                        <td><?= htmlspecialchars($book['the_loai']) ?></td>
                        <td>
                    <!-- Nút sửa -->
                    <a href="edit_book.php?ma_sach=<?= $book['ma_sach'] ?>" class="edit-btn">Sửa</a>

                    <!-- Nút xóa -->
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="delete_book" value="<?= $book['ma_sach'] ?>">
                        <button type="submit" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không?');">Xoá</button>
                    </form>
                </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <script>
        function toggleSubMenu(event) {
            const subMenu = event.target.nextElementSibling;
            if (subMenu.style.display === "none" || subMenu.style.display === "") {
                subMenu.style.display = "block";
            } else {
                subMenu.style.display = "none";
            }
        }
    </script>
    <script>
        function toggleSubMenu(element) {
            element.classList.toggle('active');
        }
    </script>
    </div>
</body>
</html>