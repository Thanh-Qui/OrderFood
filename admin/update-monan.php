<?php include('partials/menu.php'); 
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        
        <form action="" method="POST" enctype="multipart/form-data" id="formUpdateMonAn" onsubmit="return isUpdateMonAn();">
            <table class="tbl-30">
                <h1>Cập nhật món ăn</h1> 
                <hr><br>
                    <label for="" id="noteUpdateMonAn" style="color: red;"></label>
                <?php
                    if (isset($_GET['id'])) {

                        $id = $_GET['id'];
                        $sql = "SELECT * FROM monan WHERE idmonan = $id";
                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {

                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $tenmon = $row['tenmon'];
                                    $mota = $row['mota'];
                                    $gia = $row['gia'];
                                    $current_image = $row['image_monan'];
                                    $current_loaimon = $row['idloaimon'];
                                    $dactrung = $row['dactrung'];
                                    $active = $row['active'];
                                }
                            } else {

                            } 

                        }
                        
                    }else {
                        // $_SESSION['hello'] = "<div class='success'> HELLO </div>";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    

                ?>

                <tr>
                    <td>Tên Món:</td>
                    <td>
                        <input class="form-control" type="text" name="tenmon" id="" placeholder="Tên Món" value="<?php echo $tenmon; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả:</td>
                    <td>
                        <textarea class="form-control" name="mota" cols="30" rows="5" placeholder="Mô tả món ăn"><?php echo $mota; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Đơn giá:</td>
                    <td>
                        <input class="form-control" type="number" name="gia" placeholder="Đơn giá" value="<?php echo $gia; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ảnh trước đó:</td>
                    <td>
                        <?php
                            if ($current_image !="") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/monan/<?php echo $current_image; ?>" alt=""  width="180px" height="150px">
                                <?php
                            }else {
                                echo "<div class='error'>Hình ảnh chưa được thêm vào!</div>";
                            }
                        ?>
                        
                    </td>
                </tr>

                <tr>
                    <td>Chọn hình ảnh: </td>
                    <td>
                        <input class="form-control" type="file" name="image_monan" id="">
                    </td>

                </tr>

                <tr>
                    <td>Loại món: </td>
                    <td>
                        <select class="form-select" name="loaimon" id="" >
                            
                            <?php
                                $sql1 = "SELECT * FROM loaimon WHERE active='Yes'";
                                $res1 = mysqli_query($conn, $sql1);
                                $count = mysqli_num_rows($res1);
                                
                                if ($count > 0) {
                                    while($row1 = mysqli_fetch_assoc($res1)){
                                        $idloaimon = $row1['idloaimon'];
                                        $tenloai = $row1['tenloai'];
                                        ?>
                                            <option <?php if($current_loaimon == $idloaimon){ echo "selected";} ?> value="<?php echo $idloaimon; ?>"><?php echo $tenloai; ?></option>
                                        <?php
                                    }
                                }else {
                                    echo "<div class='error'> Không có loại món </div>";
                                }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Đặc trưng: </td>
                    <td>
                        <input <?php if($dactrung == "Yes"){echo "checked";} ?> class="btn-check" type="radio" name="dactrung" id="success-outlined" value="Yes" autocomplete="off" >
                        <label class="btn btn-outline-success" for="success-outlined">Yes</label>

                        <input <?php if($dactrung == "No"){echo "checked";} ?> class="btn-check" type="radio" name="dactrung" id="danger-outlined" value="No" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined">No</label>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?>  class="btn-check" type="radio" name="active" id="success-outlined1" value="Yes" autocomplete="off" >
                        <label class="btn btn-outline-success" for="success-outlined1">Yes</label>

                        <input <?php if($active == "No"){echo "checked";} ?>  class="btn-check" type="radio" name="active" id="danger-outlined1" value="No" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined1">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        
                        <input class="btn btn-outline-success" type="submit" name="submit" value="Cập nhật món ăn">
                    </td>
                </tr>

            </table>
        </form>


        <?php
            if (isset($_POST['submit'])) {

                $id = $_POST['id'];
                $tenmon = $_POST['tenmon'];
                $mota = $_POST['mota'];
                $gia = $_POST['gia'];
                $current_image = $_POST['current_image'];
                $loaimon = $_POST['loaimon'];
                $dactrung = $_POST['dactrung'];
                $active = $_POST['active'];

                if (isset($_FILES['image_monan']['name'])) {
                    $image_monan = $_FILES['image_monan']['name'];
                
                    if ($image_monan != "") {
            
                        //tự động rename hình ảnh
                        $tmp = explode('.',$image_monan);
                        $ext1 = end($tmp);
                        $image_monan = "MonAn-" . rand(0000, 9999) . '.' . $ext1;
            
                        $source_path = $_FILES['image_monan']['tmp_name'];
                        $destination = "../images/monan/" . $image_monan;
            
                        $upload = move_uploaded_file($source_path,$destination);
            
                        //kiểm tra liệu hình ảnh có được upload chưa
                        //nếu hình ảnh ko đc uploaded thì sẽ dừng và chuyên trang với thông báo lỗi
                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'> Thêm ảnh không thành công </div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            // dừng quá trình thêm
                            die();
                        }
                        
            
                        //Xoá hình hiện tại để update ảnh mới
                        if ($current_image !="") {
                            $remove_path = "../images/monan/".$current_image;
                            $remove = unlink($remove_path);
            
                            if ($remove == false) {
                                $_SESSION['failed-remove'] = "<div class='error'> Xoá ảnh hiện tại không thành công </div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                        
            
                        
                    }else {
                        $image_monan = $current_image;
                    }
                }else {
                    $image_monan = $current_image;
                }

                $sql2 = "UPDATE monan SET
                        tenmon = '$tenmon',
                        mota = '$mota',
                        gia = '$gia',
                        image_monan = '$image_monan',
                        idloaimon = '$loaimon',
                        dactrung = '$dactrung',
                        active = '$active'
                        WHERE idmonan = $id
                ";

                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == true) {
                    $_SESSION['update-monan'] = "<div class='success'> Cập nhật món ăn thành công </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else {
                    $_SESSION['update-monan'] = "<div class='error'> Cập nhật món ăn không thành công </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); 
ob_end_flush();
?>