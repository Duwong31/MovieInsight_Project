<?php
    const _CODE = true;
    include_once '../include/connect.php';


    
    $p_id=$_POST['record'];
    $query="DELETE FROM movies where movie_id='$p_id'";

    $data=mysqli_query($con,$query);

    if($data){
        echo"Movies Item Deleted";
    }
    else{
        echo"Not able to delete";
    }
    
?>