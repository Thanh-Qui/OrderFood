<?php
include('partials-front/menu.php');
include("add-cart.php");
ob_start();
?>

<!-- fOOD sEARCH Section Starts Here -->
<!-- <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-search">
            </form>

        </div>
    </section> -->
<!-- fOOD sEARCH Section Ends Here -->

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

if (isset($_SESSION['loginUser'])) {
    // echo $_SESSION['loginUser'];
    unset($_SESSION['loginUser']);
}

if (isset($_SESSION['add-cart'])) {
    echo $_SESSION['add-cart'];
    unset($_SESSION['add-cart']);
}

?>

<section class="hero">

    <div class="swiper hero-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="content">
                    <h3>Pizza</h3>
                    <a href="categories.php" class="btn">see menus</a>

                    <div class="container" style="margin-top: 30px;">

                        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                            <input class="form-control" style="width: 80%; background-color: #f5f6fa;" type="search" name="search" placeholder="Search for Food.." required>
                            <input class="btn btn-search" type="submit" name="submit" value="Search">
                        </form>

                    </div>

                </div>

                <div class="image">
                    <img src="img/pizza1.png" alt="" style="width: 600px; height: 600px">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <h3>Spaghetti</h3>
                    <a href="categories.php" class="btn">see menus</a>

                    <div class="container" style="margin-top: 30px;">

                        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                            <input class="form-control" style="width: 80%; background-color: #f5f6fa;" type="search" name="search" placeholder="Search for Food.." required>
                            <input class="btn btn-search" type="submit" name="submit" value="Search">
                        </form>

                    </div>

                </div>
                <div class="image">
                    <img src="img/spaghetti.png" alt="" style="width: 600px; height: 600px">
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="content">
                    <h3>Burger</h3>
                    <a href="categories.php" class="btn">see menus</a>

                    <div class="container" style="margin-top: 30px;">

                        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                            <input class="form-control" style="width: 80%; background-color: #f5f6fa;" type="search" name="search" placeholder="Search for Food.." required>
                            <input class="btn btn-search" type="submit" name="submit" value="Search">
                        </form>

                    </div>

                </div>
                <div class="image">
                    <img src="img/burger2" alt="" style="width: 600px; height: 600px">
                </div>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Các loại món ăn</h2>

        <?php
        //tạo câu truy vấn 
        $sql = "SELECT * from loaimon WHERE active ='Yes' AND dactrung='Yes' LIMIT 3";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['idloaimon'];
                $tenloai = $row['tenloai'];
                $image = $row['image'];
        ?>

                <a href="<?php echo SITEURL; ?>category-foods.php?idloaimon=<?php echo $id; ?>">
                    <div class="box-3 float-container">
                        <?php
                        //kiểm tra liệu hình ảnh có sẳn hay không
                        if ($image == "") {
                            echo "<div class='error'> không có hình ảnh về loại món này! </div>";
                        } else {

                        ?>
                            <img src="<?php echo SITEURL; ?>images/loaimon/<?php echo $image; ?>" alt="Pizza" class="img-responsive img-curve">
                        <?php

                        }
                        ?>


                        <h3 class="float-text text-white"><?php echo $tenloai; ?></h3>
                    </div>
                </a>

        <?php
            }
        } else {
            echo "<div class='error'> Chưa có loại món nào được thêm vào! </div>";
        }

        ?>


        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a style="color: #ff9f1a;" href="<?php echo SITEURL; ?>categories.php">Hiển thị loại món ăn</a>
    </p>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Thực đơn các món ăn</h2>

        <?php
        $sql2 = "SELECT * FROM monan WHERE active='Yes' AND dactrung='Yes'";
        $res2 = mysqli_query($conn, $sql2);

        $count2 = mysqli_num_rows($res2);
        if ($count2 > 0) {

            while ($row2 = mysqli_fetch_assoc($res2)) {
                //lấy giá trị
                $id = $row2['idmonan'];
                $tenmon = $row2['tenmon'];
                $mota = $row2['mota'];
                $gia = $row2['gia'];
                $image_monan = $row2['image_monan'];
        ?>

                <form action="" method="POST">
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($image_monan == "") {
                                echo "<div class='error'> Chưa thêm ảnh cho món ăn này </div>";
                            } else {

                            ?>
                                <img src="<?php echo SITEURL; ?>images/monan/<?php echo $image_monan; ?>" alt="Chicke Hawain Pizza" class="img-curve img-custom">
                            <?php

                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <?php if (!isset($_SESSION['userlogin'])) {
                            } else {
                            ?>
                                <button type="submit" class="fa-solid fa-circle-plus right" name="add-cart"></button>


                            <?php
                            }
                            ?>
                            <h4><?php echo $tenmon; ?></h4>
                            <p class="food-price"><?php echo currency_format($gia, 'VND'); ?></p>
                            <p class="food-detail"><?php echo $mota; ?></p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?idmonan=<?php echo $id; ?>" class="btn btn-search">đặt món</a>

                            <?php
                            if (isset($_SESSION['userlogin'])) {
                            ?>
                                <!-- Star Rating System -->
                                <div class="rating">
                                    <input type="radio" name="star" id="star5-<?= $id; ?>" value="5">
                                    <label for="star5-<?= $id; ?>" class="fa fa-star"></label>

                                    <input type="radio" name="star" id="star4-<?= $id; ?>" value="4">
                                    <label for="star4-<?= $id; ?>" class="fa fa-star"></label>

                                    <input type="radio" name="star" id="star3-<?= $id; ?>" value="3">
                                    <label for="star3-<?= $id; ?>" class="fa fa-star"></label>

                                    <input type="radio" name="star" id="star2-<?= $id; ?>" value="2">
                                    <label for="star2-<?= $id; ?>" class="fa fa-star"></label>

                                    <input type="radio" name="star" id="star1-<?= $id; ?>" value="1">
                                    <label for="star1-<?= $id; ?>" class="fa fa-star"></label>

                                </div>
                            <?php
                            }
                            ?>


                            <input type="hidden" name="gia" id="" value="<?php echo $gia; ?>">
                            <input type="hidden" name="tenmon" value="<?php echo $tenmon; ?>">
                            <input type="hidden" name="iduser" id="" value="<?php echo $iduser; ?>">
                            <input type="hidden" name="idmonan" value="<?= $id; ?>">
                        </div>
                    </div>
                </form>


        <?php
            }
        } else {
            echo "<div class='error'> không tìm thấy món ăn! </div>";
        }
        ?>


        <div class="clearfix"></div>

    </div>

    <p class="text-center">
        <a style="color: #ff9f1a;" href="<?php echo SITEURL; ?>foods.php">Hiển thị tất cả món ăn</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script>
    var swiper = new Swiper(".hero-slider", {
        loop: true,
        grabCursor: true,
        effect: "flip",
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

<?php include('partials-front/footer.php');
ob_end_flush(); ?>