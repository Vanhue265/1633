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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_service_name = $_POST['service_name'];
    $new_service_description = $_POST['service_description'];
    $new_service_price = $_POST['service_price'];

    $update_query = "UPDATE services SET name = '$new_service_name', description = '$new_service_description', price = $new_service_price WHERE id = $service_id";
    if (mysqli_query($conn, $update_query)) {
        header("Location: admin_manage_services.php");
        exit();
    } else {
        $error_message = "Error updating service.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }    

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ccc;
            
            margin-bottom: 10px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Edit Services</h1>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" value="<?php echo $service['name']; ?>" required>
        <label for="service_description">Service Description:</label>
        <textarea name="service_description" required><?php echo $service['description']; ?></textarea>
        <label for="service_price">Price:</label>
        <input type="number" name="service_price" value="<?php echo $service['price']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
