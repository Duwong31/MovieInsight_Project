<?php
include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

if (isset($_GET['query'])) {
    $query = mysqli_real_escape_string($con, $_GET['query']);
    $sql = "SELECT movie_id, movie_name, release_date, movie_image FROM movies 
            WHERE movie_name LIKE ? LIMIT 10";
    $stmt = $con->prepare($sql);
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $movies = [];
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }

    echo json_encode($movies);
    exit();
}
?>