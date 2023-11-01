<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'connect.php';

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    $query = "SELECT * FROM services WHERE id = $service_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $service = mysqli_fetch_assoc($result);
    } else {
        header("Location: admin_manage_services.php");
        exit();
    }
} else {
    header("Location: admin_manage_services.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #333;
    }

    p {
        font-size: 18px;
        margin: 10px 0;
    }
</style>
</head>
<body>
    <h1>Service Details</h1>
    <p>Service Name: <?php echo $service['name']; ?></p>
    <p>Service Description: <?php echo $service['description']; ?></p>
    <p>Price <?php echo $service['price']; ?></p>
</body>
</html>
