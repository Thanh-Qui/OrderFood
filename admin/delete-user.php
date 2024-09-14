<?php include('../config/constants.php'); 

    if (isset($_GET['id'])) {
        $iduser = $_GET['id'];

        $sql = "DELETE FROM users WHERE iduser = $iduser";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['delete-user'] = "<div class='success'> Xoá người dùng thành công </div>";
            header('location:'.SITEURL.'admin/manage-users.php');
        }else {
            $_SESSION['delete-user'] = "<div class='error'> Xoá người dùng không thành công </div>";
            header('location:'.SITEURL.'admin/manage-users.php');
        }
    }

?>
