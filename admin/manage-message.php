<?php include("partials/menu.php"); ob_start(); ?>

<div class="main content">
    <div class="wrapper">
        <h1>Thông báo</h1>
        <hr>
        <?php
            if (isset($_SESSION['delete-message'])) {
                echo $_SESSION['delete-message'];
                unset($_SESSION['delete-message']);
            }

            if (isset($_SESSION['chat-admin'])) {
                echo $_SESSION['chat-admin'];
                unset($_SESSION['chat-admin']);
            }

        ?>
        <br>

        <?php
            $sql = "SELECT * FROM `message`";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $idmes = $row['idmes'];
                    $iduser = $row['iduser'];
                    $hoten = $row['hoten'];
                    $email = $row['email'];
                    $sdt = $row['sdt'];
                    $thongtin = $row['thongtin'];
                    $trangthai = $row['trangthai'];
                ?>
                <form action="" method="POST">
                    <div class="message-box">
                        <p class="one-line" >Họ tên: <?php echo $hoten; ?> </p>
                        <p class="one-line" > | số điện thoại: <?php echo $sdt; ?></p>
                        <p class="one-line" > | email: <?php echo $email; ?></p>
                        <p>Tin nhắn: <?php echo $thongtin; ?></p>
                        
                        <div class="showMessage">
                        
                            <a class="btn btn-danger" href="delete-message.php?id=<?php echo $idmes; ?>" onclick="return isDelete();">Xoá tin nhắn</a>
                            <?php
                            
                                if ($trangthai == "Yes") {
                                    ?>
                                    <a class="btn btn-warning" href="">Đã trả lời tin nhắn</a>
                                    <!-- <p class="btn btn-warning">Đã trả lời tin nhắn</p> -->
                                    <?php
                                }else {
                                    ?>
                                    <a class="btn btn-success" id="show-<?php echo $idmes; ?>" onclick="isShowMessage(<?php echo $idmes; ?>); return false;">Trả lời tin nhắn</a>
                                    <?php
                                }

                            ?>
                            
                            
                            <div class="showMessage" id="messageBox-<?php echo $idmes; ?>" style="display: none;">
                                
                                <input type="hidden" name="idmes" id="" value="<?php echo $idmes; ?>">
                                <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>" >
                                <input class="form-control"  type="text" name="message" id="" placeholder="Nhập tin nhắn gửi">
                                <input class="btn btn-success" type="submit" name="submit" id="" value="Gửi tin nhắn">  
                               
                            </div>
                        </div>
                        
                    </div>
                </form>
                    

                <?php
                    
                }
            }else {
                echo "<div class='error'> Không có thông báo! </div>";
            }
        ?>

        <?php

        if (isset($_POST['submit'])) {
            $username = $_SESSION['admin'];
            $idmes = $_POST['idmes'];
            $iduser = $_POST['iduser'];
            $message = $_POST['message'];
            $trangthai = "Yes";
            
            $sql1 = "SELECT * FROM admin WHERE username='$username'";
            $res1 = mysqli_query($conn, $sql1);
            $count1 = mysqli_num_rows($res1);
            if ($count1 > 0) {
                $row = mysqli_fetch_assoc($res1);
                $hotenadmin = $row['hoten'];
                
                $sql2 = "INSERT INTO chatadmin SET
                    iduser = $iduser,
                    idmes = $idmes,
                    hoten = '$hotenadmin',
                    message = '$message'
                 ";
                 $res2 = mysqli_query($conn, $sql2);
                 if ($res2 == true) {
                    $_SESSION['chat-admin'] = "<div class='success'> Gửi tin nhắn thành công </div>";
                    header('location:'.SITEURL.'admin/manage-message.php');
                    
                    $sql3 = "UPDATE `message` SET
                        trangthai = '$trangthai'
                        WHERE idmes = $idmes
                    ";
                    $res3 = mysqli_query($conn, $sql3);

                 }else {
                    $_SESSION['chat-admin'] = "<div class='error'> Gửi tin nhắn không thành công </div>";
                    header('location:'.SITEURL.'admin/manage-message.php');
                 }
            }else {
                echo "Không có thông tin!";
            }
        }

        ?>

    </div>
</div>


<?php include("partials/footer.php"); ob_end_flush(); ?>