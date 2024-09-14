<?php
include('partials-front/menu.php');
include('partials-front/check-login.php'); ob_start();
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-order">
    <div class="container">

        <h2 class="text-center text-black">Điền vào mẫu này để xác nhận đơn hàng của bạn.</h2>

        <form action="" class="order" method="POST">
            <fieldset>
                <legend>Món đã chọn</legend>

                <?php 
                    if (isset($_GET['id'])) {
                        $iduser = $_GET['id'];
                        $sql = "SELECT * FROM cart WHERE iduser=$iduser";
                        $res = mysqli_query($conn, $sql);
                        
                        $tongcong = 0;
                        $tongsl = 0;
                        $tongtenmon = "";
                        $tonggia = "";

                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $tenmon = $row['tenmon'];
                                $soluong = $row['soluong'];
                                $gia = $row['gia'];
                                $iduser = $row['iduser'];
                                ?>
                                    <div class="food-menu-desc mb-15">
                                        <p class="one-line"><b><?= $tenmon; ?></b></p>
                                        
                                        <p class="one-line" style="float: right;"><b><?= currency_format($gia, "VND"); ?></b></p>

                                        <p class="one-line" style="float: right;"><b><?= $soluong; ?></b> x</p>

                                        <?php

                                            $tongtien = (int)$gia * $soluong;

                                            $tongtenmon .= $tenmon."($soluong)"."-";
                                            
                                            $tongcong += $tongtien;
                                            $tongsl += $soluong;

                                            $tonggia .= (string)$gia."-";

                                        ?>

                                    </div>
                                <?php
                            }

                            $tongtenmon = rtrim($tongtenmon, "-");
                            $tonggia = rtrim($tonggia, "-");
                        }else {
                            echo "<div class='error'> Chưa có món nào không giỏ hàng! </div>";
                        }
                    }
                
                ?>
                <div class="food-menu-desc mb-15">
                    <p>Tổng cộng: <b><?php echo currency_format($tongcong, "VND"); ?></b></p>
                </div>
                    

            </fieldset>

            <fieldset>
                <form action="" method="POST">
                    <legend>Chi tiết giao hàng</legend>
                    <div class="order-label">Họ tên</div>
                    <input type="text" name="tenkh" placeholder="Nhập họ tên" class="input-responsive" required>

                    <div class="order-label">Số điện thoại liên lạc</div>
                    <input type="tel" name="contact" placeholder="Số điện thoại" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Email" class="input-responsive" required>

                    <div class="order-label">Địa chỉ</div>
                    <textarea name="diachi" rows="5" placeholder="Địa chỉ (ví dụ: Thốt nốt, Cần Thơ)" class="input-responsive" required></textarea>

                    <div class="order-label">Phương thức thanh toán</div>
                    <select class="form-control input-responsive" name="phuongthuc" id="">
                        <option value="tiền mặt">Tiền mặt</option>
                        <option value="chuyển khoản">Chuyển khoản</option>
                        <option value="quẹt thẻ">Quẹt thẻ</option>
                    </select>
                    
                    <input type="hidden" name="tongcong" value="<?php echo $tongcong; ?>">
                    <input type="hidden" name="tongsoluong" id="" value="<?php echo $tongsl; ?>">
                    <input type="hidden" name="tongtenmon" id="" value="<?php echo $tongtenmon; ?>">
                    <input type="hidden" name="tonggia" id="" value="<?php echo $tonggia; ?>">
                    <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>">
                    <input type="submit" name="submit" value="Đồng ý đặt món" class="btn btn-search">
                </form>
                
            </fieldset>

        </form>
        
        <?php
            if (isset($_POST['submit'])) {
                $iduser = $_POST['iduser'];
                $tenmon = $_POST['tongtenmon'];
                $gia = $_POST['tonggia'];
                $soluong = $_POST['tongsoluong'];
                $tongcong = $_POST['tongcong'];
                
                $ngaydat = date("Y-m-d h:i:sa");
                $status = "đã đặt";
                $tenkh = $_POST['tenkh'];
                $contact = $_POST['contact'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];
                $phuongthuc = $_POST['phuongthuc'];

                $sql1 = "INSERT INTO orderfood SET
                    iduser = $iduser,
                    tenmon = '$tenmon',
                    gia = '$gia',
                    soluong = $soluong,
                    tongcong = $tongcong,
                    ngaydat = '$ngaydat',
                    status = '$status',
                    tenkh = '$tenkh',
                    contact = '$contact',
                    email = '$email',
                    diachi = '$diachi',
                    ptthanhtoan = '$phuongthuc'
                ";

                $res1 = mysqli_query($conn, $sql1);
                if ($res1 == true) {
                    
                    $sql2 = "DELETE FROM cart WHERE iduser=$iduser";
                    $res2 = mysqli_query($conn, $sql2);

                    $_SESSION['add-orders'] = "<div class='success'> Đặt món thành công </div>";
                    header('location:'.SITEURL.'cart.php');
                }else {
                    $_SESSION['add-orders'] = "<div class='error'> Đặt món không thành công </div>";
                    header('location:'.SITEURL.'cart.php');
                }
            }
        ?>

    </div>
</section>

<?php include("partials-front/footer.php"); ob_end_flush(); ?>