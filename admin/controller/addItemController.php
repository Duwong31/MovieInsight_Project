<?php
const _CODE = true;
include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';


if (isset($_POST['upload'])) {
    $ProductName = mysqli_real_escape_string($con, $_POST['p_name']);
    $p_date = mysqli_real_escape_string($con, $_POST['p_date']);
    $p_duration = mysqli_real_escape_string($con, $_POST['p_duration']);
    $desc = mysqli_real_escape_string($con, $_POST['p_desc']);
    $director = mysqli_real_escape_string($con, $_POST['p_director']);
    $genres = mysqli_real_escape_string($con, $_POST['genres']);
    $p_actors = mysqli_real_escape_string($con, $_POST['p_actors']);
    $movie_type = mysqli_real_escape_string($con, $_POST['movie_type']);


    $name = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];

    $location = "./uploads/";
    $image = $location . $name;

    $target_dir = "../uploads/";
    $finalImage = $target_dir . $name;

    if (move_uploaded_file($temp, $finalImage)) {
        // Xử lý các tên diễn viên
        $actorNames = explode(",", $p_actors);  // Tách danh sách tên diễn viên
        $actorIds = [];  // Mảng lưu các actor_id

        foreach ($actorNames as $actorName) {
            $actorName = trim($actorName);  // Loại bỏ khoảng trắng trước và sau

            // Kiểm tra xem diễn viên đã có trong cơ sở dữ liệu chưa
            $actorQuery = "SELECT actors_id FROM actors WHERE actor_name = ?";
            $actorStmt = $con->prepare($actorQuery);
            $actorStmt->bind_param("s", $actorName);
            $actorStmt->execute();
            $actorResult = $actorStmt->get_result();

            if ($actorResult->num_rows == 0) {
                // Nếu chưa có, thêm diễn viên vào bảng actors
                $insertActorQuery = "INSERT INTO actors (actor_name) VALUES (?)";
                $insertActorStmt = $con->prepare($insertActorQuery);
                $insertActorStmt->bind_param("s", $actorName);
                $insertActorStmt->execute();

                $actor_id = $insertActorStmt->insert_id; // Lấy ID của diễn viên mới thêm
                $actorIds[] = $actor_id;
                $insertActorStmt->close();
            } else {
                // Nếu đã có, lấy actor_id
                $actorRow = $actorResult->fetch_assoc();
                $actor_id = $actorRow['actors_id'];
                $actorIds[] = $actor_id;
            }

            $actorStmt->close();
        }

        // Chuyển mảng actorIds thành chuỗi để lưu vào bảng movies
        $actorIdsString = implode(",", $actorIds);
        $insert = mysqli_query($con, "INSERT INTO movies
                (movie_name, movie_image, movie_desc, genres_id, director, release_date, duration, actors_id, movie_type) 
                VALUES ('$ProductName', '$image', '$desc', '$genres', '$director', '$p_date', '$p_duration', '$actorIdsString','$movie_type')");

        if (!$insert) {
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
