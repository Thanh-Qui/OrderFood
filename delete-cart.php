<?php
    include("config/constants.php");

    if (isset($_GET['id'])) {
        $idcart = $_GET['id'];
        
        $sql = "DELETE FROM cart WHERE idcart=$idcart";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['delete-cart'] = "<div class='success'> Xoá món thành công </div>";
            header('location:'.SITEURL.'cart.php');
        }else {
            $_SESSION['delete-cart'] = "<div class='error'> Xoá món không thành công </div>";
            header('location:'.SITEURL.'cart.php');
        }
    }

?>