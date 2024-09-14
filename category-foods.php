<?php include('partials-front/menu.php');
include("add-cart.php"); ob_start(); ?>

<?php

    //kiểm tra liệu id có được gửi hay chưa
    if (isset($_GET['idloaimon'])) {
        $idloaimon = $_GET['idloaimon'];
        $sql = "SELECT tenloai FROM loaimon WHERE idloaimon=$idloaimon";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);
        $tenloai = $row['tenloai'];
        
    }else {
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $tenloai; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                $sql2 = "SELECT * FROM monan WHERE idloaimon=$idloaimon";
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    
                    while ($row2 = mysqli_fetch_assoc($res2) ) {
                        $idmonan = $row2['idmonan'];
                        $tenmon = $row2['tenmon'];
                        $gia = $row2['gia'];
                        $mota = $row2['mota'];
                        $image_monan = $row2['image_monan'];
                        ?>

                        <form action="" method="POST">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if ($image_monan =="") {
                                            echo "<div class='error'> Chưa thêm ảnh món ăn </div>";
                                        }else {
                                            ?>

                                                <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan;  ?>" alt="Chicke Hawain Pizza" class="img-custom img-curve">

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

                                    <a href="<?php echo SITEURL; ?>order.php?idmonan=<?php echo $idmonan; ?>" class="btn btn-search">đặt món</a>
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