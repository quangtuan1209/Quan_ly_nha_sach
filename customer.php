/* customers.php */
<?php
include '../config/database.php';
include '../includes/header.php';

$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);
?>
<h2>Quản lý khách hàng</h2>
<a href="add_customer.php">Thêm khách hàng</a>
<table>
    <tr>
        <th>ID</th><th>Tên</th><th>Email</th><th>Điện thoại</th><th>Hành động</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['phone'] ?></td>
        <td>
            <a href="edit_customer.php?id=<?= $row['id'] ?>">Sửa</a>
            <a href="delete_customer.php?id=<?= $row['id'] ?>">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>

/* orders.php */
<?php
include '../config/database.php';
include '../includes/header.php';

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>
<h2>Quản lý hóa đơn</h2>
<table>
    <tr>
        <th>ID</th><th>Khách hàng</th><th>Ngày</th><th>Tổng tiền</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['customer_id'] ?></td>
        <td><?= $row['date'] ?></td>
        <td><?= $row['total'] ?></td>
    </tr>
    <?php } ?>
</table>
<?php include '../includes/footer.php'; ?>

/* add_customer.php */
<?php
include '../config/database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $query = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
    mysqli_query($conn, $query);
    header('Location: customers.php');
}
?>
<form method="post">
    <input type="text" name="name" placeholder="Tên khách hàng">
    <input type="email" name="email" placeholder="Email">
    <input type="text" name="phone" placeholder="Số điện thoại">
    <button type="submit">Thêm</button>
</form>

/* edit_customer.php */
<?php
include '../config/database.php';
$id = $_GET['id'];
$query = "SELECT * FROM customers WHERE id = $id";
$result = mysqli_query($conn, $query);
$customer = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    $query = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    mysqli_query($conn, $query);
    header('Location: customers.php');
}
?>
<form method="post">
    <input type="text" name="name" value="<?= $customer['name'] ?>">
    <input type="email" name="email" value="<?= $customer['email'] ?>">
    <input type="text" name="phone" value="<?= $customer['phone'] ?>">
    <button type="submit">Cập nhật</button>
</form>

/* delete_customer.php */
<?php
include '../config/database.php';
$id = $_GET['id'];
$query = "DELETE FROM customers WHERE id = $id";
mysqli_query($conn, $query);
header('Location: customers.php');
