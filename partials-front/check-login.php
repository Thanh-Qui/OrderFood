<?php

if (!isset($_SESSION['userlogin'])) {
    $_SESSION['no-login-user'] = "<div class='error'> Vui lòng đăng nhập tài khoản! </div>";
    header('location:'.SITEURL.'loginUser.php');
}
?>