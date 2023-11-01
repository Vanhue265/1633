<?php
session_start();

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_admin = ($_POST['role'] === "admin") ? 1 : 0;

    $query = "INSERT INTO users (username, password, is_admin) VALUES ('$username', '$password', $is_admin)";
    if (mysqli_query($conn, $query)) {
        // Registration successful, you can redirect the user to the login page or display a success message.
    } else {
        $error_message = "Error while registering the account.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="resource/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Đăng ký</h1>
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Vai trò:</label>
                <select class="form-select" name="role">
                    <option value="admin">Admin</option>
                    <option value="customer">Khách hàng</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
</body>
</html>