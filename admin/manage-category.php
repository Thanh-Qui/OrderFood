<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý thực đơn</h1>
        <hr>
        
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['delete-loaimon'])) {
            echo $_SESSION['delete-loaimon'];
            unset($_SESSION['delete-loaimon']);
        }

        if (isset($_SESSION['update-loaimon'])) {
            echo $_SESSION['update-loaimon'];
            unset($_SESSION['update-loaimon']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])) {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        
        ?>
        <br>


        <!-- Button thêm admin -->
        <a href="<?php echo SITEURL; ?>admin/add-loaimon.php" class="btn-primary">Thêm Thực đơn</a>

        <br /> <br />

        <table class="tbl-full table table-bordered table-hover">
            <thead class="table-light">
               <tr>
                <th>S.N.</th>
                <th>Tên loại món</th>
                <th>Hình ảnh</th>
                <th>Đặc trưng </th>
                <th>Active </th>
                <th>Action </th>
            </tr> 
            </thead>
            

            <?php
            $sql = "SELECT * FROM loaimon";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            $sn = 1;
            //kiểm tra xam có dữ liệu trong bảnh hay không
            if ($count > 0) {
                //lấy dữ liệu và hiển thị
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['idloaimon'];
                    $tenloai = $row['tenloai'];
                    $image = $row['image'];
                    $dactrung = $row['dactrung'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $tenloai; ?></td>

                        <td>
                            <?php
                                //kiểm tra tên hình ảnh có đúng ko
                                if ($image!="") {
                                    ?>
                                        <img src="<?php echo SITEURL;?>images/loaimon/<?php echo $image; ?>" width="100px" height="auto">

                                    <?php
                                    
                                }else {
                                    echo "<div class='error'> Chưa thêm hình ảnh </div>";
                                }
                            ?>
                        </td>

                        <td><?php echo $dactrung; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-loaimon.php?id=<?php echo $id; ?>" class="btn btn-success">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-loaimon.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" onclick="return isDelete('Bạn có muốn xoá thông tin này không?')" class="btn btn-danger">Delele</a>
                        </td>
                    </tr>

                <?php
                }
            } else {
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error">Chưa có Loại món được thêm</div>
                    </td>
                </tr>

            <?php
            }
            ?>



        </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>