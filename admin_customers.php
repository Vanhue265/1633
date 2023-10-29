<?php
session_start();

// Kiểm tra vai trò của người dùng. Chỉ admin mới có quyền truy cập trang này.
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu không phải admin.
    exit();
}

require_once 'connect.php'; // Sử dụng tệp kết nối cơ sở dữ liệu.

// Truy vấn cơ sở dữ liệu để lấy danh sách khách hàng (is_admin = 0 cho người dùng không phải admin).
$query = "SELECT * FROM users WHERE is_admin = 0";
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách khách hàng</title>
</head>
<body>
    <h1>Danh sách khách hàng</h1>
    <table>
        <tr>
            <th>Tên</th>
            <th>Địa chỉ</th>
            <th>Email</th>
        </tr>
        <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer['username']; ?></td>
                <td><?php echo isset($customer['address']) ? $customer['address'] : 'N/A'; ?></td>
                <td><?php echo isset($customer['email']) ? $customer['email'] : 'N/A'; ?></td>
                <td>
                    <a href="admin_customer_appointments.php?customer_id=<?php echo $customer['id']; ?>">Xem lịch hẹn</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="admin_dashboard.php">Quay lại trang dashboard</a>
</body>
</html>

