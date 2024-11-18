<?php
// Lấy movie_id từ URL
if (isset($_GET['movie_id'])) {
    $movie_id = intval($_GET['movie_id']);

    // Truy vấn lấy thông tin phim từ bảng movies
    $sql = "SELECT m.*, 
       COALESCE(AVG(r.rating), 0) AS average_rating
FROM movies m
LEFT JOIN ratings r ON m.movie_id = r.movie_id
WHERE m.movie_id = $movie_id
GROUP BY m.movie_id";
    $result = $con->query($sql);

    // Kiểm tra nếu có dữ liệu trả về
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        echo "<p>Phim không tồn tại.</p>";
        exit;
    }
} else {
    echo "<p>Không tìm thấy ID phim.</p>";
    exit;
}
$is_login = isLogin();
$loggedInUserId = $_SESSION['user_id'] ?? null;

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($movie['movie_name']); ?></title>
    <link rel="stylesheet" href="./templates/css/styles.css">
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="./templates/fonts/Awesome/css/all.css" rel="stylesheet">

    <style>
        /* Định dạng container chính */
        .movie-detail-body {
            background-color: #1c1c1c;
            color: #ffffff;
            font-family: Arial, sans-serif;
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .movie-detail-container {
            width: 900px;
            padding: 20px;
        }

        /* Header chứa poster và thông tin phim */
        .movie-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .movie-info h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .release-year {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #b3b3b3;
        }

        .rating-section {
            width: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: nowrap;
        }

        .rating-section .rating,
        .rating-section .your-rating {
            text-align: center;
        }
        .rate-link{
            box-sizing: border-box;
            border: none;
            padding: 0 5px 2px;
            background-color: transparent;
            font-size: 1.2rem;
            cursor: pointer;
            color: rgb(87, 153, 239);
        }
        .rate-link:hover{
            background-color: #272626;
            border-radius: 12.8px;
        }
        .stars {
            font-size: 1.2rem;
            color: #ffd700;
        }

        .your-stars {
            font-size: 1.2rem;
            color: rgb(87, 153, 239);
        }

        /* Căn poster và trailer vào giữa */
        .movie-poster-trailer {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .movie-poster {
            width: 400px;
            height: 364px;
            border-radius: 8px;
        }

        .movie-trailer {
            width: 800px;
            height: 370px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Genres và nút Watchlist */
        .genres-watchlist {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .genres span {
            background-color: transparent;
            color: #ffffff;
            padding: 5px 10px;
            border: 1px solid white;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .watchlist-button {
            background-color: #e70634;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .watchlist-button:hover {
            background-color: #ce032c;
        }

        /* Mô tả phim */
        .movie-description {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #dcdcdc;
        }

        /* Đạo diễn và diễn viên */
        .movie-director,
        .movie-cast {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .movie-director h3,
        .movie-cast h3 {
            font-size: 1.5rem;
            margin-right: 10px;
        }

        .movie-director span,
        .movie-cast span {
            font-size: 14px;
            margin-left: 10px;
            margin-top: 5px;
            text-decoration: underline;
        }

        .movie-director span:hover,
        .movie-cast span:hover {
            cursor: pointer;
            color: red;
        }
    </style>
</head>

<body>
    <?php
    include(__DIR__ . '/../home/header.php');

    ?>
    <script>
        const isLoggedIn = <?php echo json_encode($is_login); ?>;
        const loggedInUserId = <?php echo json_encode($loggedInUserId); ?>;
    </script>
    <?php
    
    // Lấy đánh giá của người dùng (nếu đã đăng nhập)
    $user_rating = null;
    if ($is_login && $loggedInUserId) {
        $stmt = $con->prepare("SELECT rating FROM ratings WHERE movie_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $movie_id, $loggedInUserId);
        $stmt->execute();
        $stmt->bind_result($user_rating);
        $stmt->fetch();
        $stmt->close();
    }

    ?>
    <div class="movie-detail-body">
        <div class="movie-detail-container">
            <!-- Header với Poster và Thông tin phim -->
            <div class="movie-header">
                <div class="movie-info">
                    <h1><?php echo htmlspecialchars($movie['movie_name']); ?></h1>
                    <p class="release-year">
                        <?php
                        // Hiển thị ngày phát hành và thời lượng phim
                        echo htmlspecialchars($movie['release_date']) . " • " . htmlspecialchars($movie['duration']);
                        ?>
                    </p>
                </div>
                <div class="rating-section">
                    <div class="rating">
                        <div>MI Rating</div>
                        <div class="stars">★<?php echo number_format($movie['average_rating'], 1); ?>/10</div>
                    </div>
                    <div>
                        <!-- Your Rating -->
                        <div class="your-rating">
                            <div>Your Rating</div>
                            <button class="rate-link" data-movie-id="<?php echo $movie_id; ?>">
                                <?php echo $user_rating ? "★ " . round($user_rating) : "☆ Rate"; ?>
                            </button>
                        </div>

                        <!-- Rating Form (ẩn) -->
                        <div class="rating-form" data-movie-id="<?php echo $movie_id; ?>" style="display: none;">
                            <span class="close-btn">X</span>
                            <div class="stars">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <span class="star <?php echo $user_rating && $i <= $user_rating ? 'selected' : ''; ?>" data-value="<?php echo $i; ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <button class="remove-rating-btn" style="display: <?php echo $user_rating ? 'block' : 'none'; ?>;">Remove Rating</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Poster và Trailer -->
            <div class="movie-poster-trailer">
                <img src="./admin/<?php echo htmlspecialchars($movie['movie_image']); ?>" alt="<?php echo htmlspecialchars($movie['movie_name']); ?>" class="movie-poster">
                <iframe src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" title="Trailer" class="movie-trailer" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <!-- Thể loại -->
            <div class="genres-watchlist">
                <div class="genres">
                    <?php
                    // Hiển thị thể loại từ bảng genres
                    $genres_ids = explode(',', $movie['genres_id']); 
                    foreach ($genres_ids as $genre_id) {
                        // Truy vấn tên thể loại từ bảng genres
                        $genre_query = "SELECT genres_name FROM genres WHERE genres_id = $genre_id";
                        $genre_result = $con->query($genre_query);
                        if ($genre_result->num_rows > 0) {
                            $genre = $genre_result->fetch_assoc();
                            echo "<span>" . htmlspecialchars($genre['genres_name']) . "</span> ";
                        }
                    }
                    ?>
                </div>
                <button class="watchlist-button" onclick="addToWatchlist(<?php echo $movie_id; ?>)">Add to Watchlist</button>
            </div>

            <!-- Mô tả phim -->
            <p class="movie-description">
                <?php echo htmlspecialchars($movie['movie_desc']); ?>
                <hr width="100%" size="2px" align="center" color="gray">
                </hr>
            </p>

            <!-- Đạo diễn -->
            <div class="movie-director">
                <h3>Director</h3>
                <span><?php echo htmlspecialchars($movie['director']); ?></span>
            </div>
            <hr width="100%" size="2px" align="center" color="gray">
            </hr>

            <!-- Diễn viên -->
            <div class="movie-cast">
                <h3>Stars</h3>
                <?php
                $actors_ids = explode(',', $movie['actors_id']); // Lấy ID diễn viên từ movie
                foreach ($actors_ids as $actor_id) {
                    // Truy vấn tên diễn viên từ bảng actors
                    $actor_query = "SELECT actor_name FROM actors WHERE actors_id = $actor_id";
                    $actor_result = $con->query($actor_query);
                    if ($actor_result->num_rows > 0) {
                        $actor = $actor_result->fetch_assoc();
                        echo "<span>" . htmlspecialchars($actor['actor_name']) . "</span> ";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include(__DIR__ . '/../home/footer.php');
    ?>
    <script src="./templates/js/script.js"></script>
    <script src="./templates/js/ajax.js"></script>
</body>

</html>