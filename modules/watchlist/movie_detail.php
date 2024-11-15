<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phim - Gladiator II</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Định dạng container chính */
        body {
            background-color: #1c1c1c;
            color: #ffffff;
            font-family: Arial, sans-serif;
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
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .stars {
            font-size: 1.2rem;
            color: #ffd700;
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
            background-color: #333;
            color: #b3b3b3;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .watchlist-button {
            background-color: #ffcc00;
            color: #000;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
        }

        /* Mô tả phim */
        .movie-description {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #dcdcdc;
        }

        /* Đạo diễn và diễn viên */
        .movie-director,
        .movie-cast {
            margin-bottom: 20px;
        }

        .movie-director h3,
        .movie-cast h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    // Lấy movie_id từ URL
    if (isset($_GET['movie_id'])) {
        $movie_id = intval($_GET['movie_id']);

        // Truy vấn lấy thông tin phim từ bảng movies
        $sql = "SELECT * FROM movies WHERE movie_id = $movie_id";
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
    ?>
    <div class="movie-detail-container">
        <!-- Header với Poster và Thông tin phim -->
        <div class="movie-header">
            <div class="movie-info">
                <h1><?php echo htmlspecialchars($movie['movie_name']); ?></h1>
                <p class="release-year">
                    <?php echo htmlspecialchars($movie['release_date']) . " • " . htmlspecialchars($movie['duration']); ?>
                </p>
            </div>
            <div class="rating-section">
                <span class="rating">
                    <span>MI Rating</span>
                    <div class="stars">⭐/10</div>
                </span>
                <!-- Có thể thêm đánh giá của người dùng ở đây nếu cần -->
            </div>
        </div>

        <!-- Poster và Trailer -->
        <div class="movie-poster-trailer">
            <img src="./admin/<?php echo htmlspecialchars($movie['movie_image']); ?>" alt="<?php echo htmlspecialchars($movie['movie_name']); ?>" class="movie-poster">
            <iframe src="<?php echo htmlspecialchars($movie['trailer_url']); ?>" title="Trailer" class="movie-trailer" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <!-- Thể loại và nút Watchlist -->
        <div class="genres-watchlist">
            <div class="genres">
                <?php
                // Hiển thị thể loại từ bảng genres hoặc cột genres_id nếu đã có join với bảng genres
                $genres = explode(',', $movie['genres_id']);
                foreach ($genres as $genre) {
                    echo "<span>" . htmlspecialchars($genre) . "</span> ";
                }
                ?>
            </div>
            <button class="watchlist-button">In Watchlist</button>
        </div>

        <!-- Mô tả phim -->
        <p class="movie-description">
            <?php echo htmlspecialchars($movie['movie_desc']); ?>
        </p>

        <!-- Đạo diễn -->
        <div class="movie-director">
            <h3>Director</h3>
            <span><?php echo htmlspecialchars($movie['director']); ?></span>
        </div>

        <!-- Diễn viên -->
        <div class="movie-cast">
            <h3>Stars</h3>
            <?php
            $actors = explode(',', $movie['actors_id']); 
            foreach ($actors as $actor) {
                echo "<span>" . htmlspecialchars($actor) . "</span> ";
            }
            ?>
        </div>
    </div>
</body>

</html>
