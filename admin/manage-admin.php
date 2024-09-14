<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; // hiện thông báo
            unset($_SESSION['add']); //xoá thông báo
        }
        
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        if (isset($_SESSION['pwd-not-found'])) {
            echo $_SESSION['pwd-not-found'];
            unset($_SESSION['pwd-not-found']);
        }

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }

        if (isset($_SESSION['existUser'])) {
            echo $_SESSION['existUser'];
            unset($_SESSION['existUser']);
        }
        
        ?>

        <hr>

        <!-- Button thêm admin -->
        <a href="add-admin.php" class="btn-primary">Thêm quản trị viên <i class="fa-solid fa-plus"></i></a>

        <br /> <br />

        <table class="tbl-full table table-bordered">
            <tr>
                <th>S.N.</th>
                <th>Họ tên</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //truy vấn đến bảng admin
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);

            //Kiểm tra câu truy vấn
            if ($res == true) {
                //số lượng dòng được truy vấn
                $count = mysqli_num_rows($res); // lấy tất cả các dòng có trong db

                $sn = 1; 

                if ($count > 0) {
                    //Có dữ liệu trong bảng
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['idadmin'];
                        $full_name = $rows['hoten'];
                        $username = $rows['username'];

                        //Hiển thị dữ liệu
            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" onclick="return isDelete('Bạn có muốn xoá thông tin này không?');" class="btn-danger">Delele</a>
                            </td>
                        </tr>

            <?php

                    }
                } else {
                    //không có dữ liệu trong bảng

                }
            }
            ?>

        </table>

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php'); ?>