<?php
    include('../config/constants.php');

    if (isset($_GET['id']) AND isset($_GET['image_monan'])) {
        $id = $_GET['id'];
        $image_monan = $_GET['image_monan'];

        if ($image_monan != "") {
        $path = "../images/monan/".$image_monan;
        $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['upload'] = "<div class='error'> Lỗi xoá hình ảnh loại món </div>";
                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }
        }

        $sql = "DELETE FROM monan WHERE idmonan = $id";
        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['delete'] = "<div class='success'> Xoá món ăn thành công </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }else {
            $_SESSION['delete'] = "<div class='error'> Xoá món ăn không thành công </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }

    }else {
        $_SESSION['unauthorized '] = "<div class='error'> Món ăn không tồn tại </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>