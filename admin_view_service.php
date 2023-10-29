<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    // Kiểm tra xem người dùng đã đăng nhập và có vai trò admin hay không
    header("Location: login.php");
    exit();
}

require_once 'connect.php';

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin dịch vụ dựa trên ID
    $query = "SELECT * FROM services WHERE id = $service_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $service = mysqli_fetch_assoc($result);
    } else {
        // Dịch vụ không tồn tại, xử lý theo ý của bạn
        header("Location: admin_manage_services.php");
        exit();
    }
} else {
    // ID dịch vụ không được cung cấp, xử lý theo ý của bạn
    header("Location: admin_manage_services.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết Dịch vụ</title>
</head>
<body>
    <h1>Chi tiết Dịch vụ</h1>
    <p>Tên Dịch vụ: <?php echo $service['name']; ?></p>
    <p>Mô tả Dịch vụ: <?php echo $service['description']; ?></p>
    <p>Giá cả Dịch vụ: <?php echo $service['price']; ?></p>
</body>
</html>
