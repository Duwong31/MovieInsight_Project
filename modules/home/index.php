
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css">
</head>
<body>  
    <?php include('header.php'); ?>
    

    <section id="main-slider">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                // Fetch movies from the database
                $result = $con->query("SELECT * FROM movies");
                $movies_array = [];
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $movies_array[] = $row;
                    }
                }

                // Loop through the movies to display them
                foreach ($movies_array as $value) {
                    ?>
                    <div class="swiper-slide">
                        <div class="main-slider-box">
                            <div class="main-slider-img">
                                <form action="" method="post">
                                    <img src="./admin/<?php echo $value['movie_image']; ?>" alt="<?php echo $value['movie_name']; ?>">
                                </form>
                            </div>
                            <div class="main-slider-text">
                                <div class="movie-name">
                                    <span>2024</span>
                                    <strong><?php echo $value['movie_name']; ?></strong>
                                    <p><?php echo $value['movie_desc']; ?></p>
                                </div>
                            </div>
                        </div>
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

    <section class="movie"> 
    <h2 class="movie-category">Movies</h2>
    <button class="pre-btn"> < </button>
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
            ?>
       <div class="movie-card">
                <div class="movie-image">
                    <img src="./admin/<?php echo htmlspecialchars($value['movie_image']); ?>" class="movie-thumb" alt="<?php echo htmlspecialchars($value['movie_name']); ?>">
                    <button class="card-btn">Add to watchlist</button>  
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
                    <p class = "rating-form-name"><?php echo $value['movie_name']; ?></p>
                    <span class="close-btn" id="close-btn">X</span>  
                    <div class="stars"> 
                        <?php for ($i = 1; $i <= 10; $i++): ?> 
                            <span class="star" data-value="<?php echo $i; ?>">☆</span> 
                        <?php endfor; ?> 
                    </div> 
                </div> 
            </div>
        <?php
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
            640: { slidesPerView: 2, spaceBetween: 20 },
            768: { slidesPerView: 2, spaceBetween: 30 },
            1024: { slidesPerView: 3, spaceBetween: 50 },
          },
        });
    </script>
    <script src="./templates/js/script.js"></script>
    <?php
    include('footer.php');
    ?>
</body>
</html>
