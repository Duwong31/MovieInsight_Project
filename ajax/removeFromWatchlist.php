<?php

include('../admin/include/connect.php'); // Kết nối cơ sở dữ liệu

if (!isset($_SESSION['user_id']) || !isset($_GET['movie_id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$user_id = $_SESSION['user_id'];
$movie_id = $_GET['movie_id'];

// Xóa phim khỏi watchlist
$query = "DELETE FROM watchlist WHERE user_id = ? AND movie_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $user_id, $movie_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$con->close();
?>
