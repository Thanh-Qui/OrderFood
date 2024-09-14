<?php include("../config/constants.php"); 

if (isset($_GET['id'])) {
    $idmes = $_GET['id'];

    $sql = "DELETE FROM `message` WHERE idmes=$idmes";
    $res = mysqli_query($conn, $sql);

    if ($res === true) {
        $_SESSION['delete-message'] = "<div class='success'> Xoá tin nhắn thành công </div>";
        header('location:'.SITEURL.'admin/manage-message.php');
    }else {
        $_SESSION['delete-message'] = "<div class='error'> Xoá tin nhắn không thành công </div>";
        header('location:'.SITEURL.'admin/manage-message.php');
    }
}

?>