<?php include('partials-front/menu.php'); ?>


    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-search">
            </form>

        </div>
    </section>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Các loại món</h2>

            <?php 

                // tạo câu truy vấn tất cả các loại món
                $sql = "SELECT * FROM loaimon WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                //kiểm tra xem các loại món đã có sẳn chưa
                if ($count > 0) {
                    
                    while ($row = mysqli_fetch_assoc($res)) {
                        //lấy giá trị
                        $id = $row['idloaimon'];
                        $tenloai = $row['tenloai'];
                        $image = $row['image'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?idloaimon=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                        <?php
                                            if ($image =="") {
                                                echo "<div class='error'> Chưa thêm hình ảnh cho loại món này </div>";
                                            }else {

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
                    
                }else {
                    echo "<div class='error'> không tìm thấy loại món ăn! </div>";
                }
                
            
            ?>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>