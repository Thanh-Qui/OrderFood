<?php include('partials-front/menu.php');
include('partials-front/check-login.php'); ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Giỏ hàng cá nhân</h1>
        <hr><br>

        <?php
            if (isset($_SESSION['add-orders'])) {
                echo $_SESSION['add-orders'];
                unset($_SESSION['add-orders']);
            }

            if (isset($_SESSION['delete-cart'])) {
                echo $_SESSION['delete-cart'];
                unset($_SESSION['delete-cart']);
            }
        
        ?>

        <?php 
            if (isset($_SESSION['userlogin'])) {
                $username = $_SESSION['userlogin'];
                $sql = "SELECT * FROM users WHERE username='$username'";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $iduser = $row['iduser'];

                $sql1 = "SELECT * FROM cart WHERE iduser = $iduser";
                $res1 = mysqli_query($conn, $sql1);
                $count= mysqli_num_rows($res1);
                
                if ($count > 0) {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $idcart = $row1['idcart']; 
                        $tenmon = $row1['tenmon'];
                        $soluong = $row1['soluong'];
                        $gia = $row1['gia'];
                        ?>

                        <?php
                            $sql2 = "SELECT * FROM monan WHERE tenmon='$tenmon'";
                            $res2 = mysqli_query($conn, $sql2);
                            while ($row2 = mysqli_fetch_assoc($res2)) {
                                $image = $row2['image_monan'];

                                ?>

                                    <form action="" method="POST">
                                        <div class="cart-box">

                                            <div class="image-box">
                                                <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image; ?>" alt="" style="height: 100px; width: 100px;">
                                            </div>

                                            <div class="details-box">
                                                <p>Tên món: <?= $tenmon; ?></p>
                                                <p>Giá: <?= currency_format($gia, "VND"); ?></p>
                                            </div>

                                            <div class="actions-box">

                                                <input class="form-control" type="number" name="soluong" id="soluong_<?php echo $idcart; ?>" value="<?= $soluong; ?>" oninput="updateQuantity(<?php echo $idcart; ?>)">

                                                <a class="btn btn-danger" style="margin-top: 20px;" href="<?php echo SITEURL; ?>delete-cart.php?id=<?php echo $idcart; ?>" onclick="return isDelete();">Xoá món ăn</a>
                                                <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>">
                                                <input type="hidden" name="idcart" id="" value="<?php echo $idcart; ?>">
                                                <input type="hidden" name="tenmon" id="" value="<?php echo $tenmon; ?>">

                                            </div>
                                            
                                        </div>
                                    </form>

                            <?php
                            }
                        
                    }
                }else {
                    echo "<div class='error'> Không có món ăn được thêm vào giỏ hàng! </div>";
                }
            }
        ?>

        
        <button class="btn btn-search" style="float: right;"><a href="<?php echo SITEURL; ?>orderfoods.php?id=<?php echo $iduser; ?>">Đặt món</a></button>
       

        <?php

            if (isset($_POST['soluong'])) {
                $soluong = $_POST['soluong'];
                $idcart = $_POST['idcart'];
            
                // Cập nhật số lượng trong bảng giỏ hàng
                $sql3 = "UPDATE cart SET soluong = $soluong WHERE idcart = $idcart";
                $res3 = mysqli_query($conn, $sql3);
            
                if ($res3) {
                    // Cập nhật thành công, có thể thêm thông báo nếu cần
                    header('Location: ' . $_SERVER['PHP_SELF']);
                     exit();
                } else {
                    // Cập nhật thất bại, có thể thêm thông báo nếu cần
                    echo "'Có lỗi khi cập nhật số lượng!'";
                }

                exit();
            }

        ?>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php include('partials-front/footer.php'); ob_end_flush(); ?>