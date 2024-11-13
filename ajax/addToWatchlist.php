<?php
session_start();
include('../admin/include/connect.php'); // Kết nối cơ sở dữ liệu

// Bật hiển thị lỗi để kiểm tra 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Kiểm tra xem movie_id có được gửi tới không
if (!isset($_GET['movie_id'])) {
    echo json_encode(['success' => false, 'message' => 'Movie ID missing']);
    exit;
}
$user_id = $_SESSION['user_id'];
$movie_id = $_GET['movie_id'];

// Kiểm tra xem phim đã có trong watchlist chưa
$query = "SELECT * FROM watchlist WHERE user_id = ? AND movie_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $movie_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Phim đã có trong watchlist
    echo json_encode(['success' => false, 'message' => 'Movie already in watchlist']);
} else {
    // Thêm phim vào watchlist
    $query = "INSERT INTO watchlist (user_id, movie_id) VALUES (?, ?)";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $user_id, $movie_id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Movie added to watchlist']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add movie to watchlist']);
    }
}

$stmt->close();
$con->close();
?>
