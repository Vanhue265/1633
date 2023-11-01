<?php
session_start();

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}

require_once 'connect.php'; 

if (isset($_GET['customer_id'])) {
    $customer_id = $_GET['customer_id'];
    $query = "SELECT * FROM appointments WHERE user_id = $customer_id";
    $result = mysqli_query($conn, $query);
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    
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
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Customer appointment schedule</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        <?php foreach ($appointments as $appointment) : ?>
            <tr>
                <td><?php echo $appointment['appointment_date']; ?></td>
                <td><?php echo $appointment['appointment_time']; ?></td>
                <td><?php echo ($appointment['is_paid'] ? 'Paid' : 'Unpaid'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="admin_customers.php">Return to customer list</a>
    <a href="admin_dashboard.php">Return to the dashboard page</a>
</body>
</html>
