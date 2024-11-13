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

    if (loginBtn) {
        loginBtn.addEventListener("click", function() {
            console.log("Button clicked");
            window.location.href = "http://localhost/MovieInsightProject/?module=auth&action=loginUser"; 
        });
    }

    if (signUpBtn) {
        signUpBtn.addEventListener("click", function() {
            console.log("Button clicked");
            window.location.href = "http://localhost/MovieInsightProject/?module=auth&action=signup"; 
        });
    }
});



// Đóng form khi nhấn nút X
document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
    closeBtn.addEventListener('click', function() { 
        this.parentElement.style.display = 'none'; 
    });
});
// Đóng form khi nhấp ra ngoài
window.addEventListener('click', function(event) {
    document.querySelectorAll('.rating-form').forEach(form => {
        if (!form.contains(event.target) && form.style.display === 'block') {
            form.style.display = 'none';
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.rate-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
            event.stopPropagation();
            const movieId = this.dataset.movieId;

            if (!isLoggedIn) {
                alert("Please log in to rate this movie.");
            } else {
                const form = document.querySelector(`.rating-form[data-movie-id="${movieId}"]`);
                form.style.display = 'block';
                console.log("Form opened for movie ID:", movieId);
            }
        });
    });
});

document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function() {
        const ratingValue = this.dataset.value;
        const movieId = this.closest('.rating-form').dataset.movieId;
        console.log("Sending data:", { movie_id: movieId, rating: ratingValue, user_id: loggedInUserId });
        fetch('./ajax/rate_movie.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ movie_id: movieId, rating: ratingValue, user_id: loggedInUserId })
        })
        .then(response => {
            console.log(response);
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })  
        .then(data => {
            if (data.success) {
                alert("Thank you for rating!");
                const rateButton = document.querySelector(`.rate-link[data-movie-id="${movieId}"]`); 
                if (rateButton) { 
                    rateButton.textContent = `★ ${ratingValue}`; 
                    rateButton.classList.add('rated'); 
                } else { 
                    console.warn("Rate button element not found."); 
                }
                const ratingScoreElement = document.querySelector(`.movie-card[data-movie-id="${movieId}"] .rating-score`);
                if (ratingScoreElement) {
                    ratingScoreElement.textContent = `★ ${data.new_average_rating}/10`;
                } else {
                    console.warn("Rating score element not found.");
                }
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
