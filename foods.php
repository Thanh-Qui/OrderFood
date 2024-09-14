<?php 
include('partials-front/menu.php');
include('add-cart.php');
ob_start();

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-search">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Thực đơn các món</h2>

            <?php
                $sql = "SELECT * FROM monan WHERE active='Yes' AND dactrung='Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if ($count > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        // lấy giá trị
                        $id = $row['idmonan'];
                        $tenmon = $row['tenmon'];
                        $mota = $row['mota'];
                        $gia = $row['gia'];
                        $image_monan = $row['image_monan'];

                        ?>

                        <form action="" method="POST">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if ($image_monan =="") {
                                            echo "<div class='error'> Chưa thêm ảnh cho món ăn! </div>";
                                        }else {
                                            
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan; ?>" alt="Chicke Hawain Pizza" class="img-custom img-curve">
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
                                    <p class="food-price" name="gia"><?php echo currency_format($gia, "VND") ; ?></p>
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
                    echo "<div class='error> không tìm thấy món ăn! </div>";
                }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ob_end_flush(); ?>