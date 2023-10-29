<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceName = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO services (name, description, price) VALUES ('$serviceName', '$description', $price)";
    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
        exit();
    }
}
?>

<h1>Thêm Dịch Vụ Mới</h1>
<form method="POST">
    <label for="service_name">Tên Dịch Vụ:</label>
    <input type="text" name="service_name" required>
    <label for="description">Mô tả:</label>
    <textarea name="description" required></textarea>
    <label for="price">Giá cả:</label>
    <input type="number" name="price" step="0.01" required>
    <button type="submit">Thêm Dịch Vụ</button>
</form>
