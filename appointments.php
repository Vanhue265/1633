<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['appointment_id'])) {
    $appointment_id = $_POST['appointment_id'];
    
    // Cập nhật trạng thái thành "Đã thanh toán" trong cơ sở dữ liệu
    $update_query = "UPDATE appointments SET is_paid = 1 WHERE id = $appointment_id";
    if (mysqli_query($conn, $update_query)) {
        // Trạng thái đã được cập nhật thành công
    } else {
        $error_message = "Lỗi khi cập nhật trạng thái.";
    }
}

$query = "SELECT appointments.*, services.name AS service_name 
          FROM appointments 
          INNER JOIN services ON appointments.service_id = services.id 
          WHERE appointments.user_id = $user_id";
$result = mysqli_query($conn, $query);
$appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách lịch hẹn của bạn</title>
</head>
<body>
    <h1>Danh sách lịch hẹn của bạn</h1>

    <ul>
        <?php foreach ($appointments as $appointment) : ?>
            <li>
                <h3><?php echo $appointment['service_name']; ?></h3>
                <p>Ngày: <?php echo $appointment['appointment_date']; ?></p>
                <p>Giờ: <?php echo $appointment['appointment_time']; ?></p>
                <p>Trạng thái: <?php echo ($appointment['is_paid'] ? 'Đã thanh toán' : 'Chưa thanh toán'); ?></p>
                <?php if (!$appointment['is_paid']) : ?>
                    <form method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                        <button type="submit">Thanh toán</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="customer_dashboard.php">Quay lại trang dashboard</a>
</body>
</html>
