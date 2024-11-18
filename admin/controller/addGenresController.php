<?php
    const _CODE = true;
    include_once '../include/connect.php';


    
    if(isset($_POST['upload']))
    {
       
        $genname = $_POST['c_name'];
       
         $insert = mysqli_query($con,"INSERT INTO genres
         (genres_name) 
         VALUES ('$genname')");
 
         if(!$insert)
         {
             echo mysqli_error($con);
             header("Location: ../admin.php?genres=error");
         }
         else
         {
             echo "Records added successfully.";
             header("Location: ../admin.php?category=success");
         }
     
    }
        
?>