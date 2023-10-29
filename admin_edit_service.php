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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_service_name = $_POST['service_name'];
    $new_service_description = $_POST['service_description'];
    $new_service_price = $_POST['service_price'];

    $update_query = "UPDATE services SET name = '$new_service_name', description = '$new_service_description', price = $new_service_price WHERE id = $service_id";
    if (mysqli_query($conn, $update_query)) {
        // Cập nhật thành công, bạn có thể chuyển hướng hoặc hiển thị thông báo thành công
        header("Location: admin_manage_services.php");
        exit();
    } else {
        $error_message = "Lỗi khi cập nhật dịch vụ.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa Dịch vụ</title>
</head>
<body>
    <h1>Sửa Dịch vụ</h1>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="service_name">Tên Dịch vụ:</label>
        <input type="text" name="service_name" value="<?php echo $service['name']; ?>" required>
        <label for="service_description">Mô tả Dịch vụ:</label>
        <textarea name="service_description" required><?php echo $service['description']; ?></textarea>
        <label for="service_price">Giá cả Dịch vụ:</label>
        <input type="number" name="service_price" value="<?php echo $service['price']; ?>" required>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
