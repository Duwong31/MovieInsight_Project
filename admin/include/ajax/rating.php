<?php
// Kết nối tới cơ sở dữ liệu
include './admin/include/connect.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Bạn cần đăng nhập để đánh giá.']);
    exit;
}

// Lấy dữ liệu từ client
$data = json_decode(file_get_contents("php://input"), true);
$movie_id = $data['movie_id'];
$rating = $data['rating'];
$user_id = $_SESSION['user_id']; // Lấy user_id từ session
echo $user_id;

// Kiểm tra xem người dùng đã đánh giá bộ phim này chưa
$stmt = $con->prepare("SELECT * FROM ratings WHERE user_id = ? AND movie_id = ?");
$stmt->bind_param("ii", $user_id, $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Nếu người dùng đã đánh giá, cập nhật đánh giá
    $stmt = $con->prepare("UPDATE ratings SET rating = ?, created_at = NOW() WHERE user_id = ? AND movie_id = ?");
    $stmt->bind_param("dii", $rating, $user_id, $movie_id);
} else {
    // Nếu người dùng chưa đánh giá, thêm đánh giá mới
    $stmt = $con->prepare("INSERT INTO ratings (user_id, movie_id, rating, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iid", $user_id, $movie_id, $rating);
}
$stmt->execute();

// Tính lại điểm trung bình của bộ phim
$result = $con->query("SELECT COALESCE(AVG(rating), 0) AS average_rating FROM ratings WHERE movie_id = $movie_id");
$average_rating = $result->fetch_assoc()['average_rating'];

// Trả về điểm trung bình cập nhật
echo json_encode(['average_rating' => $average_rating]);
?>
