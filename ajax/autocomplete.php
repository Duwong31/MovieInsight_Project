<?php
    /* Xử lý từ khóa gợi ý tiềm kiếm */
include '../admin/include/connect.php';

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];
    $stmt = $conn->prepare("SELECT movie_name FROM movies WHERE movie_name LIKE ? LIMIT 5");
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['movie_name'];
    }

    echo json_encode($suggestions);
}
?>
