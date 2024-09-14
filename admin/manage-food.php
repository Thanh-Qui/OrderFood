<?php include('partials/menu.php'); 
ob_start();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý Món ăn</h1>

        <hr>

        <!-- Button thêm admin -->
        <a href="<?php echo SITEURL; ?>admin/add-monan.php" class="btn-primary">Thêm Món ăn</a>

        <br /> <br />

        <?php
        if (isset($_SESSION['add-monan'])) {
            echo $_SESSION['add-monan'];
            unset($_SESSION['add-monan']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }

        if (isset($_SESSION['update-monan'])) {
            echo $_SESSION['update-monan'];
            unset($_SESSION['update-monan']);
        }

        ?>

        <table class="tbl-full table table-bordered">
            <tr>
                <th>S.N.</th>
                <th>Tên Món</th>
                <th>Đơn giá</th>
                <th>Hình ảnh</th>
                <th>Đặc trưng</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM monan";
            $res = mysqli_query($conn, $sql);


            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['idmonan'];
                    $tenmon = $row['tenmon'];
                    $gia = $row['gia'];
                    $image_monan = $row['image_monan'];
                    $dactrung = $row['dactrung'];
                    $active = $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $tenmon; ?></td>
                        <td><?php echo currency_format($gia, 'VND') ; ?></td>

                        <td>
                            <?php
                            if ($image_monan != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan; ?>" width="100px" height="auto">
                            <?php
                            } else {
                                echo "<div class='error'> Chưa thêm hình ảnh </div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $dactrung; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-monan.php?id=<?php echo $id; ?>&image_monan=<?php echo $image_monan; ?>" class="btn btn-success">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-monan.php?id=<?php echo $id; ?>&image_monan=<?php echo $image_monan; ?>" onclick="return isDelete('Bạn có muốn xoá thông tin này không?');" class="btn btn-danger">Delele</a>
                        </td>
                    </tr>


            <?php

                }
            } else {
                echo "<div class='error'> Chưa có dữ liệu về các món ăn </div>";
            }
            ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); 
ob_end_flush();
?>