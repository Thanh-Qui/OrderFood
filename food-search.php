<?php include('partials-front/menu.php');
include('add-cart.php'); ob_start(); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php

            if (isset($_POST['search'])) {
                // lấy giá trị search với keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn ,$_POST['search']);
            }else {
                header('location:'.SITEURL);
            }
            
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-orange"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //SQL select với keyword
                // $search = 
                // select * from monan WHERE tenmon LIKE '$$' OR mota LIKE '$$';
                $sql = "SELECT * FROM monan WHERE tenmon LIKE '%$search%' OR mota LIKE '%$search%'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if ($count > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['idmonan'];
                        $tenmon = $row['tenmon'];
                        $gia = $row['gia'];
                        $mota = $row['mota'];
                        $image_monan = $row['image_monan'];
                        ?>

                        <form action="" method="POST">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if ($image_monan =="") {
                                            echo "<div class='error'> chưa thêm hình ảnh món ăn </div>";
                                        }
                                        else {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan; ?>" alt="Not Image" class="img-custom img-curve">
                                            <?php
                                        }

                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <?php if (!isset($_SESSION['userlogin'])) {
                                        
                                    }else {
                                        ?>
                                         <button type="submit" class="fa-solid fa-circle-plus right" name="add-cart"></button>
                                        <?php
                                    } 
                                    ?>
                                    
                                    <h4><?php echo $tenmon; ?></h4>
                                    <p class="food-price"><?php echo currency_format($gia, "VND"); ?></p>
                                    <p class="food-detail">
                                        <?php echo $mota; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?idmonan=<?php echo $id; ?>" class="btn btn-search">đặt món</a>
                                    <input type="hidden" name="gia" id="" value="<?php echo $gia; ?>">
                                    <input type="hidden" name="tenmon" value="<?php echo $tenmon; ?>">
                                    <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>">
                                </div>
                            </div>
                        </form>
                            

                        <?php

                    }
                    
                }else {
                    echo "<div class='error'> Không tìm thấy món ăn </div>";
                }
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ob_end_flush(); ?>