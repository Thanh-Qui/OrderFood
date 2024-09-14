<?php
include('../config/constants.php');

if (isset($_GET['id']) AND isset($_GET['image'])) {

    $id = $_GET['id'];
    $image = $_GET['image'];

    if ($image != "") {
        $path = "../images/loaimon/".$image;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error> Lỗi xoá hình ảnh loại món </div>";
            header('location:'.SITEURL.'admin/manage-category.php');

            die();
        }
    }

    $sql = "DELETE FROM loaimon WHERE idloaimon = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete-loaimon'] = "<div class='success'> Xoá loại món thành công </div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    } else {
        $_SESSION['delete-loaimon'] = "<div class='error'> Xoá loại món không thành công </div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
