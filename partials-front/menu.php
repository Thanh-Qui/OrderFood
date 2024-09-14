<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/title.png" type="image/x-icon">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- <link rel="stylesheet" href="css/admin.css"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">/ -->
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>" title="Logo" class="text-white">
                    <img src="images/logores.png" alt="Restaurant Logo" class="img-responsive">
                    
                    <h4>HaWaii Restaurant</h4>
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php  echo SITEURL; ?>">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL; ?>categories.php">Loại món</a>
                    </li>
                    <li>
                        <a href="<?php  echo SITEURL; ?>foods.php">Món ăn</a>
                    </li>
                    <?php

                        if (isset($_SESSION['userlogin'])) {
                            ?> 
                                
                                <?php 
                                    $username = $_SESSION['userlogin'];
                                    $sql = "SELECT * FROM users WHERE username = '$username'";
                                    $res = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($res);
                                    $tennguoidung = $row['hoten'];
                                    $iduser = $row['iduser'];

                                    $sql1 = "SELECT * FROM cart WHERE iduser=$iduser";
                                    $res1 = mysqli_query($conn, $sql1);
                                    $count = mysqli_num_rows($res1);


                                ?>

                                <li>
                                    <a href="<?= SITEURL;  ?>cart.php" class="cart" style="color: #4b6584;">
                                        <i class="fa-solid fa-cart-shopping"><p class="one-line">(<?= $count; ?>)</p></i>
                                    </a>
                                    
                                </li>

                                <li>
                                    <i class="fa-solid fa-user-large" id="userIcon" style="cursor: pointer;" onclick="toggleDropdownMenu()"></i>
                                    <ul class="dropdown-content" id="dropdownMenu" style="z-index: 2;">
                                        <li style="border-radius: 5px;"><i class="fa-regular fa-circle-user"></i>  <?php echo $tennguoidung; ?></li>
                                        <li class="btn btn-warning"><a href="yourOrder.php">Đơn đặt</a></li>
                                        <li class="btn btn-warning"><a href="message.php">Thông báo</a></li>
                                        <li class="btn btn-warning"><a  href="profile.php">Profile</a></li>
                                        <li class="btn btn-warning"><a href="logoutUser.php">Đăng xuất</a></li>
                                    </ul>
                                </li>
                                
                            <?php
                        }
                        else {
                            ?>
                                <li>
                                    <a href="<?php echo SITEURL; ?>loginUser.php">Đăng nhập</a>
                                </li>
                            <?php
                        }
                    ?>

                    <!-- <li>
                        <a href="logoutUser.php">Đăng xuất</a>
                    </li> -->
                    
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->