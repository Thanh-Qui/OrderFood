<?php
include('partials/menu.php');
ob_start();
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Cập nhật loại món</h1>
        <hr><br>
        <label for="" id="noteUpdateLM" style="color:  red;"></label>
        <form action="" method="POST" enctype="multipart/form-data" id="formUpdateLoaiMon" onsubmit="return isUpdateLoaiMon();">
            <table class="tbl-30">

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM loaimon WHERE idloaimon = $id";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        //có dữ liệu trong bảng
                        $row = mysqli_fetch_assoc($res);

                        $tenloai = $row['tenloai'];
                        $current_image = $row['image'];
                        $dactrung = $row['dactrung'];
                        $active = $row['active'];
                    }
                    else {
                        $_SESSION['no-category-found'] = "<div class='error'> Không tìm lấy loại món </div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                }
            }
            else {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
                

                if (isset($_SESSION['update-loaimon'])) {
                    echo $_SESSION['update-loaimon'];
                    unset($_SESSION['update-loaimon']);
                }

            ?>

                <tr>
                    <td>Tên loại: </td>
                    <td>
                        <input class="form-control" type="text" name="tenloai" placeholder="Nhập tên loại món" value="<?php echo $tenloai; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Ảnh trước đó:</td>
                    <td>
                        <?php
                            if ($current_image !="") {
                                //Hiển thị hinh ảnh
                                ?>
                                <img src="<?php echo SITEURL; ?>images/loaimon/<?php echo $current_image; ?>" width="180px" height="150px">

                                <?php
                            }
                            else {
                                echo "<div class='error'>Hình ảnh chưa được thêm vào!</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Chọn ảnh mới: </td>
                    <td>
                        <input class="form-control" type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Đặc trưng: </td>
                    <td>
                        <input <?php if($dactrung == "Yes"){echo "checked";} ?> class="btn-check" type="radio" name="dactrung" id="success-outlined" value="Yes" >
                        <label class="btn btn-outline-success" for="success-outlined">Yes</label>

                        <input <?php if($dactrung == "No"){echo "checked";} ?> class="btn-check" type="radio" name="dactrung" id="danger-outlined" value="No" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined">No</label>

                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";} ?> class="btn-check" type="radio" name="active" id="success-outlined1" value="Yes" autocomplete="off" >
                        <label class="btn btn-outline-success" for="success-outlined1">Yes</label>

                        <input <?php if($active == "No"){echo "checked";} ?> class="btn-check" type="radio" name="active" id="danger-outlined1" value="No" autocomplete="off">
                        <label class="btn btn-outline-danger" for="danger-outlined1">No</label>

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" id="" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" id="" value="<?php echo $id; ?>">
                        <input class="btn btn-outline-success" type="submit" name="submit" id="" value="Cập nhật loại món">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
if (isset($_POST['submit'])) {
    
    $id = $_POST['id'];
    $tenloai = $_POST['tenloai'];
    $current_image = $_POST['current_image'];
    $dacTrung = $_POST['dactrung'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
    
        if ($image != "") {

            //tự động rename hình ảnh
            $tmp = explode('.',$image);
            $ext1 = end($tmp);
            $image = "LoaiMonAn_" . rand(000, 999) . '.' . $ext1;

            $source_path = $_FILES['image']['tmp_name'];
            $destination = "../images/loaimon/" . $image;

            $upload = move_uploaded_file($source_path,$destination);

            //kiểm tra liệu hình ảnh có được upload chưa
            //nếu hình ảnh ko đc uploaded thì sẽ dừng và chuyên trang với thông báo lỗi
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'> Thêm ảnh không thành công </div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
                // dừng quá trình thêm
                die();
            }
            

            //Xoá hình hiện tại để update ảnh mới
            if ($current_image !="") {
                $remove_path = "../images/loaimon/".$current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['failed-remove'] = "<div class='error'> Xoá ảnh hiện tại không thành công </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
            }

        }else {
            $image = $current_image;
        }
    }else {
        $image = $current_image;
    }

    $sql2 = "UPDATE loaimon SET 
        tenloai = '$tenloai',
        image = '$image',
        dactrung = '$dacTrung',
        active = '$active'
        WHERE idloaimon = $id
        ";
    
    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['update-loaimon'] = "<div class='success'> Cập nhật loại món thành công </div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }else {
        $_SESSION['update-loaimon'] = "<div class='error'> Cập nhật loại món không thành công </div>";
        header('location:'.SITEURL.'admin/update-loaimon.php');
    }
}


ob_end_flush();
?>