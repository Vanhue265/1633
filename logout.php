<?php
session_start();

// Hủy phiên đăng nhập của người dùng
session_destroy();

// Chuyển hướng về trang "index.php" sau khi đăng xuất
header("Location: index.php");
exit();
?>
