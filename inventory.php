<?php
// Kết nối cơ sở dữ liệu
$conn = new mysqli("localhost", "username", "password", "book_management");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    // Kiểm tra xem sách đã tồn tại chưa (tùy chọn)
    $check_sql = "SELECT * FROM books WHERE title = '$title' AND author = '$author'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        echo "Sách đã tồn tại!";
    } else {
        $sql = "INSERT INTO books (title, author, price, quantity) VALUES ('$title', '$author', $price, $quantity)";

        if ($conn->query($sql) === TRUE) {
            echo "Thêm sách thành công";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nhập sách</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Nhập sách</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Tên sách:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="author">Tác giả:</label>
        <input type="text" name="author" id="author"><br>

        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" min="0"><br>

        <label for="quantity">Số lượng:</label>
        <input type="number" name="quantity" id="quantity" min="0"><br>

        <input type="submit" value="Thêm">
    </form>
</body>
</html>