<?php
require_once 'connect.php';

$query = "SELECT COUNT(*) as total_services FROM services";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalServices = $row['total_services'];

?>

<!DOCTYPE html>
<html>
<head>
    <style>
        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333; 
            overflow: hidden;
        }

        li.nav-item {
            float: left;
        }

        li.nav-item a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li.nav-item a:hover {
            background-color: #444; 
        }

       
        li.logout-button {
            float: right;
        }
        
        li.logout-button a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li.logout-button a:hover {
            background-color: #f33; 
        }
    </style>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Total services: <?php echo $totalServices; ?></p>
    <ul class="navbar">
        <li class="nav-item"><a href="admin_manage_services.php">List of services</a></li>
        <li class="nav-item"><a href="admin_customers.php">List of customer appointments</a></li>
        <li class="logout-button"><a href="logout.php">Log out</a></li>
    </ul>
</body>
</html>




