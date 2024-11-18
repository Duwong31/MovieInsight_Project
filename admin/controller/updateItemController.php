<?php
const _CODE = true;
include_once '../include/connect.php';


$movie_id = mysqli_real_escape_string($con, $_POST['movie_id']);
$p_name = mysqli_real_escape_string($con, $_POST['p_name']);
$p_date = mysqli_real_escape_string($con, $_POST['p_date']);
$p_duration = mysqli_real_escape_string($con, $_POST['p_duration']);
$p_desc = mysqli_real_escape_string($con, $_POST['p_desc']);
$p_director = mysqli_real_escape_string($con, $_POST['p_director']);
$p_actors = mysqli_real_escape_string($con, $_POST['p_actors']);
$genres = mysqli_real_escape_string($con, $_POST['genres']);
// $movie_type = mysqli_real_escape_string($con, $_POST['movie_type']);
$dir = '../uploads/';

// Xử lý ảnh
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
    $final_image = $_POST['existingImage'];  // Nếu không có ảnh mới, dùng ảnh cũ
}

// Xử lý danh sách diễn viên
$actorNames = explode(",", $p_actors);  // Tách tên diễn viên từ chuỗi

$actorIds = [];  // Mảng lưu actor_id

foreach ($actorNames as $actorName) {
    $actorName = trim($actorName);  // Loại bỏ khoảng trắng

    // Kiểm tra xem diễn viên đã tồn tại chưa
    $actorQuery = "SELECT actors_id FROM actors WHERE actor_name = ?";
    $actorStmt = $con->prepare($actorQuery);
    $actorStmt->bind_param("s", $actorName);
    $actorStmt->execute();
    $actorResult = $actorStmt->get_result();

    if ($actorResult->num_rows == 0) {
        // Nếu diễn viên chưa tồn tại, thêm vào bảng actors
        $insertActorQuery = "INSERT INTO actors (actor_name) VALUES (?)";
        $insertActorStmt = $con->prepare($insertActorQuery);
        $insertActorStmt->bind_param("s", $actorName);
        $insertActorStmt->execute();
        $actor_id = $insertActorStmt->insert_id;  // Lấy actor_id của diễn viên vừa thêm
        $actorIds[] = $actor_id;  // Thêm vào mảng actorIds
        $insertActorStmt->close();
    } else {
        // Nếu diễn viên đã có, lấy actor_id
        $actorRow = $actorResult->fetch_assoc();
        $actorIds[] = $actorRow['actors_id'];  // Thêm vào mảng actorIds
    }

    $actorStmt->close();
}

// Chuyển mảng actorIds thành chuỗi để lưu vào bảng movies
$actorIdsString = implode(",", $actorIds);

// Cập nhật thông tin phim trong bảng movies
$stmt = $con->prepare("UPDATE movies SET movie_name=?, movie_desc=?, director=?, genres_id=?, movie_image=?, release_date=?, duration=?, actors_id=? WHERE movie_id=?");
$stmt->bind_param("sssissssi", $p_name, $p_desc, $p_director, $genres, $final_image, $p_date, $p_duration, $actorIdsString, $movie_id);

if ($stmt->execute()) {
    echo "true";  // Nếu cập nhật thành công
} else {
    echo "Error: " . $stmt->error;  // In lỗi nếu có
}

$stmt->close();
?>
