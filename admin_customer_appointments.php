<?php
session_start();

// Kiểm tra vai trò của người dùng. Chỉ admin mới có quyền truy cập trang này.
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu không phải admin.
    exit();
}

require_once 'connect.php'; // Sử dụng tệp kết nối cơ sở dữ liệu.

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];

    // Truy vấn cơ sở dữ liệu để lấy danh sách lịch hẹn của khách hàng cụ thể.
    $query = "SELECT * FROM appointments WHERE user_id = $customer_id";
    $result = mysqli_query($conn, $query);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Xử lý khi không có ID khách hàng được cung cấp.
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lịch hẹn của khách hàng</title>
</head>
<body>
    <h1>Lịch hẹn của khách hàng</h1>
    <table>
        <tr>
            <th>Ngày</th>
            <th>Giờ</th>
            <th>Trạng thái</th>
        </tr>
        <?php foreach ($appointments as $appointment) : ?>
            <tr>
                <td><?php echo $appointment['appointment_date']; ?></td>
                <td><?php echo $appointment['appointment_time']; ?></td>
                <td><?php echo ($appointment['is_paid'] ? 'Đã thanh toán' : 'Chưa thanh toán'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="admin_customers.php">Quay lại danh sách khách hàng</a>
    <a href="admin_dashboard.php">Quay lại trang dashboard</a>
</body>
</html>
