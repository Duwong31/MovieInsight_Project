<!--kết nối database----------> 
<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "laptrinhweb"; 
    
    $con = mysqli_connect($servername, $username, $password, $dbname);
    
    
    if (!$con) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
?>
