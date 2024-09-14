<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý đặt món</h1>

        <br /> <hr>

        <?php 

            if (isset($_SESSION['update-order'])) {
                echo $_SESSION['update-order'];
                unset($_SESSION['update-order']);
            }

            if (isset($_SESSION['deleteOrder'])) {
                echo $_SESSION['deleteOrder'];
                unset($_SESSION['deleteOrder']);
            }

        ?>
        <br>

        <table class="tbl-full table table-bordered">
            <tr>
                <th>S.N.</th>
                <th>Món ăn</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng cộng</th>
                <th>Ngày đặt</th>
                <th>Tình trạng</th>
                <th>Họ tên KH</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Thanh toán</th>
                <th>Actions</th>
            </tr>

            <?php
                // Tạo câu truy vấn select để lấy dữ liệu order food
                $sql = "SELECT * FROM orderfood ORDER BY idorder DESC";
                $res = mysqli_query($conn ,$sql);

                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    
                    while ($row = mysqli_fetch_assoc($res)) {
                        $idorder = $row['idorder'];
                        $tenmon = $row['tenmon'];
                        $gia = $row['gia'];
                        $soluong = $row['soluong'];
                        $tongcong = $row['tongcong'];
                        $ngaydat = $row['ngaydat'];
                        $status = $row['status'];
                        $tenkh = $row['tenkh'];
                        $contact = $row['contact'];
                        $email = $row['email'];
                        $diachi = $row['diachi'];
                        $phuongthuc = $row['ptthanhtoan'];
                        ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $tenmon; ?></td>
                                <td><?php echo $gia ?></td>
                                <td><?php echo $soluong; ?></td>
                                <td><?php echo currency_format($tongcong, "VND"); ?></td>
                                <td><?php echo $ngaydat; ?></td>
                                
                                <td>
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

                                </td>

                                <td><?php echo $tenkh; ?></td>
                                <td><?php echo $contact; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $diachi; ?></td>
                                <td><?php echo $phuongthuc; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $idorder; ?>" class="btn btn-success" style="margin-bottom: 5px;">Update</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $idorder; ?>" onclick="return isDelete('Bạn có muốn xoá thông tin này không?');" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                        <?php
                    }

                    
                }else {
                    echo "<tr><td colspan='12' class='error'> không tìm thấy dữ liệu! </td></tr>";
                }


            ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>