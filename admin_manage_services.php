<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    // Kiểm tra xem người dùng đã đăng nhập và có vai trò admin hay không
    header("Location: login.php");
    exit();
}

require_once 'connect.php';

// Truy vấn cơ sở dữ liệu để lấy danh sách dịch vụ
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);

$services = array(); // Mảng để lưu danh sách dịch vụ

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }
}

// Xử lý chức năng xóa dịch vụ
if (isset($_GET['delete'])) {
    $service_id = $_GET['delete'];
    $delete_query = "DELETE FROM services WHERE id = $service_id";
    mysqli_query($conn, $delete_query);
    header("Location: admin_manage_services.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Dịch vụ</title>
</head>
<body>
    <h1>Quản lý Dịch vụ</h1>
    <ul>
        <?php foreach ($services as $service) : ?>
            <li>
                <a href="admin_view_service.php?id=<?php echo $service['id']; ?>"><?php echo $service['name']; ?></a>
                <a href="admin_edit_service.php?id=<?php echo $service['id']; ?>">Sửa</a>
                <a href="admin_manage_services.php?delete=<?php echo $service['id']; ?>">Xóa</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="admin_add_service.php">Thêm Dịch vụ</a>
</body>
</html>
