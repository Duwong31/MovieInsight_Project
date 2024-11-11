
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Insight</title>
    <link rel="stylesheet" href="/MovieInsightProject/admin/templates/css/styles.css">
    <link rel="shortcut icon" href="/MovieInsightProject/admin/templates/img/icons8-movie-30.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="admin/templates/fonts/Awesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">
            <img src="/MovieInsightProject/admin/templates/img/icons8-movie-30.png" alt="Movie Insight Logo">
            <p>Movies<br>Insight</p>
        </a>
        <nav class="navigation">
            <input type="checkbox" class="menu-btn" id="menu-btn">
            <label for="menu-btn" class="menu-icon">
                <span class="nav-icon"></span>
            </label>
            <a class="menu-tag">Menu</a>
            <ul class="menu">
                <li><a href="#">Movies</a></li>
                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Celebs</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Awards & Events</a></li>
            </ul>
            <form action="" class="search-box">
                <div class="search-container">
                    <img src="/MovieInsightProject/admin/templates/img/search.png" class="search-icon" alt="Search Icon">
                    <input type="text" name="search" class="search-input" placeholder="Search Movie Insight" id="searchInput">
                    <img src="/MovieInsightProject/admin/templates/img/cross.png" class="clear-icon" id="clearIcon" alt="Clear Icon">
                </div>
            </form>
            <button id="watchlist-btn"><i class="fa-solid fa-plus"></i>Watchlist</button>
            <button id="news-btn">News</button>
            <!-- Conditional Login/Logout Elements -->
            <?php if (isLogin()): ?>
                
                <!-- Profile Dropdown -->
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="User Profile" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                        <li><a class="dropdown-item" href="#">Thông tin người dùng</a></li>
                        <li><a class="dropdown-item" href="#">Trợ giúp</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="?module=auth&action=logoutUser">Đăng xuất</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <!-- Login and Sign Up Buttons -->
                <button id="login-btn">Login</button>
                <button id="sign-up-btn">Sign up</button>
            <?php endif; ?>
        </nav>
    </header>

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
                                    <img src="./dashboard/<?php echo $value['movie_image']; ?>" alt="<?php echo $value['movie_name']; ?>">
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
        // Fetch movies from the database
        $result = $con->query("SELECT m.*, COALESCE(AVG(r.rating), 0) AS average_rating
        FROM movies m
        LEFT JOIN ratings r ON m.movie_id = r.movie_id
        GROUP BY m.movie_id");
        $movies_array = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $movies_array[] = $row;
            }
        }

        // Loop through the movies to display them
        foreach ($movies_array as $value) {
            ?>
       <div class="movie-card">
                <div class="movie-image">
                    <img src="<?php echo htmlspecialchars($value['movie_image']); ?>" class="movie-thumb" alt="<?php echo htmlspecialchars($value['movie_name']); ?>">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name"><?php echo htmlspecialchars($value['movie_name']); ?></h2>
                    <div class="movie-rating">
                        <span class="rating-score">★ <?php echo number_format($value['average_rating'], 1); ?>/10</span>
                        <span class="rate-button"><a href="#" class="rate-link" data-movie-id="<?php echo $value['movie_id']; ?>">☆ Rate</a></span>
                    </div>
                </div>
                <div data-movie-id="<?php echo $value['movie_id']; ?>" class="rating-form"> 
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
    <script src="/MovieInsightProject/admin/templates/js/script.js"></script>
</body>
</html>
