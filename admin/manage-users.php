<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Quản lý người dùng</h1>

        <?php
            if (isset($_SESSION['add-users'])) {
                echo $_SESSION['add-users'];
                unset($_SESSION['add-users']);
            }

            if (isset($_SESSION['delete-user'])) {
                echo $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
            }

            if (isset($_SESSION['update-user'])) {
                echo $_SESSION['update-user'];
                unset($_SESSION['update-user']);
            }

            if (isset($_SESSION['change-passwordUser'])) {
                echo $_SESSION['change-passwordUser'];
                unset($_SESSION['change-passwordUser']);
            }

        ?>
        <hr>

        <a href="add-user.php" class="btn-primary">Thêm người dùng <i class="fa-solid fa-plus"></i></a>
        <br><br>

        <table class="tbl-full table table-bordered">
            
            <tr>
                <th>S.N</th>
                <th>Họ tên</th>
                <th>Tài khoản</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>địa chỉ</th>
                <th>Actions</th>
            </tr>

            <?php 
                $sql = "SELECT * FROM users";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $iduser = $row['iduser'];
                        $hoten = $row['hoten'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $sdt = $row['sdt'];
                        $diachi = $row['diachi'];
                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $hoten; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $sdt; ?></td>
                                <td><?php echo $diachi; ?></td>
                                <td>
                                    <a href="<?php SITEURL; ?>change-passwordUser.php?id=<?php echo $iduser; ?>" class="btn-primary">Change password</a>
                                    <a href="<?php SITEURL; ?>update-user.php?id=<?php echo $iduser; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php SITEURL; ?>delete-user.php?id=<?php echo $iduser; ?>" onclick="return isDelete('Bạn có muốn xoá thông này không?');" class="btn-danger">Delele</a>
                                </td>
                            </tr>

                        <?php
                    }
                    
                }else {
                    echo "<div class='error'> Không có dữ liệu! </div>";
                }
            ?>

            
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>