<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="resource/css/Flowerf.css">
    <ul class="UserDas">
        <?php
        // Check if the user is logged in (you need to implement your authentication logic here)
        $isLoggedIn = false; // You need to replace this with your actual authentication check

        if ($isLoggedIn) {
            echo '<li><a href="login.php">Login</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
        } else {
            // echo '<li><a href="index.php">Home</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
            echo '<li><a href="services.php">List Services</a></li>';
            echo '<li><a href="appointments.php">List Appointments</a></li>';
        }
        ?>
    </ul>
</head>

</html>