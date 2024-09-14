<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thay đổi mật khẩu người dùng</h1>
        <hr>
        <label for="" id="noteChangePWUser" style="color: red;"></label>
        <form action="" method="POST" id="formChangePWUser" onsubmit="return isChangePWUser();">

        <?php
            if (isset($_GET['id'])) {
                $iduser = $_GET['id'];
            }
        
        ?>

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
                        <input type="hidden" name="iduser" value="<?php echo $iduser ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary btn-user">
                    </td>
                </tr>
            </table>

        </form>

        <?php
            if (isset($_POST['submit'])) {
                
                $iduser = $_POST['iduser'];
                $old_password = sha1($_POST['old_password']);
                $new_password = sha1($_POST['new_password']);
                $confirm_password = sha1($_POST['confirm_password']);

                $sql1 = "SELECT * FROM users WHERE password = '$old_password' AND iduser = $iduser";
                $res1 = mysqli_query($conn ,$sql1);
                $count1 = mysqli_num_rows($res1);

                if ($count1 > 0) {
                    if ($new_password == $confirm_password) {
                    $sql = "UPDATE users SET
                            password = '$new_password'
                            WHERE iduser = $iduser
                        ";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $_SESSION['change-passwordUser'] = "<div class='success'> Thay đổi mật khẩu thành công! </div>";
                            header('location:'.SITEURL.'admin/manage-users.php');
                        }else {
                            $_SESSION['change-passwordUser'] = "<div class='error'> Thay đổi mật khẩu không thành công! </div>";
                            header('location:'.SITEURL.'admin/manage-users.php');
                        }
                    }else {
                        $_SESSION['change-passwordUser'] = "<div class='error'> Mật khẩu nhập lại không khớp! </div>";
                        header('location:'.SITEURL.'admin/manage-users.php');
                    }
                }else {
                    $_SESSION['change-passwordUser'] = "<div class='error'> Mật khẩu cũ không đúng! </div>";
                    header('location:'.SITEURL.'admin/manage-users.php');
                }

                

                
                
            }
        
        ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>