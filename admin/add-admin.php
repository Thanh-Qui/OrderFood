<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <hr><br>

        <?php 
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <label for="" id="noteUser" style="color: red;"></label>
        <form action="" method="POST" id="formUser" onsubmit="return isUser();">

            <table class="tbl-30">
                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input class="form-control" type="text" name="hoten" placeholder="Nhập họ tên">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input class="form-control" type="text" name="username" placeholder="Nhập tài khoản">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input class="form-control" type="password" name="password" placeholder="Nhập mật khẩu">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary btn-user">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
//them gia tri vao db
//kiem tra tinh trang submit

if (isset($_POST['submit'])) {

    //Get the data from form
    $full_name = $_POST['hoten'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); // bảo mật password với md5
    // $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    //câu truy vấn insert vào cơ sở dữ liệu
    $sql = "INSERT INTO admin SET
        hoten = '$full_name',
        username = '$username',
        password = '$password'
    ";

    $sql1 = "SELECT * FROM admin WHERE username = '$username' ";
    $res1 = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($res1);
    if ($count > 0) {
        $_SESSION['existUser'] = "<div class='error'> Tài khoản đã tồn tại </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else {
        //lưu dữ liệu vào db
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        

        //kiểm tra 
        if ($res==TRUE) {
            $_SESSION['add'] = "<div class='success'> Thêm quản trị thành công </div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }else {
            $_SESSION['add'] = "<div class='error'> Thêm quản trị không thành công </div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }

    
    
}
?>