<?php
const _CODE = true;
    include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    $movie_id = mysqli_real_escape_string($con, $_POST['movie_id']);
    $p_name = mysqli_real_escape_string($con, $_POST['p_name']);
    $p_desc = mysqli_real_escape_string($con, $_POST['p_desc']);
    $p_director = mysqli_real_escape_string($con, $_POST['p_director']);
    $genres = mysqli_real_escape_string($con, $_POST['genres']);
    $dir = '../uploads/';

    if (isset($_FILES['newImage']) && $_FILES['newImage']['error'] == 0) {
        $img = $_FILES['newImage']['name'];
        $tmp = $_FILES['newImage']['tmp_name'];
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'webp');
        $image = rand(1000, 1000000) . "." . $ext;
        $final_image = $dir . $image;
        if (in_array($ext, $valid_extensions) && move_uploaded_file($tmp, $final_image)) {
            $location = './uploads/';
            $final_image = $location . $image;
        } else {
            echo "Error uploading the file.";
            exit;
        }
    } else {
        $final_image = $_POST['existingImage'];
    }

    $stmt = $con->prepare("UPDATE movies SET movie_name=?, movie_desc=?, director=?, genres_id=?, movie_image=? WHERE movie_id=?");
    $stmt->bind_param("sssisi", $p_name, $p_desc, $p_director, $genres, $final_image, $movie_id);

    echo $stmt->execute() ? "true" : "Error: " . $stmt->error;
    $stmt->close();
?>
