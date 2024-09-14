<?php
    include ('../config/constants.php');
    //huỷ phần session của đăng nhập
    // session_destroy(); //bỏ lưu $_SESSION['user']

    unset($_SESSION['admin']);
    //chuyển đến trang login.php
    header('location:'.SITEURL.'admin/login.php');
?>