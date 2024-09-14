<?php include('partials-front/menu.php');
include("partials-front/check-login.php");
ob_start(); ?>
<link rel="stylesheet" href="css/profile.css">

<div class="main-content">
    <div class="wrapper">
        <h1>Thay đổi mật khẩu</h1>
        <hr>
        <br><br>
        <form action="" method="POST">

        <?php
            if (isset($_SESSION['userlogin'])) {
                $username = $_SESSION['userlogin'];
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if ($count > 0) {
                    $row = mysqli_fetch_assoc($res);

                    $username = $row['username'];
                }else {
                    echo "Không có dữ liệu";
                }
            }
        ?>

            <table class="tbl-30">
                <tr>
                    <td>Nhập mật khẩu cũ:</td>
                    <td>
                        <input class="form-control" type="password" name="old_password" id="" placeholder="Nhập mật khẩu cũ">
                    </td>
                </tr>

                <tr>
                    <td>Nhập mật khẩu mới:</td>
                    <td>
                        <input class="form-control" type="password" name="new_password" id="" placeholder="Nhập mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td>Nhập lại mật khẩu:</td>
                    <td>
                        <input class="form-control" type="password" name="confirm_password" id="" placeholder="Nhập lại mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="username" id="" value="<?php echo $username; ?>">
                        <input class="btn btn-primary" type="submit" name="submit" id="" value="Đổi mật khẩu">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $old_password = sha1($_POST['old_password']);
                $new_password = sha1($_POST['new_password']);
                $confirm_password = sha1($_POST['confirm_password']);

                $sql2 = "SELECT * FROM users WHERE password = '$old_password' AND username = '$username'";
                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    if ($new_password == $confirm_password) {
                        $sql1 = "UPDATE users SET
                        password = '$new_password'
                        WHERE username = '$username'
                        ";

                        $res1 = mysqli_query($conn, $sql1);
                        if ($res1 == true) {
                            $_SESSION['change-pwuser'] = "<div class='success'> Thay đổi mật khẩu thành công! </div>";
                            header('location:'.SITEURL.'profile.php');
                        }else {
                            $_SESSION['change-pwuser'] = "<div class='error'> Thay đổi mật khẩu không thành công! </div>";
                            header('location:'.SITEURL.'profile.php');
                        }
                    }else {
                        $_SESSION['change-pwuser'] = "<div class='error'> Mật khẩu nhập lại không khớp! </div>";
                        header('location:'.SITEURL.'profile.php');
                    }
                }else {
                    $_SESSION['change-pwuser'] = "<div class='error'> Mật khẩu không đúng! </div>";
                    header('location:'.SITEURL.'profile.php');
                }

                

                
            }
        ?>

    </div>
</div>

<?php include('partials-front/footer.php'); ob_end_flush(); ?>