<?php
session_start();

require_once 'connect.php'; // Sử dụng tệp connect.php để kết nối đến cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['is_admin'] ? "admin" : "customer"; // Sử dụng "is_admin" để xác định vai trò

        if ($user['is_admin']) {
            header("Location: admin_dashboard.php");
            exit();
        } else {
            header("Location: customer_dashboard.php");
            exit();
        }
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" required>
        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>
        <button type="submit">Đăng nhập</button>
    </form>
</body>
</html>
