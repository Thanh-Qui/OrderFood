<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <hr><br>

        <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
        ?>
        <label for="" id="noteChange" style="color:  red;"></label>
        <form action="" method="POST" id="formChangePass" onsubmit="return isChangePw();">

            <table class="tbl-30">
                <tr>
                    <td>Old password:</td>
                    <td>
                        <input class="form-control" type="password" name="old_password" placeholder="Nhập mật khẩu cũ">
                    </td>
                </tr>

                <tr>
                    <td>New password:</td>
                    <td>
                        <input class="form-control" type="password" name="new_password" placeholder="Nhập mật khẩu mới">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password:</td>
                    <td>
                        <input class="form-control" type="password" name="confirm_password" placeholder="Nhập lại mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary btn-user">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php
    //kiểm tra nút submit
    if (isset($_POST['submit'])) {
        // echo 'clicked';

        //Lấy dữ liệu từ form
        //kiểm tra user và id
        //kiểm tra confirm password có đúng với new password
        //thay đổi password nếu tất cả đều đúng

        $id = $_POST['id'];
        $old_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        // $new_password = password_hash($new_password, PASSWORD_DEFAULT);
        $confirm_password = md5($_POST['confirm_password']);
        // $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);


        $sql = "SELECT * FROM admin WHERE idadmin = $id AND password = '$old_password'";

        $res = mysqli_query($conn, $sql);

            if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //kiếm tra user tồn tại và password
                // echo 'Đã tìm thấy';
                
                //kiểm tra mk mới và mk nhập lại có khớp không
                if ($new_password == $confirm_password) {

                    $sqlQuery = "UPDATE admin SET password = '$new_password' WHERE idadmin = $id";
                    $resQuery = mysqli_query($conn, $sqlQuery);
                    
                    if ($resQuery == true) {
                        $_SESSION['change-pwd'] = "<div class='success'> Thay đổi mật khẩu thành công </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }else{
                        $_SESSION['change-pwd'] = "<div class='error'> Thay đổi mật khẩu không thành công </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }else {
                    $_SESSION['pwd-not-found'] = "<div class='error'> Mật khẩu không khớp nhau </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                
                
            }else{
                $_SESSION['user-not-found'] = "<div class='error'> Không tìm thấy người dùng </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        
    }
?>

<?php include('partials/footer.php'); ?>