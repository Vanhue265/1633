<?php
require_once 'connect.php';

// Lấy thống kê
$query = "SELECT COUNT(*) as total_services FROM services";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalServices = $row['total_services'];

// Hiển thị thông tin thống kê
?>

<h1>Dashboard Admin</h1>
<p>Tổng số dịch vụ: <?php echo $totalServices; ?></p>
    <ul>
        <li><a href="login.php">Đăng nhập</a></li>
        <li><a href="register.php">Đăng ký</a></li>
        <li><a href="logout.php">Đăng xuất</a></li>
    </ul>
<!-- Hiển thị thêm thông tin thống kê ở đây -->

<li><a href="admin_manage_services.php">Danh sach dich vu</a></li>
<li><a href="admin_customers.php">Danh sách lịch hẹn của khách hàng</a></li>



