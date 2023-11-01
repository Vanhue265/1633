<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'connect.php';

if (isset($_GET['delete'])) {
    $serviceId = $_GET['delete'];
    $checkAppointmentsQuery = "SELECT id FROM appointments WHERE service_id = $serviceId";
    $result = mysqli_query($conn, $checkAppointmentsQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "This service is scheduled and cannot be deleted.";
    } else {
        $deleteQuery = "DELETE FROM services WHERE id = $serviceId";
        if (mysqli_query($conn, $deleteQuery)) {
            header("Location: admin_manage_services.php");
            exit();
        } else {
            echo "Error deleting service.";
        }
    }
}

$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);
$services = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .action-links {
            text-decoration: none;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
        }

        .action-links:hover {
            background-color: #555;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
        }

        button:hover {
            background-color: #555;
        }
    </style>
        
</head>
<body>
    <h1>Service Management</h1>
    <table>
        <tr>
            <th>Service Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($services as $service) : ?>
            <tr>
                <td><?php echo $service['name']; ?></td>
                <td>
                    <a class="action-links" href="admin_view_service.php?id=<?php echo $service['id']; ?>">View</a>
                    <a class="action-links" href="admin_edit_service.php?id=<?php echo $service['id']; ?>">Edit</a>
                    <a class="action-links" href="admin_manage_services.php?delete=<?php echo $service['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <button onclick="location.href='admin_add_service.php';">Add new service</button>
</body>
</html>

