<?php include("config/constants.php");
include("partials-front/check-login.php");

if (isset($_GET['id'])) {
    $idmes = $_GET['id'];

    $sql = "DELETE FROM `message` WHERE idmes='$idmes'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete-usermes'] = "<div class='success'> Xoá thông báo thành công </div>";
        header('location:'.SITEURL.'message.php');
    }else {
        $_SESSION['delete-usermes'] = "<div class='error'> Xoá thông báo không thành công </div>";
        header('location:'.SITEURL.'message.php');
    }
}

?>