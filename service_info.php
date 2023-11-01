<?php
session_start();
include 'customer_dashboard.php';


// Include file kết nối cơ sở dữ liệu
require_once 'connect.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa. Nếu không, họ sẽ được chuyển hướng đến trang đăng nhập.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Xử lý khi người dùng ấn vào "Đặt lịch hẹn"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    // Thực hiện truy vấn để tạo lịch hẹn
    $query = "INSERT INTO appointments (user_id, service_id, appointment_date, appointment_time) 
              VALUES ($user_id, $service_id, '$appointment_date', '$appointment_time')";
    
    if (mysqli_query($conn, $query)) {
        // Lịch hẹn đã được đặt thành công, bạn có thể thực hiện chuyển hướng hoặc hiển thị thông báo.
    } else {
        $error_message = "Error.";
    }
}

// Lấy thông tin dịch vụ từ cơ sở dữ liệu dựa trên ID dịch vụ (truyền qua URL)
$service_id = $_GET['service_id'];
$query = "SELECT * FROM services WHERE id = $service_id";
$result = mysqli_query($conn, $query);
$service = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Abouts Service: <?php echo $service['name']; ?></title>
    <link rel="stylesheet" href="resource/css/Flowerf.css">
</head>
<body class>
    <h1 class="Title">Service: <?php echo $service['name']; ?></h1>

    <p class="serdp"><?php echo $service['description']; ?></p>
    <p class="serdp">Price: <?php echo $service['price']; ?></p>

    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php else : ?>
        <form method="POST" class="SerDetails">
            <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
            <label for="appointment_date">Choose the date for appoitment:</label>
            <input type="date" name="appointment_date" required>
            <label for="appointment_time">Choose the time:</label>
            <input type="time" name="appointment_time" required>
            <button type="submit">Create Apointment</button>
        </form>
    <?php endif; ?>

    <a href="services.php" class="Back">Back to list services</a>
</body>
</html>
