<style>
    .search-container {
        position: relative;
        width: 600px;
        margin: 20px;
    }

    #search-bar {
        width: 100%;
        padding: 10px;
        border: none !important;
        border-radius: 4px;
    }

    .suggestions-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: none;
        border-radius: 4px;
        z-index: 10;
        max-height: 200px;
        overflow-y: auto;
        display: none;
    }

    .suggestions-list .suggestion-item {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
    }

    .suggestions-list .suggestion-item img {
        width: 50px;
        height: 70px;
        object-fit: cover;
        margin-right: 10px;
    }

    .suggestions-list .suggestion-item:hover {
        background: #f0f0f0;
    }

    .search-container {
        position: relative;
        width: 300px;
        margin: 20px;
    }

    #search-bar {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .suggestions-list {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 10;
        max-height: 200px;
        overflow-y: auto;
        display: none;
    }

    .suggestions-list .suggestion-item {
        padding: 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #ddd;
    }

    .suggestions-list .suggestion-item img {
        width: 50px;
        height: 70px;
        object-fit: cover;
        margin-right: 10px;
    }

    .suggestions-list .suggestion-item:hover {
        background: #f0f0f0;
    }
</style>
<header id="header">
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
            <li><a href="?module=view&action=movieList">Movies</a></li>
            <li><a href="?module=view&action=tvshowsList">TV Shows</a></li>
            <li><a href="?module=view&action=celebList">Celebs</a></li>
            <li><a href="?module=view&action=news">News</a></li>
        </ul>
        <form action="" class="search-box">
            <div class="search-container">
                <input type="text" name="search" class="search-input" placeholder="Search Movie Insight" id="search-bar" onkeyup="searchMovies(this.value)">
                <div id="suggestions" class="suggestions-list"></div>
                <img src="./templates/img/cross.png" class="clear-icon" id="clearIcon" alt="Clear Icon">
            </div>
        </form>
        <button id="watchlist-btn" onclick="handleWatchlist()"><i class="fa-solid fa-plus"></i> Watchlist</button>
        <script>
            function handleWatchlist() {
                <?php if (isLogin()): ?>
                    // Nếu người dùng đã đăng nhập, điều hướng đến trang watchlist
                    window.location.href = "?module=view&action=viewWatchlist";
                <?php else: ?>
                    // Nếu người dùng chưa đăng nhập, điều hướng đến trang đăng nhập
                    window.location.href = "?module=auth&action=loginUser";
                <?php endif; ?>
            }
        </script>
        <button id="news-btn">News</button>
        <!-- Conditional Login/Logout Elements -->
        <?php if (isLogin()): ?>

            <!-- Profile Dropdown -->
            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="?module=view&action=viewWatchlist">Your watchlist</a></li>
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
<script>
    function searchMovies(query) {
        const suggestions = document.getElementById("suggestions");
        if (query.length === 0) {
            suggestions.style.display = "none";
            return;
        }

        fetch(`./modules/home/search.php?query=${query}`)
            .then((response) => response.json())
            .then((data) => {
                suggestions.innerHTML = ""; // Clear previous suggestions
                data.forEach((movie) => {
                    const item = document.createElement("div");
                    item.classList.add("suggestion-item");
                    item.innerHTML = `
                    <img src="./admin/${movie.movie_image}" alt="${movie.movie_name}">
                    <div>
                        <h4>${movie.movie_name}</h4>
                        <p>${movie.release_date}</p>
                    </div>
                `;
                    item.onclick = () => {
                        window.location.href = `?module=view&action=movie_detail&movie_id=${movie.movie_id}`;
                    };
                    suggestions.appendChild(item);
                });

                suggestions.style.display = "block";
            })
            .catch((error) => console.error("Error:", error));
    }
</script>