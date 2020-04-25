<?php

$servername = "remotemysql.com";
$username = "6BoPfxx1la";
$password = "V71kvlq0yy";
$dbname = "6BoPfxx1la";


$conn = new mysqli($servername, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo "Failed to established a connection: " . mysqli_connect_error();
        exit();
    }
?>