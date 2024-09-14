<?php include("partials-front/menu.php");
include("partials-front/check-login.php");
ob_start(); ?>
<link rel="stylesheet" href="css/profile.css">

<div class="main-content">
    <div class="wrapper">
        <h1>Gửi tin nhắn</h1>
        <hr><br><br>
        
        <?php
            if (isset($_SESSION['message-user'])) {
                echo $_SESSION['message-user'];
                unset($_SESSION['message-user']);
            }

            if (isset($_SESSION['delete-usermes'])) {
                echo $_SESSION['delete-usermes'];
                unset($_SESSION['delete-usermes']);
            }
        ?>
        <label for="" id="noteMessage" style="color: red;"></label>
        <form action="" method="POST" id="formMessage" onsubmit="return isMessage();">
            <?php
                if ($_SESSION['userlogin']) {

                    $username = $_SESSION['userlogin'];
                    
                    $sql = "SELECT * FROM users WHERE username = '$username'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    
                    if ($count > 0) {
                        $row = mysqli_fetch_assoc($res);
                        $iduser = $row['iduser'];
                        $hoten = $row['hoten'];
                        $email = $row['email'];
                        $sdt = $row['sdt'];
                    }else {
                        echo "<div class='error'> Không có dữ liệu về người dùng này! </div>";
                    }
                }
            ?>
            <table class="tbl-30">
                <tr>
                    <td>Soạn tin nhắn:</td>
                    <td>
                        <textarea class="form-control" name="message" id="" placeholder="Nhập tin nhắn muốn gửi"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>">
                        <input type="hidden" name="hoten" id="" value="<?php echo $hoten; ?>">
                        <input type="hidden" name="email" id="" value="<?php echo $email; ?>">
                        <input type="hidden" name="sdt" id="" value="<?php echo $sdt; ?>">
                        <input class="btn btn-primary" type="submit" name="submit" id="" value="Gửi tin nhắn">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if (isset($_POST['submit'])) {
                $message = $_POST['message'];
                $iduser = $_POST['iduser'];
                $hoten = $_POST['hoten'];
                $email = $_POST['email'];
                $sdt = $_POST['sdt'];
                $trangthai = "No";

                $sql1 = "INSERT INTO `message` SET
                    iduser = $iduser,
                    hoten = '$hoten',
                    email = '$email',
                    sdt = '$sdt',
                    thongtin = '$message',
                    trangthai = '$trangthai'
                ";

                $res1 = mysqli_query($conn, $sql1);
                if ($res1 == true) {
                    $_SESSION['message-user'] = "<div class='success'> Gửi tin nhắn thành công! </div>";
                    header('location:'.SITEURL.'message.php');
                }else {
                    $_SESSION['message-user'] = "<div class='error'> Gửi tin nhắn không thành công! </div>";
                    header('location:'.SITEURL.'message.php');
                }

            }
        
        ?>
        <br><br>
        
        <h1>Thông báo</h1>
        <hr>
        <br>
        
            <?php
                $sql3 = "SELECT * FROM `message` WHERE iduser=$iduser AND trangthai='Yes'";
                $res3 = mysqli_query($conn, $sql3);
                $count3 = mysqli_num_rows($res3);

                

                if ($count3 > 0) {
                    while ($row3 = mysqli_fetch_assoc($res3)) {
                        $idmes = $row3['idmes'];
                        $thongtin = $row3['thongtin'];

                        $sql2 = "SELECT * FROM chatadmin where iduser=$iduser AND idmes=$idmes";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                        
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            
                            $hoten = $row2['hoten'];
                            $message = $row2['message'];

                        ?>
                            <div class="message-box">
                                <p>Họ tên: <?php echo $hoten; ?></p>
                                <p>Tin nhắn: <?php echo $thongtin; ?></p>
                                <p>Phản hồi: <?php echo $message; ?></p>

                                <a class="btn btn-danger" href="delete-Umessage.php?id=<?php echo $idmes ?>" onclick="return isDelete();">Xoá thông báo</a>

                            </div>
                    
                        <?php
                        }
                        
                    }
                }else {
                    echo "<div class='error'> Không có thông báo! </div>";
                }
            ?>


    </div>
</div>


<?php include("partials-front/footer.php"); ob_end_flush(); ?>