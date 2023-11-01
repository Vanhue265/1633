<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceName = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = "INSERT INTO services (name, description, price) VALUES ('$serviceName', '$description', $price)";
    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
        exit();
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
    <h1>Add New Service</h1>
    <form method="POST">
        <label for="service_name">Service Name:</label>
        <input type="text" name="service_name" required>
        <label for="description">Service Description:</label>
        <textarea name="description" required></textarea>
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <button type="submit">Add</button>
    </form>
</body>
</html>

