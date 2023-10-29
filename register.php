<?php
session_start();

require_once 'connect.php'; // Sử dụng tệp connect.php để kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_admin = ($_POST['role'] === "admin") ? 1 : 0; // Nếu chọn "admin", sử dụng 1, ngược lại sử dụng 0

    $query = "INSERT INTO users (username, password, is_admin) VALUES ('$username', '$password', $is_admin)";
    if (mysqli_query($conn, $query)) {
        // Đăng ký thành công, bạn có thể chuyển hướng người dùng đến trang đăng nhập hoặc hiển thị thông báo thành công.
    } else {
        $error_message = "Lỗi khi đăng ký tài khoản.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
</head>
<body>
    <h1>Đăng ký</h1>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>
        <label for="role">Vai trò:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="customer">Khách hàng</option>
        </select>
        <button type="submit">Đăng ký</button>
    </form>
</body>
</html>
