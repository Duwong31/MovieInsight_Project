<?php
session_start();
if(!defined('_CODE')){
    die('Access denied...');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your watchlist</title>
    <link rel="stylesheet" href="./templates/css/styles.css">
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="./templates/fonts/Awesome/css/all.css" rel="stylesheet">
</head>
<body>
    <?php
    include(__DIR__ . '/../home/header.php');
    
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['user_id'])) {
        echo '<p>Please log in to view your watchlist.</p>';
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $query = "SELECT 
        movies.movie_id, 
        movies.movie_name, 
        movies.movie_image, 
        movies.movie_desc, 
        movies.release_date,
        IFNULL(AVG(ratings.rating), 0) AS average_rating
    FROM 
        watchlist
    JOIN 
        movies ON watchlist.movie_id = movies.movie_id
    LEFT JOIN 
        ratings ON movies.movie_id = ratings.movie_id
    WHERE 
        watchlist.user_id = ?
    GROUP BY 
        movies.movie_id";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Lưu dữ liệu vào mảng $movies_array
    $movies_array = [];
    while ($row = $result->fetch_assoc()) {
        $movies_array[] = $row;
    }

    $stmt->close();
    $con->close();
    ?>
    <div class="watchlist-container">
        <h1 class="watchlist-title">Your Watchlist</h1>
        <p class="watchlist-description">
            Your Watchlist is the place to track the titles you want to watch.</br>
            Add or remove items as you like.
        </p>

        <div class="watchlist-items">
            <?php
            if (!empty($movies_array)) {
                foreach ($movies_array as $movie) {
                    echo '
                    <div id="movie-' . htmlspecialchars($movie['movie_id']) . '" class="watchlist-item">
                        <div class="watchlist-movie-image">
                            <img src="./admin/' . htmlspecialchars($movie['movie_image']) . '" alt="' . htmlspecialchars($movie['movie_name']) . '">
                        </div>
                        <div class="watch-movie-info">
                            <h2>' . htmlspecialchars($movie['movie_name']) . '</h2>
                            <p>' . htmlspecialchars($movie['movie_desc']) . '</p>
                            <div class="movie-meta">
                                <span>⭐ ' . number_format($movie['average_rating'], 1) . '/10</span>
                                <span> ' . htmlspecialchars($movie['release_date']) . '</span>
                            </div>
                            <button class="remove-button" onclick="removeFromWatchlist(' . $movie['movie_id'] . ')"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<p>Your watchlist is empty.</p>';
            }
            ?>
        </div>

    </div>
    <script src="./templates/js/script.js"></script>
    <script src="./templates/js/ajax.js"></script>
</body>
</html>
