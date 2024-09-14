<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm người dùng</h1>
        <hr><br>
        <label for="" id="noteAddUser" style="color:  red;"></label>
        <form action="" method="POST" id="formAddUser" onsubmit="return isAddUser();">

            <table class="tbl-30">

                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input class="form-control" type="text" name="hoten" id="" placeholder="Nhập đầy đủ họ tên">
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản:</td>
                    <td>
                        <input class="form-control" type="text" name="username" id="" placeholder="Nhập tài khoản đăng nhập">
                    </td>
                </tr>

                <tr>
                    <td>Mật khẩu:</td>
                    <td>
                        <input class="form-control" type="password" name="password" id="" placeholder="Nhập mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input class="form-control" type="text" name="email" id="" placeholder="Nhập email xác thực">
                    </td>
                </tr>

                <tr>
                    <td>Số điện thoại:</td>
                    <td>
                        <input class="form-control" type="text" name="sdt" id="" placeholder="Số điện thoại liên lạc">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <input class="form-control" type="text" name="diachi" id="" placeholder="Nhập địa chỉ">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input class="btn btn-outline-success" type="submit" name="submit" value="Thêm người dùng" id="">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if (isset($_POST["submit"])) {
                $hoten = $_POST['hoten'];
                $username = $_POST['username'];
                $password = sha1($_POST['password']);
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $diachi = $_POST['diachi'];

                $sql = "INSERT INTO users SET
                        hoten = '$hoten',
                        username = '$username',
                        password = '$password',
                        email = '$email',
                        sdt = '$sdt',
                        diachi = '$diachi'
                    ";

                $sql1= "SELECT * FROM users WHERE username = '$username' ";
                $res1 = mysqli_query($conn, $sql1);
                $count = mysqli_num_rows($res1);
                if ($count == 1) {
                    $_SESSION['add-users'] = "<div class='error'> Tài khoản đã tồn tại </div>";
                    header('location:'.SITEURL.'admin/manage-users.php');
                }else {
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        $_SESSION['add-users'] = "<div class='success'> Thêm người dùng thành công </div>";
                        header('location:'.SITEURL.'admin/manage-users.php');
                    }else {
                        $_SESSION['add-users'] = "<div class='error'> Thêm người dùng không thành công </div>";
                        header('location:'.SITEURL.'admin/manage-users.php');
                    }
                }

                
            
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>