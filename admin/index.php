<?php include('partials/menu.php'); ?>

    <!-- Main Content Section Start -->
    <div class="main-content">
    <div class="wrapper">
           <h1>DASHBOARD</h1>
          <br>
           <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
               echo $_SESSION['no-login-message'];
               unset($_SESSION['no-login-message']);
           }
          ?>

           <div class="col-4 text-center">
               <?php 
                    $sql = "SELECT * FROM loaimon";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res)

               
               ?>
                <h1><?php echo $count; ?></h1>
                <br>
                Loại món
           </div>

           <div class="col-4 text-center">
               <?php 
                    $sql2 = "SELECT * FROM monan";
                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2)
               ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                Món ăn
           </div>

           <div class="col-4 text-center">
               <?php 
                    $sql3 = "SELECT * FROM orderfood";
                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3)
               ?>
                <h1><?php echo $count3; ?></h1>
                <br>
                Tổng số đơn đặt
           </div>

           <div class="col-4 text-center">
               <?php
                    //tạo câu truy vấn để lấy tổng doanh thu
                    $sql4 = "SELECT SUM(tongcong) AS tongcong FROM orderfood WHERE status = 'đã giao hàng'";
                    $res4 = mysqli_query($conn,$sql4);

                    $row4 = mysqli_fetch_assoc($res4);

                    $tongdoanhthu = $row4['tongcong'];

                    $tongdt = $tongdoanhthu > 0 ? $tongdoanhthu : 0;
               ?>
                <h1><?php echo $tongdt;  ?></h1>
                <br>
                Doanh thu
           </div>

           <div class="col-4 text-center">
               <?php
                    $sql5 = "SELECT * FROM users";
                    $res5 = mysqli_query($conn, $sql5);
                    $count5 = mysqli_num_rows($res5);

               ?>
                <h1><?php echo $count5;  ?></h1>
                <br>
                Người dùng
           </div>

           <div class="col-4 text-center">
               <?php
                    $sql6 = "SELECT * FROM message";
                    $res6 = mysqli_query($conn, $sql6);
                    $count6 = mysqli_num_rows($res6);

               ?>
                <h1><?php echo $count6;  ?></h1>
                <br>
                Thông báo
           </div>

           <div class="clearfix"></div>

        </div>
    </div>
    <!-- Main Content Section End -->

<?php include('partials/footer.php');  ?>
<!--13. -->