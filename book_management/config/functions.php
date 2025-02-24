<?php
include 'database.php';

// Hàm lấy danh sách sách
function getAllBooks() {
    global $conn;
    $sql = "SELECT * FROM books";
    return $conn->query($sql);
}

// Hàm thêm sách mới
function addBook($title, $author, $price, $stock) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO books (title, author, price, stock) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $title, $author, $price, $stock);
    return $stmt->execute();
}

// Hàm xóa sách
function deleteBook($bookId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $bookId);
    return $stmt->execute();
}

// Hàm lấy danh sách khách hàng
function getAllCustomers() {
    global $conn;
    $sql = "SELECT * FROM customers";
    return $conn->query($sql);
}
?>
