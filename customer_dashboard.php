<h1>Dashboard Customer</h1>
<ul>
    <?php
    // Check if the user is logged in (you need to implement your authentication logic here)
    $isLoggedIn = false; // You need to replace this with your actual authentication check
    
    if ($isLoggedIn) {
        echo '<li><a href="login.php">Đăng nhập</a></li>';
        echo '<li><a href="register.php">Đăng ký</a></li>';
    } else {
        echo '<li><a href="logout.php">Đăng xuất</a></li>';
        
    }
    ?>
</ul>
<li><a href="services.php">Danh sách dịch vụ</a></li>
<li><a href="appointments.php">Danh sách lịch hẹn</a></li>
