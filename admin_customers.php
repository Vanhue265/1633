<?php
session_start();

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); 
    exit();
}

require_once 'connect.php'; 

$query = "SELECT * FROM users WHERE is_admin = 0";
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách khách hàng</title>
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
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        a {
            text-decoration: none;
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            display: inline-block;
        }

        a:hover {
            background-color: #555;
        }

        a.return-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>List of customers</h1>
    <table>
        <tr>
            <th>Name of Customer</th>
            <th>View appointment schedule</th>
        </tr>
        <?php foreach ($customers as $customer) : ?>
            <tr>
                <td><?php echo $customer['username']; ?></td>
                <td>
                    <a href="admin_customer_appointments.php?customer_id=<?php echo $customer['id']; ?>">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a class="return-link" href="admin_dashboard.php">Return to the dashboard page</a>
</body>
</html>


