<?php
    include('config/constants.php');

    unset($_SESSION['userlogin']);
    header('location:'.SITEURL);
?>