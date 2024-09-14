<?php require('../config/constants.php'); 

    if (isset($_GET['id'])) {
        $idorder = $_GET['id'];

        $sql = "DELETE FROM orderfood WHERE idorder = $idorder";
        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['deleteOrder'] = "<div class='success'> Xoá đặt món thành công </div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }else {
            $_SESSION['deleteOrder'] = "<div class='error'> Xoá đặt món không thành công </div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }

?>
