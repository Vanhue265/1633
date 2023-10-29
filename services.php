<?php
session_start();

// Include file kết nối cơ sở dữ liệu
require_once 'connect.php';

// Truy vấn cơ sở dữ liệu để lấy danh sách các dịch vụ
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);

$services = array(); // Mảng để lưu danh sách dịch vụ

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách dịch vụ</title>
</head>
<body>
    <h1>Danh sách dịch vụ chăm sóc thú nuôi</h1>
    <ul>
        <?php foreach ($services as $service) : ?>
            <li>
                <h2><?php echo $service['name']; ?></h2>
                <p><?php echo $service['description']; ?></p>
                <p>Giá: <?php echo $service['price']; ?></p>
                <a href="service_info.php?service_id=<?php echo $service['id']; ?>">Đặt lịch hẹn</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="customer_dashboard.php">Quay lại trang dashboard</a>
</body>
</html>
