<?php include('partials/menu.php');
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Thêm Loại Món</h1>

        <hr><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <label for="" id="noteAddLoaiMon" style="color: red;"></label>
        <form action="" method="POST" enctype="multipart/form-data" id="formAddLoaiMon" onsubmit="return isAddLoaiMon();">
            <table class="tbl-30" >

                <tr>
                    <td>Tên loại: </td>
                    <td>
                        <input class="form-control" type="text" name="tenloai" placeholder="Nhập tên loại món">
                    </td>
                </tr>

                <tr>
                    <td>Chọn Hình ảnh: </td>
                    <td>
                        <input class="form-control" type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Đặc trưng: </td>
                    <td>
                        <input class="btn-check" type="radio" name="dactrung" id="success-outlined" value="Yes"  autocomplete="off" checked>
                        <label class="btn btn-outline-success" for="success-outlined">Yes</label>

                        <input class="btn-check" type="radio" name="dactrung" id="danger-outlined" value="No" autocomplete="off">
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
                        <input class="btn btn-outline-success" type="submit" name="submit" id="" value="Thêm loại món">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
    if (isset($_POST['submit'])) {
        
        //lấy dữ liệu từ form trên
        $tenLoai = $_POST['tenloai'];

        if (isset($_POST['dactrung'])) {
            //lấy giá trị từ form
            $dacTrung = $_POST['dactrung'];
        }else {
            //đặt giá trị là mặc định
            $dacTrung = "No";
        }

        if (isset($_POST['active'])) {
            //lấy giá trị từ form
            $active = $_POST['active'];
        }else {
            //đặt giá trị là mặc định
            $active = "No";
        }

    //kiểm tra hình ảnh
    // print_r($_FILES['image']);
    // die();

    if (isset($_FILES['image']['name'])) {
        //upload the image
        //để upload thì cần phải có tên hình ảnh, nguồn và destination path


        $image = $_FILES['image']['name'];
        if ($image != "") {
            //tự động rename hình ảnh
            $ext = end(explode('.', $image));
            $image = "LoaiMonAn_" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination = "../images/loaimon/" . $image;

            $upload = move_uploaded_file($source_path,
                $destination
            );

            //kiểm tra liệu hình ảnh có được upload chưa
            //nếu hình ảnh ko đc uploaded thì sẽ dừng và chuyên trang với thông báo lỗi
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'> Thêm ảnh không thành công </div>";
                header('location:' . SITEURL . 'admin/add-loaimon.php');
                // dừng quá trình thêm
                die();
            }
        }
    } else {
        $image = "";
    }


        $sql = "INSERT INTO loaimon SET
        tenloai = '$tenLoai',
        image = '$image',
        dactrung = '$dacTrung',
        active = '$active'
        ";
        $res = mysqli_query($conn, $sql);

        //kiểm tra câu truy vấn
        if ($res == true) {
            $_SESSION['add'] = "<div class='success'> Thêm loại món thành công </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }else {
            $_SESSION['add'] = "<div class='error'> Thêm loại món không thành công </div>";
            header('location:'.SITEURL.'admin/add-loaimon.php');
        }
    }
    

?>

    </div>
</div>

<?php include('partials/footer.php');
ob_end_flush();
?>

