<?php
    $host="localhost";
    $username= "root";
    $password="";
    $database="atshop_db";

    $conn=mysqli_connect($host, $username, $password, $database);

    //check database
    if(!$conn)
    {
        die("Connection Faild ". mysqli_connect_errno());
        echo "Something Wrong";
    }
?>