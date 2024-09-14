<?php include('partials-front/menu.php');
include("partials-front/check-login.php");
ob_start(); ?>
<link rel="stylesheet" href="css/profile.css">

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật thông tin cá nhân</h1>
        <hr>
        <br><br>
        <label for="" id="noteChangeInfo" style="color: red;"></label>
        <form action="" method="POST" id="formChangeInfo" onsubmit="return isChangeInfo();">
            <table class="tbl-30">

            <?php 
                if (isset($_SESSION['userlogin'])) {
                    $username = $_SESSION['userlogin'];

                    $sql = "SELECT * FROM users WHERE username = '$username'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        $row = mysqli_fetch_assoc($res);
                        $username = $row['username'];
                        $hoten = $row['hoten'];
                        $email = $row['email'];
                        $sdt = $row['sdt'];
                        $diachi = $row['diachi'];
                    }else {
                        echo "Không có dữ liệu về người dùng này";
                    }
                }
            ?>

                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input class="form-control" type="text" name="hoten" id="" placeholder="Nhập đầy đủ họ tên" value="<?php echo $hoten; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input class="form-control" type="email" name="email" id="" placeholder="Nhập email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Số điện thoại:</td>
                    <td>
                        <input class="form-control" type="text" name="sdt" id="" placeholder="Nhập số điện thoại liên lạc" value="<?php echo $sdt; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <input class="form-control" type="text" name="diachi" id="" placeholder="Nhập địa chỉ" value="<?php echo $diachi; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="username" id="" value="<?php echo $username; ?>">
                        <input class="btn btn-primary" type="submit" name="submit" id="" value="Thay đổi">
                    </td>
                </tr>

            </table>
        </form>
        
        <?php
            if (isset($_POST['submit'])) {

                $username = $_POST['username'];
                $hoten = $_POST['hoten'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $diachi = $_POST['diachi'];

                $sql1 = "UPDATE users SET
                    hoten = '$hoten',
                    email = '$email',
                    sdt = '$sdt',
                    diachi = '$diachi'
                    WHERE username = '$username';
                ";
                $res1 = mysqli_query($conn, $sql1);

                if ($res1 == true) {
                    $_SESSION['change-info'] = "<div class='success'> Thay đổi thông tin thành công! </div>";
                    header('location:'.SITEURL.'profile.php');
                }else {
                    $_SESSION['change-info'] = "<div class='error'> Thay đổi thông tin không thành công! </div>";
                    header('location:'.SITEURL.'profile.php');
                }
            }
        
        ?>


    </div>
</div>


<?php include('partials-front/footer.php'); ob_end_flush(); ?>