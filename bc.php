<?php
if (isset($_POST['save'])) {
    // Lấy dữ liệu từ form
    $minImport = $_POST['minImport'];
    $maxStockBeforeImport = $_POST['maxStockBeforeImport'];
    $maxDebt = $_POST['maxDebt'];
    $minStockAfterSell = $_POST['minStockAfterSell'];
    $limitPayment = isset($_POST['limitPayment']) ? 1 : 0;

    // Lưu trữ dữ liệu (ví dụ: vào file hoặc cơ sở dữ liệu)
    $data = "Số lượng nhập ít nhất: $minImport\n";
    $data .= "Lượng tồn tối đa trước khi nhập: $maxStockBeforeImport\n";
    $data .= "Tiền nợ tối đa: $maxDebt\n";
    $data .= "Lượng tồn tối thiểu sau khi bán: $minStockAfterSell\n";
    $data .= "Sử dụng quy định số tiền thu: $limitPayment\n";

    file_put_contents('rules.txt', $data);

    echo "Đã lưu thay đổi.";
}

if (isset($_POST['default'])) {
    // Đặt lại giá trị mặc định
    $data = "Số lượng nhập ít nhất: 0\n";
    $data .= "Lượng tồn tối đa trước khi nhập: 0\n";
    $data .= "Tiền nợ tối đa: 0\n";
    $data .= "Lượng tồn tối thiểu sau khi bán: 0\n";
    $data .= "Sử dụng quy định số tiền thu: 0\n";

    file_put_contents('rules.txt', $data);

    echo "Đã khôi phục cài đặt mặc định.";
}
?>