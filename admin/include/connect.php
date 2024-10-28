<!--kết nối database----------> 
//Hacked by TuanNguyen
<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "mydatabase"; 
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
?>
