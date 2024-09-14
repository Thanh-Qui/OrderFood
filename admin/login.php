<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Order Food</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="bg-img">

    <div class="login row">

        <div class="col-4" style="margin: 5% auto; border-radius: 50px;">
            <h2 class="text-center text-form">ĐĂNG NHẬP <br> QUẢN LÝ ADMIN</h2><br>
            

            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
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
                <button class="btn-secondary" style="width: 100%; border: none;"><a style="text-decoration: none; color: white;" href="<?php echo SITEURL; ?>">Quay lại trang chủ</a></button>
                </div>

            </form>
        </div>


    </div>

</body>

</html>

<?php
//kiểm tra nút submit
if (isset($_POST['submit'])) {
    //lấy dữ liệu từ form login
    // $username = $_POST['username'];
    // $password = md5($_POST['password']);

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $raw_password = md5($_POST['password']);

    $password = mysqli_real_escape_string($conn,$raw_password);

    // sử dụng sql để kiểm tra username và password có tồn tại hay không
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {

        $_SESSION['login'] = "<div class='success'> Đăng nhập thành công </div>";
        $_SESSION['admin'] = $username; // kiểm tra xem user đã đăng nhập hay chưa and logout sẽ unset nó
        //chuyển hướng tới trang home page
        header('location:' . SITEURL . 'admin/');
    } else {

        $_SESSION['login'] = "<div class='error text-center'> tài khoản hoặc mật khẩu không đúng </div>";
        //chuyển hướng tới trang home page
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>