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
    <div class="movie-detail-container">
        <!-- Header với Poster và Thông tin phim -->
        <div class="movie-header">
            <div class="movie-info">
                <h1>Gladiator II</h1>
                <p class="release-year">2024 • 2h 28m</p>
            </div>
            <div class="rating-section">
                <span class="rating">
                    <span>MI Rating</span>
                    <div class="stars">⭐ 7.0/10</div>
                </span>
                <span class="user-rating">
                    <span>Your Rating</span>
                    <div class="stars">⭐ 8/10</div>
                </span>
            </div>
        </div>

        <!-- Poster và Trailer -->
        <div class="movie-poster-trailer">
            <img src="./admin/uploads/986527.jpg" alt="Gladiator II" class="movie-poster">
            <iframe src="https://www.youtube.com/embed/4rgYUipGJNo" title="Gladiator II | Official Trailer (2024 Movie) - Paul Mescal, Pedro Pascal, Denzel Washington" class="movie-trailer" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <!-- Thể loại và nút Watchlist -->
        <div class="genres-watchlist">
            <div class="genres">
                <span>Action Epic</span>
                <span>Adventure</span>
                <span>Drama</span>
            </div>
            <button class="watchlist-button">In Watchlist</button>
        </div>

        <!-- Mô tả phim -->
        <p class="movie-description">
            After his home is conquered by the tyrannical emperors who now lead Rome, Lucius is forced to enter the Colosseum and must look to his past to find strength to return the glory of Rome to its people.
        </p>

        <!-- Đạo diễn -->
        <div class="movie-director">
            <h3>Director</h3>
            <span>Ridley Scott</span>
        </div>

        <!-- Diễn viên -->
        <div class="movie-cast">
            <h3>Stars</h3>
            <span>Connie Nielsen</span>
            <span>Paul Mescal</span>
            <span>Pedro Pascal</span>
        </div>
    </div>
</body>

</html>
