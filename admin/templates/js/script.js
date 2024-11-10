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
//CHuyển hướng đến trang đăng nhập
document.getElementById("login-btn").addEventListener("click", function() {
    console.log("Button clicked");
    window.location.href = "http://localhost/MovieInsightProject/admin/?module=auth&action=loginUser"; 
});

// Chuyển hướng đến trang đăng ký

document.getElementById("sign-up-btn").addEventListener("click", function() {
    console.log("Button clicked");
    window.location.href = "http://localhost/MovieInsightProject/admin/?module=auth&action=signup"; 
});
document.querySelectorAll('.rate-link').forEach(function (rateLink) {
    rateLink.addEventListener('click', function (event) {
        event.preventDefault();
        const movieId = this.getAttribute('data-movie-id');
        const ratingForm = document.querySelector(`.rating-form[data-movie-id="${movieId}"]`);

        // Chỉ hiển thị form cho phim hiện tại
        ratingForm.style.display = 'block';
    });
});

// Đóng form khi nhấn nút X
document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
    closeBtn.addEventListener('click', function() { 
        this.parentElement.style.display = 'none'; 
    });
});

// Xử lý đánh giá sao
document.querySelectorAll('.star').forEach(function(star) {
    star.addEventListener('click', function() {
        const rating = this.getAttribute('data-value');
        const ratingForm = this.closest('.rating-form');
        const movieId = ratingForm.getAttribute('data-movie-id');

        // Cập nhật nút Rate cho phim hiện tại
        document.querySelector(`.rate-link[data-movie-id="${movieId}"]`).textContent = '☆ ' + rating;

        // Đóng form sau khi đánh giá
        ratingForm.style.display = 'none';

        // Gửi đánh giá lên server
        fetch('./admin/include/ajax/rating.php', {
            method: 'POST',
            body: JSON.stringify({ movie_id: movieId, rating: rating }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error); // Hiển thị thông báo nếu có lỗi
            } else {
                // Cập nhật điểm trung bình mới cho bộ phim hiện tại
                const ratingScoreElement = document.querySelector(`.rating-score[data-movie-id="${movieId}"]`);
                if (ratingScoreElement) {
                    ratingScoreElement.textContent = `★ ${data.average_rating.toFixed(1)}/10`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
        
    });
});