<?php
    $server = 'localhost';
    $super = 'root';
    $pass = '';
    $database = '';


    $conn = new mysqli($server, $user, $pass, $database);
    if($conn){
        mysqli_query($conn, "SET NAMES 'utf8' ");
    }else{
        echo 'false';
    }
?>