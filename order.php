<?php include('partials-front/menu.php'); 
// include('loginUser.php');
include('partials-front/check-login.php'); ob_start();
?>

<?php
    //kiểm tra xem id của món đó có tồn tại hay không
    if (isset($_GET['idmonan'])) {
        // lấy id để select đến món ăn
        $idmonan = $_GET['idmonan'];

        //lấy mô tả và select món ăn
        $sql = "SELECT * FROM monan WHERE idmonan=$idmonan";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count > 0) {
            //Có dữ liệu của các món ăn trả về
            $row = mysqli_fetch_assoc($res);

            $tenmon = $row['tenmon'];
            $gia = $row['gia'];
            $image_monan = $row['image_monan'];

            
        }else {
            echo "<div class='error'> Không tìm thấy món ăn! </div>";
        }
    }else {
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-black">Điền vào mẫu này để xác nhận đơn hàng của bạn.</h2>

            <form action="#" class="order" method="POST">
                <fieldset>
                    <legend>Món đã chọn</legend>

                    

                    <div class="food-menu-img">
                        <?php

                            if ($image_monan =="") {
                                echo "<div class='error'> Chưa có hình ảnh cho món ăn này </div>";
                            }else {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $tenmon; ?></h3>
                        <input type="hidden" name="tenmon" value="<?php echo $tenmon; ?>">

                        <p class="food-price"><?php echo currency_format($gia, "VND"); ?></p>
                        <input type="hidden" name="gia" value="<?php echo $gia; ?>">

                        <div class="order-label">Số lượng</div>
                        <input type="number" name="soluong" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
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
                    
                    <input type="hidden" name="iduser" id="" value="<?= $iduser; ?>">
                    <input type="submit" name="submit" value="Đồng ý đặt món" class="btn btn-search">
                </fieldset>

            </form>

            <?php

                //kiểm tra liệu nút submit có kích hoạt không
                if (isset($_POST['submit'])) {
                    $iduser = $_POST['iduser'];
                    $tenmon = $_POST['tenmon'];
                    $gia = $_POST['gia'];
                    $soluong = $_POST['soluong'];
                    $tongcong = $gia * $soluong; //tính tổng tiền của đơn đặt

                    $ngaydat = date("Y-m-d h:i:sa"); // ngày đặt của đơn đặt
                    $status = "đã đặt"; // trạng thái đã đặt

                    $tenkh = $_POST['tenkh'];
                    $contact = $_POST['contact'];
                    $email = $_POST['email'];
                    $diachi = $_POST['diachi'];
                    $phuongthuc = $_POST['phuongthuc'];

                    $sql2 = "INSERT INTO orderfood SET
                        iduser = $iduser,
                        tenmon = '$tenmon',
                        gia = $gia,
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

                    // echo $sql2; die();

                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == true) {
                        //câu truy vấn thành công và lưu dữ liệu
                        $_SESSION['order'] = "<div class='success text-center'> Thêm đơn đặt thành công </div>";
                        header('location:'.SITEURL);
                    }else {
                        $_SESSION['order'] = "<div class='error text-center'> Thêm đơn đặt không thành công </div>";
                        header('location:'.SITEURL);
                    }

                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ob_end_flush(); ?>