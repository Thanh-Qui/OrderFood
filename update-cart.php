<?php
include('config.php'); // Kết nối đến database

if (isset($_POST['idcart']) && isset($_POST['soluong'])) {
    $idcart = $_POST['idcart'];
    $soluong = $_POST['soluong'];

    // Cập nhật số lượng trong bảng giỏ hàng
    $sql = "UPDATE cart SET soluong = $soluong WHERE idcart = $idcart";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi khi cập nhật";
    }
}
?>
