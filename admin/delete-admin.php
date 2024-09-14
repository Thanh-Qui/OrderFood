<?php

include('../config/constants.php');

// lấy id của admin đã chọn để xoá
// tạo câu truy vấn delete
//chuyển hướng tới trang manage Admin page với thông báo successful

$id = $_GET['id'];
$sql = "DELETE FROM admin WHERE idadmin=$id";
$res = mysqli_query($conn, $sql);

//kiểm tra câu truy vấn
if ($res == true) {
    $_SESSION['delete'] = "<div class='success'> Xoá thành công </div>";
    //chuyển hướng về trang manage-admin.php
    header('location:'.SITEURL.'admin/manage-admin.php');
}else{
    $_SESSION['delete'] = "<div class='error'> Xoá thất bại </div>";
    header('location:'.SITEURL.'admin/delete-admin.php');
}
?>