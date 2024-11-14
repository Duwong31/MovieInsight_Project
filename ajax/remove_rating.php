<?php
session_start();
include('../admin/include/connect.php');

$data = json_decode(file_get_contents('php://input'), true);
$movie_id = $data['movie_id'];
$user_id = $data['user_id'];

$response = ['success' => false];

if ($movie_id && $user_id) {
    $query = "DELETE FROM ratings WHERE movie_id = ? AND user_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $movie_id, $user_id);

    if ($stmt->execute()) {
        $stmt->close();

        // Cập nhật lại đánh giá trung bình
        $avgQuery = "SELECT COALESCE(AVG(rating), 0) AS new_average_rating FROM ratings WHERE movie_id = ?";
        $avgStmt = $con->prepare($avgQuery);
        $avgStmt->bind_param("i", $movie_id);
        $avgStmt->execute();
        $avgResult = $avgStmt->get_result();
        $avgRow = $avgResult->fetch_assoc();
        $new_average_rating = $avgRow['new_average_rating'];
        $avgStmt->close();

        $response = [
            'success' => true,
            'new_average_rating' => number_format($new_average_rating, 1)
        ];
    } else {
        $response['error'] = "Could not remove rating.";
    }
} else {
    $response['error'] = "Invalid request data.";
}

echo json_encode($response);
?>
