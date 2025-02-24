<?php
// orders.php - Quản lý hóa đơn
include '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';

// Lấy danh sách hóa đơn
$query = "SELECT * FROM orders ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>

<div class="container">
    <h2>Quản lý Hóa Đơn</h2>
    <a href="add_order.php" class="btn btn-primary">Thêm Hóa Đơn</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách Hàng</th>
                <th>Ngày Đặt</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['customer_name'] ?></td>
                    <td><?= $row['order_date'] ?></td>
                    <td><?= number_format($row['total_price'], 0, ',', '.') ?> VND</td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="edit_order.php?id=<?= $row['id'] ?>" class="btn btn-warning">Sửa</a>
                        <a href="delete_order.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Xóa hóa đơn này?')">Xóa</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
