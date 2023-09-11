<?php
//start session
session_start();

//create constants
    define('SITEURL','http://localhost/food-order/');//this is siturl

        define('HOSTNAME','localhost');
        define('DB_USERNAME','root');
        define('DB_PASSWORD','');
        define('DB_NAME','food_order');

    $conn=mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD);
    $db_select=mysqli_select_db($conn,DB_NAME);
?>