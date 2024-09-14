<?php 
    include("config/constants.php");

    if (isset($_GET['id'])) {
        
        $idorder = $_GET['id'];
        $status = "đã huỷ đơn";

        $sql1 = "UPDATE orderfood SET
            status = '$status'
            WHERE idorder=$idorder
        ";

        $res1 = mysqli_query($conn, $sql1);
        if ($res1 == true) {
            $_SESSION['update-yourOrder'] = "<div class='success'> Huỷ đơn đặt thành công! </div>";
            header('location:'.SITEURL.'yourOrder.php');
        }else {
            $_SESSION['update-yourOrder'] = "<div class='error'> Huỷ đơn đặt không thành công! </div>";
            header('location:'.SITEURL.'yourOrder.php');
        }
    }

?>