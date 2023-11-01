<?php
session_start();
require_once 'connect.php';
include 'customer_dashboard.php';

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
    <link rel="stylesheet" href="resource/css/Flowerf.css">
</head>

<body class"AppointmentsBody">
    <h1 class="Title">List of your appointments</h1>

    <table class="aptbl">
        <tr>
            <th>Service Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        <?php foreach ($appointments as $appointment) : ?>
            <tr>
                <td><?php echo $appointment['service_name']; ?></td>
                <td><?php echo $appointment['appointment_date']; ?></td>
                <td><?php echo $appointment['appointment_time']; ?></td>
                <td>
                    <?php if (!$appointment['is_paid']) : ?>
                        <form method="POST">
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                            <button class="BtnSubmit" type="submit">Check Out</button>
                        </form>
                    <?php else : ?>
                        <p>Paid</p>
                    <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    </form>
    <div>
    <a class="Back" href="customer_dashboard.php">Back</a>
    </div>
    
 </body>

</html>