<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceId = $_POST['service_id'];

    $query = "DELETE FROM services WHERE id = $serviceId";
    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
        exit();
    }
}

if (isset($_GET['service_id'])) {
    $serviceId = $_GET['service_id'];
    $query = "SELECT * FROM services WHERE id = $serviceId";
    $result = mysqli_query($conn, $query);
    $service = mysqli_fetch_assoc($result);
}
?>

<h1>Xóa Dịch Vụ</h1>
<p>Bạn có chắc chắn muốn xóa dịch vụ: <?php echo $service['name']; ?>?</p>
<form method="POST">
    <input type="hidden" name="service_id" value="<?php echo $serviceId; ?>">
    <button type="submit">Xóa Dịch Vụ</button>
</form>
