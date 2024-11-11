<?php
    const _CODE = true;
    include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    
    if(isset($_POST['upload'])) {
        $ProductName = $_POST['p_name'];
        $desc = $_POST['p_desc'];
        $director = $_POST['p_director'];
        $genres = $_POST['genres'];
    
        $name = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        
        $location = "./uploads/";
        $image = $location . $name;
    
        $target_dir = "../uploads/";
        $finalImage = $target_dir . $name;
    
        if (move_uploaded_file($temp, $finalImage)) {
            $insert = mysqli_query($con, "INSERT INTO movies
                (movie_name, movie_image, movie_desc, genres_id, director) 
                VALUES ('$ProductName', '$image', '$desc', '$genres', '$director')");
    
            if(!$insert) {
                echo mysqli_error($con);
            } else {
                echo "Records added successfully.";
            }
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No file uploaded.";
    }
        
?>