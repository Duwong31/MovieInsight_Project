<?php
const _CODE = true;

include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    
    $id=$_POST['record'];
    $query="DELETE FROM sizes where size_id='$id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"Size Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>