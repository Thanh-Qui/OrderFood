<?php
    // if (isset($_SESSION['userlogin'])) {
    //     $username = $_SESSION['userlogin'];

    //     $sql1 = "SELECT * FROM users WHERE username='".mysqli_real_escape_string($conn, $username)."'";
    //     $res1 = mysqli_query($conn, $sql1);
        
    //     $row = mysqli_fetch_assoc($res1);
    //     $iduser = $row['iduser'];
    // }

    if (isset($_POST['add-cart'])) {
        $iduser = $_POST['iduser'];
        $tenmon = mysqli_real_escape_string($conn, $_POST['tenmon']);
        $soluong = 1;
        $gia = mysqli_real_escape_string($conn, $_POST['gia']);
        
       
       $sql2 = "INSERT INTO cart SET
            iduser = '".mysqli_real_escape_string($conn, $iduser)."',
            tenmon = '$tenmon',
            soluong = $soluong,
            gia = '$gia';
            
       ";
       $res2 = mysqli_query($conn, $sql2);

       if ($res2 == true) {
        $_SESSION['add-cart'] = "<div class='success'> Thêm món ăn thành công! </div>";
        header('location:'.SITEURL);
       }else {
        $_SESSION['add-cart'] = "<div class='error'> Thêm món ăn không thành công! </div>";
        header('location:'.SITEURL);
       }

       exit();
    }

    
?>