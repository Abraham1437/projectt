<?php
    //Start Section
    session_start();




    //Create Constant to store Non Repeating Values
    define('SITEURL','http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);//Database Connection
    $db_select = mysqli_select_db($conn,DB_NAME);//Selecting database

?>