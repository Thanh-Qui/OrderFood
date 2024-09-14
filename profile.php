<?php include('partials-front/menu.php');
include("partials-front/check-login.php");
?>
<link rel="stylesheet" href="css/profile.css">
<div class="main-content">
    <div class="wrapper">
        <h1 style="font-size: 50px;">Thông tin cá nhân</h1>
        <hr>

        <?php
            if (isset($_SESSION['change-info'])) {
                echo $_SESSION['change-info'];
                unset($_SESSION['change-info']);
            }

            if (isset($_SESSION['change-pwuser'])) {
                echo $_SESSION['change-pwuser'];
                unset($_SESSION['change-pwuser']);
            }

        ?>

    <section class="user-deltails">
        <div class="info">
                <?php 
                    if (isset($_SESSION['userlogin'])) {
                        $username = $_SESSION['userlogin'];
                        $sql = "SELECT * FROM users WHERE username = '$username'";
                        $res = mysqli_query($conn, $sql);
                        
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            $row  = mysqli_fetch_assoc($res);

                            $tennguoidung = $row['hoten'];
                            $email = $row['email'];
                            $sdt = $row['sdt'];
                            $diachi = $row['diachi'];
                        }else {
                            echo "Không có dữ liệu người dùng này";
                        }
                        
                    }
                ?>

                <img src="img/user.png" alt="">
                <p><i class="fa-solid fa-user"></i>    <?php echo $tennguoidung; ?></p>
                <p><i class="fa-solid fa-envelope"></i>  <?php echo $email; ?></p>
                <p><i class="fa-solid fa-phone"></i>  <?php echo $sdt; ?></p>
                <p><i class="fa-solid fa-location-dot"></i>  <?php echo $diachi; ?></p>

                <button><a href="updateUser.php">Thay đổi thông tin cá nhân</a></button>
                <button><a href="changeP-User.php">Thay đổi mật khẩu cá nhân</a></button>
        </div>

    </section>
        
    </div>
</div>


<?php include('partials-front/footer.php'); ?>