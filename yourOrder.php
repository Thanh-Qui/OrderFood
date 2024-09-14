<?php include("partials-front/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Đơn đặt</h1>
        <hr><br>

        <?php
            if (isset($_SESSION['update-yourOrder'])) {
                echo $_SESSION['update-yourOrder'];
                unset($_SESSION['update-yourOrder']);
            }

            $sql = "SELECT * FROM orderfood WHERE iduser=$iduser";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idorder = $row['idorder'];
                    $tenmon = $row['tenmon'];
                    $gia = $row['gia'];
                    $tongcong = $row['tongcong'];
                    $status = $row['status'];
                    ?>
                        <div class="message-box">
                            <p>Tên món: <?= $tenmon; ?> </p>
                            <p>Đơn giá: <?= $gia; ?> </p>
                            <p>Tổng cộng: <?= $tongcong; ?> </p>
                            <p>Trạng thái:
                                    <?php
                                        if ($status =="đã đặt") {
                                            echo "$status";
                                        }
                                        elseif ($status == "đang giao hàng") {
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        elseif ($status == "đã giao hàng") {
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        elseif ($status == "đã huỷ đơn") {
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                
                            </p>

                            <a class="btn btn-danger" href="<?php echo SITEURL; ?>update-order.php?id=<?php echo $idorder; ?>" onclick="return isDelete('Bạn có muốn huỷ đơn đặt này?');">Huỷ đơn đặt</a>

                        </div>
                    <?php
                }
            }else {
                echo "<div class='error'> Không có đơn đặt! </div>";
            }
        ?>

        
    </div>
</div>


<?php include("partials-front/footer.php"); ?>