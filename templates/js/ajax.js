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


