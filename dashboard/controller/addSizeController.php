<?php
const _CODE = true;
    include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    
    if(isset($_POST['upload']))
    {
       
        $size = $_POST['size'];
       
         $insert = mysqli_query($conn,"INSERT INTO sizes
         (size_name)   VALUES ('$size')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
             header("Location: ../index.php?size=error");
         }
         else
         {
             echo "Records added successfully.";
             header("Location: ../index.php?size=success");
         }
     
    }
        
?>