// Thêm phim vào watchlist 
function addToWatchlist(movieId) {
    if (!isLoggedIn) { 
        alert("Please log in to add movies to your watchlist."); 
        return; 
    }
    fetch(`./ajax/addToWatchlist.php?movie_id=${movieId}`, {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

function removeFromWatchlist(movieId) {
    fetch(`./ajax/removeFromWatchlist.php?movie_id=${movieId}`, {
        method: 'GET',
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`movie-${movieId}`).remove(); // Xóa phim khỏi giao diện
        } else {
            alert("Failed to remove movie");
        }
    })
    .catch(error => console.error('Error:', error));
}


function showMovieDetails(movieId) {
    fetch('http://localhost/MovieInsightProject/modules/view/movie_detail.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ movie_id: movieId })
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('movie-details').innerHTML = data; // Hiển thị dữ liệu trong phần tử có id là movie-details
    })
    .catch(error => console.error('Error:', error));
}

