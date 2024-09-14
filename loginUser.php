<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Order Food</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-img">

    <div class="login row">

        <div class="col-4" style="margin: 5% auto; border-radius: 50px;">
            <h2 class="text-center text-form">ĐĂNG NHẬP <br> NGƯỜI DÙNG</h2><br>
            

            <?php
            if (isset($_SESSION['loginUser'])) {
                echo $_SESSION['loginUser'];
                unset($_SESSION['loginUser']);
            }

            if (isset($_SESSION['no-login-user'])) {
                echo $_SESSION['no-login-user'];
                unset($_SESSION['no-login-user']);
            }

            if (isset($_SESSION['register-usser'])) {
                echo $_SESSION['register-usser'];
                unset($_SESSION['register-usser']);
            }
            ?>

            <form action="" method="POST">

                <div class="form-group mg-form">
                    <label for="">Tài khoản</label>
                    <input class="form-control" type="text" name="username" placeholder="Nhập tài khoản">
                </div>

                <div class="form-group mg-form">
                    <label for="">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
                </div>
                
                <div class="form-group mg-form">
                    <input type="submit" name="submit" value="Đăng nhập" class="btn-secondary btn-user" style="width: 100%;">
                    
                </div>

                <div>
                    <button class="btn-secondary btn-login">
                        <a href="<?php echo SITEURL; ?>registerUser.php">Đăng ký</a>
                    </button>
                </div>

                <div>
                    <button class="btn-secondary btn-login">
                        <a href="<?php echo SITEURL; ?>">Quay lại trang chủ</a>
                    </button>

                </div>

            </form>
        </div>


    </div>

</body>

</html>

<?php
//kiểm tra nút submit
if (isset($_POST['submit'])) {

    // $username = mysqli_real_escape_string($conn,$_POST['username']);
    // $raw_password = sha1($_POST['password']);

    // $password = mysqli_real_escape_string($conn,$raw_password);

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    // sử dụng sql để kiểm tra username và password có tồn tại hay không
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    $row = mysqli_fetch_assoc($res);
    $iduser = $row['iduser'];

    if ($count == 1) {

        $_SESSION['loginUser'] = "<div class='success'> Đăng nhập thành công </div>";
        $_SESSION['userlogin'] = $username; // kiểm tra xem user đã đăng nhập hay chưa and logout sẽ unset nó
        //chuyển hướng tới trang home page
        header('location:' . SITEURL.'index.php');
    } else {

        $_SESSION['loginUser'] = "<div class='error text-center'> Tài khoản hoặc mật khẩu không đúng </div>";
        //chuyển hướng tới trang home page
        header('location:' . SITEURL . '/loginUser.php');
    }
}
?>