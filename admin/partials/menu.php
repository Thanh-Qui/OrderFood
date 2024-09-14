<?php
include('../config/constants.php');
include('login-check.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/title.png" type="image/x-icon">

  <title>Food Order - Home Page</title>
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

  <!-- Menu Section Start -->
  <div class="menu text-center">
    <div class="wrapper">
      
      <ul>
        <a href="<?php echo SITEURL; ?>admin" class="back-home">
          <li><img class="cus-logo" src="../img/logo.png" alt=""></li>
          <li class="cus-name">HaWaii Restaurent</li>
        </a>
        
        <li><a href="index.php">Home</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-users.php">Users</a></li>
        <li><a href="manage-category.php">Loại món</a></li>
        <li><a href="manage-food.php">Món ăn</a></li>
        <li><a href="manage-order.php">Đặt món</a></li>
        <li><a href="manage-message.php">Thông báo</a></li>
        <li><a href="logout.php">Đăng xuất</a></li>
      </ul>
    </div>
  </div>
  <!-- Menu Section End -->