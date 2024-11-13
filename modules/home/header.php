<header>
    <a href="index.php" class="logo">
        <img src="./templates/img/icons8-movie-30.png" alt="Movie Insight Logo">
        <p>Movies<br>Insight</p>
    </a>
    <nav class="navigation">
        <input type="checkbox" class="menu-btn" id="menu-btn">
        <label for="menu-btn" class="menu-icon">
            <span class="nav-icon"></span>
        </label>
        <a class="menu-tag">Menu</a>
        <ul class="menu">
            <li><a href="#movie-section">Movies</a></li>
            <li><a href="#tvshow-section">TV Shows</a></li>
            <li><a href="#celeb-section">Celebs</a></li>
            <li><a href="#">Community</a></li>
            <li><a href="#">Awards & Events</a></li>
        </ul>
        <form action="" class="search-box">
            <div class="search-container">
                <img src="./templates/img/search.png" class="search-icon" alt="Search Icon">
                <input type="text" name="search" class="search-input" placeholder="Search Movie Insight" id="searchInput">
                <img src="./templates/img/cross.png" class="clear-icon" id="clearIcon" alt="Clear Icon">
            </div>
        </form>
        <button id="watchlist-btn"><i class="fa-solid fa-plus"></i> Watchlist</button>
        <button id="news-btn">News</button>
        <!-- Conditional Login/Logout Elements -->
        <?php if (isLogin()): ?>
            
            <!-- Profile Dropdown -->
            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="?module=watchlist&action=viewWatchlist">Your watchlist</a></li>
                    <li><a class="dropdown-item" href="#">Your ratings</a></li>
                    <li><a class="dropdown-item" href="#">Account Settings</a></li>
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