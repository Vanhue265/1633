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
    <title>List of your appointments</title>
    <link rel="stylesheet" type="text/css" href="css/Flowerf.css">
</head>
<body class"AppointmentsBody">
    <h1>List of your appointments</h1>

    <ul>
        <?php foreach ($appointments as $appointment) : ?>
            <li>
                <h3 Class="ServiceName"><?php echo $appointment['service_name']; ?></h3>
                <p>Date: <?php echo $appointment['appointment_date']; ?></p>
                <p>Time: <?php echo $appointment['appointment_time']; ?></p>
                <p>Status: <?php echo ($appointment['is_paid'] ? 'Paid' : 'Unpaid'); ?></p>
                <?php if (!$appointment['is_paid']) : ?>
                    <form method="POST">
                        <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                        <button class="BtnSubmit" type="submit">Check Out</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <a class="Back" href="customer_dashboard.php">Go to dashboard</a>
</body>
</html>
