<?php

session_start();
require_once('config.php');

echo _CODE;

$module = _MODULE;
$action = _ACTION;

if(!empty($_GET['module'])){
    if(is_string($_GET['module'])){
        $module = trim($_GET['module']);
    }
}

if(!empty($_GET['action'])){
    if(is_string($_GET['action'])){
        $action = trim($_GET['action']);
    }
}


$path = 'modules/'. $module. '/' . $action . '.php';

if(file_exists($path)){
    require_once($path);
}else{
    require_once('modules/error/404.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies Insight</title>
    <link rel="stylesheet" href="templates/css/styles.css">
    <link rel="shorcut icon" href="templates/img/icons8-movie-30.png">
    <!--font-poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="templates/fonts/Awesome/css/all.css" rel="stylesheet" >
    <!--CSS SWIPPER-------------------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.css">
</head>
<body>
    <!--logo---------------------------------------------->
    <header>
        
        <a href="index.php" class="logo">
            <img src="templates/img/icons8-movie-30.png">
            <p>Movies<br>Insight</p>
        </a>
        <!--Nav-------------------------->  
        <nav class="navigation">

            <!--menu-button--------------------------------------->
            <input type="checkbox" class="menu-btn" id="menu-btn">
            <label for="menu-btn" class="menu-icon">
                <span class="nav-icon"></span>
            </label>
            
            <a class="menu-tag">Menu</a>

            <!--menu---------------------------------------------->
            <ul class="menu">
                <li><a href="#">Movies</a></li>
                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Celebs</a></li>
                <li><a href="#">Commmunity</a></li>
                <li><a href="#">Awards & Events</a></li>
            </ul>

            <!--search box-->
            <form action="" class="search-box">

                <!--input-->
                <div class="search-container">
                    <img src="templates/img/search.png" class="search-icon">
                    <input type="text" name="search" class="search-input" placeholder="Search Movie Insight" id="searchInput">
                    <img src="templates/img/cross.png" class="clear-icon" id="clearIcon"></i>
                </div>
            </form>

            <!--News----------------------------------->
            <button id="news-btn">News</button>

            <!--sign in button------------------------->
            <button id="login-btn">Login</button>

            <!--sign up button------------------------->
            <button id="sign-up-btn">Sign up</button>
        </nav>
    </header>
    <section id="main-slider">
     <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                        
                        <!--img--------------------------------->
                        <!--1---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                    
                        <!--img--------------------------------->
                        <!--2---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                    
                        <!--img--------------------------------->
                        <!--3---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                    
                        <!--img--------------------------------->
                        <!--4---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                    
                        <!--img--------------------------------->
                        <!--5---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <!--box------------------------------------->
                    <div class="main-slider-box">
                    
                        <!--img--------------------------------->
                        <!--6---------------------------------------------->
                        <div class="main-slider-img">
                            <img src="templates/img/venom3.jpg" alt="Poster Venom3">
                        </div>
                        <div class="main-slider-text">

                            <!--bottom text-------------------------->
                            <div class="movie-name">
                                <span>2024</span>
                                <strong>Venom: The Last Dance</strong>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
        
    </section>

    <!--buttons------------------------------------------------------->
    <div class="slider-btns">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <!--names Section------------------------------------------------>
    <section class="movie"> 
        <h2 class="movie-category">Movies</h2>
        <button class="pre-btn"> < </button>
        <button class="nxt-btn"> > </button>
        <div class="movie-container">
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
            <div class="movie-card">
                <div class="movie-image">
                    
                    <img src="templates/img/substande.jpg" class="movie-thumb" alt="">
                    <button class="card-btn">Add to watchlist</button>
                </div>
                <div class="movie-info">
                    <h2 class="movie-name">movie name</h2>
                    <p class="movie-short-description">a short line about the movie</p>
                    <span class="price">star</span><span class="actual-price">star</span>
                </div>
            </div>
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
              spaceBetween: 20,
            },
            768: {
              slidesPerView: 2,
              spaceBetween: 30,
            },
            1024: {
              slidesPerView: 3,
              spaceBetween: 50,
            },
          },
        });
      </script>
      
    <script src="templates/js/script.js"></script>
</body>
</html>