<?php include('partials/menu.php'); 
ob_start();
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Món Ăn</h1>

        <hr><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <label for="" id="noteAddMonAn" style="color:  red;"></label>
        <form action="" method="POST" enctype="multipart/form-data" id="formAddMonAn" onsubmit="return isAddMonAn();">
            <table class="tbl-30">

                <tr>
                    <td>Tên Món:</td>
                    <td>
                        <input class="form-control" type="text" name="tenmon" id="" placeholder="Tên Món">
                    </td>
                </tr>

                <tr>
                    <td>Mô tả:</td>
                    <td>
                        <textarea class="form-control" name="mota" cols="30" rows="5" placeholder="Mô tả món ăn"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Đơn giá:</td>
                    <td>
                        <input class="form-control" type="number" name="gia" placeholder="Đơn giá">
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
                        <select class="form-select" name="loaimon" id="">
                            <?php
                            //tạo php để hiện thị loại món ăn từ db
                            //sql select để lấy tất cả các loại món ăn từ db
                            //hiện thị dạng dropdown
                            $sql = "SELECT * FROM loaimon WHERE active ='Yes'";
                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //có dữ liệu trong bảng
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['idloaimon'];
                                    $tenloai = $row['tenloai'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $tenloai; ?></option>

                                <?php
                                }
                            }else {
                                ?>
                                    <option value="0">Không có dữ liệu về các món ăn</option>

                                <?php
                                
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Đặc trưng: </td>
                    <td>
                        <input class="btn-check" type="radio" name="dactrung" id="success-outlined" value="Yes"  autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="success-outlined">Yes</label>

                        <input class="btn-check" type="radio" name="dactrung" id="danger-outlined" value="No" autocomplete="off" >
                        <label class="btn btn-outline-danger" for="danger-outlined">No</label>
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input class="btn-check" type="radio" name="active" id="success-outlined1" value="Yes"  autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="success-outlined1">Yes</label>

                        <input class="btn-check" type="radio" name="active" id="danger-outlined1" value="No" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined1">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input class="btn btn-outline-success" type="submit" name="submit" value="Thêm món ăn">
                    </td>
                </tr>

            </table>
        </form>


        <?php

        if (isset($_POST['submit'])) {
            // lấy dữ liệu từ form 
            $tenmon = $_POST['tenmon'];
            $mota = $_POST['mota'];
            $gia = $_POST['gia'];

            $loaimon = $_POST['loaimon'];

            //kiểm tra radio button của đặc trung và active
            if (isset($_POST['dactrung'])) {
                $dactrung = $_POST['dactrung'];
            } else {
                $dactrung = "No"; // đặt giá trị mặc định
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; // đặt giá trị mặc định
            }

            //kiểm tra liệu hình ảnh đã chọn có tồn tại không
            if (isset($_FILES['image_monan']['name'])) {
                $image_monan = $_FILES['image_monan']['name'];
                if ($image_monan != "") {

                    $tmp = explode('.', $image_monan);
                    $ext1 = end($tmp);

                    $image_monan = "MonAn-".rand(0000, 9999).'.'.$ext1;

                    //nguồn hiện tại của hinh ảnh
                    $src = $_FILES['image_monan']['tmp_name'];
                    $dst = "../images/monan/".$image_monan;

                    $upload = move_uploaded_file($src, $dst);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'> Upload ảnh không thành công </div>";
                        header('location:'.SITEURL.'admin/add-monan.php');
                        die();
                    }
                }else $image_monan = "";
                
            } else {
                $image_monan = "";
            }

            //tạo câu truy vấn sql Insert dữ liệu
            $sql1 = "INSERT INTO monan SET
                tenmon = '$tenmon',
                mota = '$mota',
                gia = $gia,
                image_monan = '$image_monan',
                idloaimon = $loaimon,
                dactrung = '$dactrung',
                active = '$active'
                ";

            $res1 = mysqli_query($conn, $sql1);
            if ($res1 == true) {
                $_SESSION['add-monan'] = "<div class='success'> Thêm món ăn thành công </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['add-monan'] = "<div class='error'> Thêm món ăn không thành công </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); 
ob_end_flush();
?>
