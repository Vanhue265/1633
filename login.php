<?php
session_start();

require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['is_admin'] ? "admin" : "customer";

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
  <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="resource/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Login</h1>
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
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>
  </div>
</body>
</html>