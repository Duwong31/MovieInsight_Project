const searchInput = document.getElementById('searchInput');
const clearIcon = document.getElementById('clearIcon');

// Show clear icon when typing
searchInput.addEventListener('input', function() {
    if (this.value.length > 0) {
        clearIcon.style.display = 'block';
    } else {
        clearIcon.style.display = 'none';
    }
});

// Clear phần tìm kiếm
clearIcon.addEventListener('click', function() {
    searchInput.value = '';
    clearIcon.style.display = 'none';
    searchInput.focus();
});
//Movies
const productContainers = [...document.querySelectorAll('.movie-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    });

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    });
});
//Login button and signup button 
document.addEventListener("DOMContentLoaded", function() {
    const loginBtn = document.getElementById("login-btn");
    const signUpBtn = document.getElementById("sign-up-btn");
    const newsBtn = document.getElementById("news-btn");

    if (loginBtn) {
        loginBtn.addEventListener("click", function() {
            console.log("Button clicked");
            window.location.href = "?module=auth&action=loginUser"; 
        });
    }

    if (signUpBtn) {
        signUpBtn.addEventListener("click", function() {
            console.log("Button clicked");
            window.location.href = "?module=auth&action=signup"; 
        });
    }
    if(newsBtn){
        newsBtn.addEventListener("click", function() {
            console.log("Button clicked");
            window.location.href = "?module=watchlist&action=news"; 
        });
    }
});



document.addEventListener("DOMContentLoaded", function() {
    // Mở form đánh giá khi nhấn vào nút "Rate"
    document.querySelectorAll('.rate-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            event.stopPropagation();
            const movieId = this.dataset.movieId;

            if (!isLoggedIn) {
                alert("Please log in to rate this movie.");
            } else {
                const form = document.querySelector(`.rating-form[data-movie-id="${movieId}"]`);
                form.style.display = 'block';

                // Kiểm tra nếu đã đánh giá, hiển thị nút "Remove Rating"
                const userRating = this.textContent.includes("★") ? parseInt(this.textContent.split("★ ")[1]) : null;
                const removeRatingBtn = form.querySelector('.remove-rating-btn');
                
                if (userRating) {
                    removeRatingBtn.style.display = 'block';
                } else {
                    removeRatingBtn.style.display = 'none';
                }
            }
        });
    });

    // Đóng form khi nhấn vào nút "X"
    document.querySelectorAll('.close-btn').forEach(closeBtn => {
        closeBtn.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    });

    // Đóng form khi nhấp ra ngoài form
    window.addEventListener('click', function(event) {
        document.querySelectorAll('.rating-form').forEach(form => {
            if (form.style.display === 'block' && !form.contains(event.target) && !event.target.classList.contains('rate-link')) {
                form.style.display = 'none';
            }
        });
    });

    // Tô màu sao khi hover
    document.querySelectorAll('.rating-form').forEach(form => {
        const stars = form.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', function() {
                for (let i = 0; i <= index; i++) {
                    stars[i].classList.add('hovered');
                }
            });
            star.addEventListener('mouseleave', function() {
                stars.forEach(star => star.classList.remove('hovered'));
            });
        });
    });

    // Sự kiện click để gửi đánh giá
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const ratingValue = this.dataset.value;
            const movieId = this.closest('.rating-form').dataset.movieId;

            fetch('./ajax/rate_movie.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ movie_id: movieId, rating: ratingValue, user_id: loggedInUserId })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert("Thank you for rating!");
                    updateRatingUI(movieId, ratingValue, data.new_average_rating);
                    const form = document.querySelector(`.rating-form[data-movie-id="${movieId}"]`);
                    form.style.display = 'none'; // Đóng form sau khi đánh giá thành công
                } else {
                    alert(data.error || "There was an error submitting your rating.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("There was an error submitting your rating.");
            });
        });
    });

    // Xử lý sự kiện click để xoá đánh giá
    document.querySelectorAll('.remove-rating-btn').forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('.rating-form');
            const movieId = form.dataset.movieId;

            fetch('./ajax/remove_rating.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ movie_id: movieId, user_id: loggedInUserId })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert("Your rating has been removed.");
                    updateRatingUI(movieId, null, data.new_average_rating);
                    form.style.display = 'none'; // Đóng form sau khi xoá đánh giá thành công
                } else {
                    alert(data.error || "There was an error removing your rating.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("There was an error removing your rating.");
            });
        });
    });

    // Hàm cập nhật giao diện sau khi gửi hoặc xoá đánh giá
    function updateRatingUI(movieId, ratingValue, newAverageRating) {
        const rateButton = document.querySelector(`.rate-link[data-movie-id="${movieId}"]`);
        if (rateButton) {
            if (ratingValue) {
                rateButton.textContent = `★ ${ratingValue}`;
                rateButton.classList.add('rated');
            } else {
                rateButton.textContent = "☆ Rate";
                rateButton.classList.remove('rated');
            }
        }

        const ratingScoreElement = document.querySelector(`.movie-card[data-movie-id="${movieId}"] .rating-score`);
        if (ratingScoreElement) {
            ratingScoreElement.textContent = `★ ${newAverageRating}/10`;
        }
    }
    
});
