<?php
header('Content-Type: application/json');

$response = array('success' => false);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $movie_id = $data['movie_id'];
    $rating = $data['rating'];
    $user_id = $data['user_id'];

    // Database connection
    include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

    // Check if the user has already rated this movie
    $checkStmt = $con->prepare("SELECT rating_id FROM ratings WHERE movie_id = ? AND user_id = ?");
    $checkStmt->bind_param("ii", $movie_id, $user_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Update existing rating
        $stmt = $con->prepare("UPDATE ratings SET rating = ? WHERE movie_id = ? AND user_id = ?");
        $stmt->bind_param("iii", $rating, $movie_id, $user_id);
    } else {
        // Insert new rating
        $stmt = $con->prepare("INSERT INTO ratings (movie_id, rating, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $movie_id, $rating, $user_id);
    }

    if ($stmt->execute()) {
        // Calculate the new average rating
        $result = $con->query("SELECT AVG(rating) AS average_rating FROM ratings WHERE movie_id = $movie_id");
        $row = $result->fetch_assoc();
        $new_average_rating = $row['average_rating'];

        $response['success'] = true;
        $response['new_average_rating'] = $new_average_rating;
    } else {
        $response['error'] = 'Error submitting rating.';
    }

    $stmt->close();
    $checkStmt->close();
} else {
    $response['error'] = 'Invalid request method.';
}

echo json_encode($response);
?>
