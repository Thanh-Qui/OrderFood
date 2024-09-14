<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật thông tin người dùng</h1>
        <hr>
        <label for="" id="noteUpdateUser" style="color: red;"></label>
        <form action="" method="POST" id="formUpdateUser" onsubmit="return isUpdateUser();">

        <?php
            if (isset($_GET['id'])) {
               $iduser = $_GET['id'];

               $sql = "SELECT * FROM users WHERE iduser = $iduser";
               $res = mysqli_query($conn, $sql);
               $count = mysqli_num_rows($res);
               if ($count > 0) {

                    $row = mysqli_fetch_assoc($res);
                        $iduser = $row['iduser'];
                        $hoten = $row['hoten'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $sdt = $row['sdt'];
                        $diachi = $row['diachi'];

               }else {
                    echo "<div class='error'> Không có dữ liệu </div>";
               }
            }
        
        ?>

            <table class="tbl-30">

                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input class="form-control" type="text" name="hoten" id="" placeholder="Nhập đầy đủ họ tên" value="<?php echo $hoten; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Tài khoản:</td>
                    <td>
                        <input class="form-control" type="text" name="username" id="" placeholder="Nhập tài khoản đăng nhập" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input class="form-control" type="text" name="email" id="" placeholder="Nhập email xác thực" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Số điện thoại:</td>
                    <td>
                        <input class="form-control" type="text" name="sdt" id="" placeholder="Số điện thoại liên lạc" value="<?php echo $sdt; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <input class="form-control" type="text" name="diachi" id="" placeholder="Nhập địa chỉ" value="<?php echo $diachi; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="iduser" value="<?php echo $iduser; ?>" id="">
                        <input class="btn btn-outline-success" type="submit" name="submit" value="Thêm người dùng" id="">
                    </td>
                </tr>

            </table>

        </form>

        <?php
            if (isset($_POST['submit'])) {
                
                $iduser = $_POST['iduser'];
                $hoten = $_POST['hoten'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $diachi = $_POST['diachi'];

                $sql1 = "UPDATE users SET
                    hoten = '$hoten',
                    username = '$username',
                    email = '$email',
                    sdt = '$sdt',
                    diachi = '$diachi'
                    WHERE iduser = $iduser
                ";

                // $sql2=  "SELECT * FROM users WHERE username = '$username'";
                // $res2 = mysqli_query($conn, $sql2);
                // $count2 = mysqli_num_rows($res2);
                // if ($count2 > 0) {

                //     $_SESSION['update-user'] = "<div class='error'> Tài khoản đã tồn tại </div>";
                //     header('location:'.SITEURL.'admin/manage-users.php');

                // }else {

                    $res1 = mysqli_query($conn, $sql1);
                    if ($res1 == true) {
                        $_SESSION['update-user'] = "<div class='success'> Cập nhật thành công </div>";
                        header('location:'.SITEURL.'admin/manage-users.php');
                    }else {
                        $_SESSION['update-user'] = "<div class='error'> Cập nhật không thành công </div>";
                        header('location:'.SITEURL.'admin/manage-users.php');
                    }
                // }

                
            }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>