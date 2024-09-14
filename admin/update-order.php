<?php include('partials/menu.php');
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật đặt món</h1>
        <hr><br>

        <?php 

            if (isset($_GET['id'])) {

                $idorder = $_GET['id'];

                $sql = "SELECT * FROM orderfood WHERE idorder=$idorder";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1) {

                    $row = mysqli_fetch_assoc($res);
                    
                    $tenmon = $row['tenmon'];
                    $gia = $row['gia'];
                    $soluong = $row['soluong'];
                    $status = $row['status'];
                    $tenkh = $row['tenkh'];
                    $contact = $row['contact'];
                    $email = $row['email'];
                    $diachi = $row['diachi'];

                }else {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                
            }
            else {
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>
        <label for="" id="noteUpdateOrder" style="color: red;"></label>
        <form action="" method="POST" id="formUpdateOrder" onsubmit="return isUpdateOrder();">
            
            <table class="tbl-30">
                <tr>
                    <td>Tên món:</td>
                    <td>
                        <b class="form-control"><?php echo $tenmon; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Đơn giá:</td>
                    <td>
                        <b class="form-control"><?php echo $gia; ?> VND</b>
                    </td>
                </tr>

                <tr>
                    <td>Số lượng</td>
                    <td>
                        <input class="form-control" type="number" name="soluong" id="" value="<?php echo $soluong; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Tình trạng</td>
                    <td>
                        <select class="form-select" name="status" id="">
                            <option <?php if($status=="đã đặt"){echo "selected";} ?> value="đã đặt">đã đặt</option>
                            <option <?php if($status=="đang giao hàng"){echo "selected";} ?> value="đang giao hàng">đang giao hàng</option>
                            <option <?php if($status=="đã giao hàng"){echo "selected";} ?> value="đã giao hàng">đã giao hàng</option>
                            <option <?php if($status=="đã huỷ đơn"){echo "selected";} ?> value="đã huỷ đơn">đã huỷ đơn</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Họ tên KH:</td>
                    <td>
                        <input class="form-control" type="text" name="tenkh" id="" value="<?php echo $tenkh; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Contact:</td>
                    <td>
                        <input class="form-control" type="text" name="contact" id="" value="<?php echo $contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input class="form-control" type="text" name="email" id="" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Địa chỉ:</td>
                    <td>
                        <textarea class="form-control" name="diachi" cols="30" rows="5"><?php echo $diachi; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="idorder" value="<?php echo $idorder; ?>">
                        <input type="hidden" name="gia" value="<?php echo $gia; ?>">
                        <input class="btn btn-outline-success" type="submit" name="submit" id="" value="Cập nhật đơn đặt">
                    </td>
                </tr>

            </table>


        </form>

        <?php 
            //kiểm tra nút submit
            if (isset($_POST['submit'])) {

                $idorder = $_POST['idorder'];
                $gia = $_POST['gia'];
                $soluong = $_POST['soluong'];
                
                $tongcong = (int)$gia * $soluong;

                $status = $_POST['status'];
                $tenkh = $_POST['tenkh'];
                $contact = $_POST['contact'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];
                
                $sql2 = "UPDATE orderfood SET
                    soluong = $soluong,
                    tongcong = $tongcong,
                    status = '$status',
                    tenkh = '$tenkh',
                    contact = '$contact',
                    email = '$email',
                    diachi = '$diachi'
                    WHERE idorder = $idorder;
                ";

                $res2 = mysqli_query($conn , $sql2);
                if ($res2 == true) {

                    $_SESSION['update-order'] = "<div class='success'> Cập nhật thành công </div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                    
                }else {
                    $_SESSION['update-order'] = "<div class='error'> Cập nhật không thành công </div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        
        
        ?>



    </div>
</div>


<?php include('partials/footer.php'); 
    ob_end_flush();
?>
