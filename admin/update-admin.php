<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <hr><br>

        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM admin WHERE idadmin = $id";
        $res = mysqli_query($conn, $sql);

        //Kiểm tra câu truy vấn delete
        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                // echo 'Có dữ liệu của id này';
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['hoten'];
                $username = $row['username'];
            } else {
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
        ?>
        <label for="" id="noteUpdateUser" style="color: red;"></label>
        <form action="" method="POST" id="formUpdateUser" onsubmit="return isUpdateUser();">
            <table class="tbl-30">
                <tr>
                    <td>Họ tên:</td>
                    <td>
                        <input class="form-control" type="text" name="hoten" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-secondary btn-user">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
// kiểm tra nút update có được click hay chưa
if (isset($_POST['submit'])) {
    //lấy tất cả giá trị từ form để update
    $id = $_POST['id'];
    $full_name = $_POST['hoten'];
    $username = $_POST['username'];

    //tạo sql để update dữ liệu
    $sql = "UPDATE admin SET 
    hoten = '$full_name',
    username = '$username'
    WHERE idadmin = '$id'";
    

    $sql1 = "SELECT * FROM admin WHERE username = '$username'";
    $res1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($res1);
    if ($count1 > 0) {
        $_SESSION['existUser'] = "<div class='error'> Tài khoản đã tồn tại </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else {
        $res = mysqli_query($conn, $sql);
        //kiểm tra câu truy vấn
        if ($res == true) {
            $_SESSION['update'] = "<div class='success'> Cập nhật thành công </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }else {
            $_SESSION['update'] = "<div class='error'> Cập nhật không thành công </div>";
            header('location:'.SITEURL.'admin/update-admin.php');
        }
    }

    
}

?>

<?php include('partials/footer.php'); ?>