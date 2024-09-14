<?php
//start session
session_start();


// Định nghĩa các hằng số kết nối
define('SITEURL', 'http://localhost:8080/Order-food/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('PASSWORD','');
define('DBNAME', 'order_food');
define('PORT', 3366);

// Kết nối cơ sở dữ liệu
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, PASSWORD, DBNAME, PORT);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Chọn cơ sở dữ liệu
$db_select = mysqli_select_db($conn, DBNAME);

// Kiểm tra chọn cơ sở dữ liệu
if (!$db_select) {
    die("Không thể chọn cơ sở dữ liệu: " . mysqli_error($conn));
}
    
function currency_format($number, $subfixx) {
    if (!empty($number)) {
        return number_format($number, 0 , ',','.'). " {$subfixx}";
    }
}
?>