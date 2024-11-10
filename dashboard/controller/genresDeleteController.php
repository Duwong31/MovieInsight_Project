<?php
const _CODE = true;
include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    
    $c_id=$_POST['record'];
    $query="DELETE FROM genres where genres_id='$c_id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"Genres Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>