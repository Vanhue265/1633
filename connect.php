<?php
$host = "localhost"; // Địa chỉ máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$database = "asm3"; // Tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
$conn = mysqli_connect($host, $username, $password, $database);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối không thành công: " . mysqli_connect_error());
}
?>
