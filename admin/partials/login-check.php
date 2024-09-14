<?php
  //Authorzation - Access control
  //kiểm xem tài khoản đã được đnăg nhập hay chưa
  if (!isset($_SESSION['admin'])) { // nếu session của user không được đặt
    //user không đăng nhập
    //chuyển về login.php
    $_SESSION['no-login-message'] = "<div class='error'> Vui lòng đăng nhập tài khoản admin </div>";
    header('location:'.SITEURL.'admin/login.php');
  }
?>