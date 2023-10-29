<?php
session_start();

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
        $error_message = "Lỗi khi đặt lịch hẹn.";
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
    <title>Chi tiết dịch vụ: <?php echo $service['name']; ?></title>
</head>
<body>
    <h1>Chi tiết dịch vụ: <?php echo $service['name']; ?></h1>

    <p><?php echo $service['description']; ?></p>
    <p>Giá: <?php echo $service['price']; ?></p>

    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php else : ?>
        <form method="POST">
            <input type="hidden" name="service_id" value="<?php echo $service['id']; ?>">
            <label for="appointment_date">Chọn ngày lịch hẹn:</label>
            <input type="date" name="appointment_date" required>
            <label for="appointment_time">Chọn giờ lịch hẹn:</label>
            <input type="time" name="appointment_time" required>
            <button type="submit">Đặt lịch hẹn</button>
        </form>
    <?php endif; ?>

    <a href="services.php">Quay lại danh sách dịch vụ</a>
</body>
</html>
