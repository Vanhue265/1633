<?php
session_start();
include 'customer_dashboard.php';
// Include file kết nối cơ sở dữ liệu
require_once 'connect.php';

// Truy vấn cơ sở dữ liệu để lấy danh sách các dịch vụ
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);

$services = array(); // Mảng để lưu danh sách dịch vụ

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Danh sách dịch vụ</title>
    <link rel="stylesheet" href="resource/css/Flowerf.css">
</head>

<body>
    <h1 class="Title">List services for your pet</h1>
    <table class= sertbl>
        <?php $i = 0; ?>
        <?php foreach ($services as $service) : ?>
            <?php if ($i % 2 == 0) : ?>
                <tr>
                <?php endif; ?>
                <td>
                    <h2><?php echo $service['name']; ?></h2>
                    <p><?php echo $service['description']; ?></p>
                    <p>Giá: <?php echo $service['price']; ?></p>
                    <a class href="service_info.php?service_id=<?php echo $service['id']; ?>">Make Appointment</a>
                </td>
                <?php if ($i % 2 == 1) : ?>
                </tr>
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
        <?php if ($i % 2 == 1) : ?>
            <td></td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="customer_dashboard.php" class="Back">Back to Home</a>
</body>

</html>