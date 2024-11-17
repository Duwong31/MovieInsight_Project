<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Insight</title>
    <link rel="stylesheet" href="./templates/css/styles.css">
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="./templates/fonts/Awesome/css/all.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css"> -->
    <link rel="stylesheet" href="./templates/css/swiper.css">
</head>

<body>
    <?php include('header.php'); ?>

    <!-- NEWS SECTION -->
    <section id="main-slider">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                // Fetch news from the database
                $result = $con->query("SELECT * FROM news ORDER BY created_at DESC");
                $news_array = [];
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $news_array[] = $row;
                    }
                }

                // Loop through the news to display them
                foreach ($news_array as $news) {
                ?>
                    <div class="swiper-slide">
                        <a href="<?php echo htmlspecialchars($news['source']); ?>">
                            <div class="main-slider-box">
                                <div class="main-slider-img">
                                    <img src="./admin/<?php echo htmlspecialchars($news['image_url']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                                </div>
                                <div class="main-slider-text">
                                    <div class="new-title">
                                        <strong><?php echo htmlspecialchars($news['title']); ?></strong>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>

    <div class="slider-btns">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <!-- MOVIES SECTION -->
    <section id="movie-section" class="movie">
        <h2 class="movie-category">Movies</h2>
        <button class="pre-btn">
            < </button>
                <button class="nxt-btn"> > </button>
                <div class="movie-container">
                    <?php
                    //Check login

                    $is_login = isLogin();
                    $loggedInUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                    ?>
                    <script>
                        // Truyền trạng thái đăng nhập từ PHP sang JavaScript
                        const isLoggedIn = <?php echo json_encode($is_login); ?>;
                        const loggedInUserId = <?php echo json_encode($loggedInUserId); ?>;
                    </script>
                    <?php
                    // Fetch movies from the database with user-specific rating
                    $query = "
SELECT m.*, 
       COALESCE(AVG(r.rating), 0) AS average_rating,
       (SELECT rating FROM ratings WHERE movie_id = m.movie_id AND user_id = ?) AS user_rating
FROM movies m
LEFT JOIN ratings r ON m.movie_id = r.movie_id
WHERE m.movie_type = 'isMovie'
GROUP BY m.movie_id";
                    $stmt = $con->prepare($query);
                    $stmt->bind_param("i", $loggedInUserId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $movies_array = [];
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $movies_array[] = $row;
                        }
                    }
                    $stmt->close();

                    // Loop through the movies to display them
                    foreach ($movies_array as $value) {
                        $userRating = $value['user_rating'];
                        $movie = $value['movie_id'];
                    ?>
                        <div class="movie-card">
                            <div class="movie-image">
                                <a href="?module=watchlist&action=movie_detail&movie_id=<?php echo $value['movie_id']; ?>">
                                    <img src="./admin/<?php echo htmlspecialchars($value['movie_image']); ?>" class="movie-thumb" alt="<?php echo htmlspecialchars($value['movie_name']); ?>">
                                </a>
                                <button class="addToWatchlist-btn" onclick="addToWatchlist(<?php echo $movie; ?>)">Add to watchlist</button>
                            </div>
                            <div class="movie-info">
                                <div class="movie-rating">
                                    <span class="rating-score">★ <?php echo number_format($value['average_rating'], 1); ?>/10</span>
                                    <span class="rate-button">
                                        <?php if ($userRating): ?>
                                            <a href="#" class="rate-link rated" data-movie-id="<?php echo $value['movie_id']; ?>">★ <?php echo round($userRating); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="rate-link" data-movie-id="<?php echo $value['movie_id']; ?>">☆ Rate</a>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <h4 class="movie-name"><?php echo htmlspecialchars($value['movie_name']); ?></h4>
                            </div>
                            <div data-movie-id="<?php echo $value['movie_id']; ?>" class="rating-form">
                                <p class="rating-form-name"><?php echo $value['movie_name']; ?></p>
                                <span class="close-btn" id="close-btn">X</span>
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <span class="star" data-value="<?php echo $i; ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                                <button class="remove-rating-btn" style="display: none;">Remove Rating</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

    </section>
    <!-- TV SHOWS SECTION -->
    <section id="tvshow-section" class="movie">
        <h2 class="movie-category">TV Shows</h2>
        <button class="pre-btn">
            < </button>
                <button class="nxt-btn"> > </button>
                <div class="movie-container">
                    <?php
                    // Fetch TV shows from the database
                    $query = "
SELECT tv.*, 
       COALESCE(AVG(r.rating), 0) AS average_rating,
       (SELECT rating FROM ratings WHERE movie_id = tv.movie_id AND user_id = ?) AS user_rating
FROM movies tv
LEFT JOIN ratings r ON tv.movie_id = r.movie_id
WHERE tv.movie_type = 'isTVShow'
GROUP BY tv.movie_id";

                    $stmt = $con->prepare($query);
                    $stmt->bind_param("i", $loggedInUserId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $tv_shows_array = [];
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            $tv_shows_array[] = $row;
                        }
                    }
                    $stmt->close();
                    foreach ($tv_shows_array as $value) {
                        $userRating = $value['user_rating'];
                        $tvShowId = $value['movie_id'];
                    ?>
                        <div class="movie-card">
                            <div class="movie-image">
                                <a href="?module=watchlist&action=movie_detail&movie_id=<?php echo $tvShowId; ?>">
                                    <img src="./admin/<?php echo htmlspecialchars($value['movie_image']); ?>" class="movie-thumb" alt="<?php echo htmlspecialchars($value['movie_name']); ?>">
                                </a>
                                <button class="addToWatchlist-btn" onclick="addToWatchlist(<?php echo $tvShowId; ?>)">Add to watchlist</button>
                            </div>
                            <div class="movie-info">
                                <div class="movie-rating">
                                    <span class="rating-score">★ <?php echo number_format($value['average_rating'], 1); ?>/10</span>
                                    <span class="rate-button">
                                        <?php if ($userRating): ?>
                                            <a href="#" class="rate-link rated" data-movie-id="<?php echo $value['movie_id']; ?>">★ <?php echo round($userRating); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="rate-link" data-movie-id="<?php echo $value['movie_id']; ?>">☆ Rate</a>
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <h4 class="movie-name"><?php echo htmlspecialchars($value['movie_name']); ?></h4>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>

    </section>
    <!-- CELEBRITIES SECTION -->
    <section id="celeb-section" class="movie">
        <h2 class="movie-category">Celebrities</h2>
        <button class="pre-btn">
            < </button>
                <button class="nxt-btn"> > </button>
                <div class="movie-container">
                    <?php
                    // Fetch actors from the database
                    $query = "SELECT * FROM actors LIMIT 10";
                    $result = $con->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($actor = $result->fetch_assoc()) {
                    ?>
                            <div class="movie-card">
                                <div class="celeb-image">
                                    <a href="?module=celebrities&action=celeb_detail&actor_id=<?php echo $actor['actors_id']; ?>">
                                        <img src="./admin/<?php echo htmlspecialchars($actor['actors_image']); ?>" class="movie-thumb" alt="<?php echo htmlspecialchars($actor['actor_name']); ?>">
                                    </a>
                                </div>
                                <div class="movie-info">
                                    <h4 class="celeb-name"><?php echo htmlspecialchars($actor['actor_name']); ?></h4>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No celebrities found.</p>";
                    }
                    ?>
                </div>

    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50
                },
            },
        });
    </script>
    <script src="./templates/js/script.js"></script>
    <script src="./templates/js/ajax.js"></script>
    <?php
    include('footer.php');
    ?>
</body>

</html>