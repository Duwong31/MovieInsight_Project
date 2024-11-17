<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ratings</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Back button */
        .back-btn a {
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        .back-btn a span {
            font-weight: bold;
        }

        /* Section title */
        h1 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* Dropdown menu */
        .dropdown {
            position: relative;
            float: right;
            margin-bottom: 20px;
        }

        .dropdown-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
            z-index: 1000;
        }

        .dropdown-menu .menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-menu ul {
            list-style: none;
            margin: 0;
            padding: 10px;
        }

        .dropdown-menu ul li {
            padding: 10px 15px;
        }

        .dropdown-menu ul li a {
            text-decoration: none;
            color: #333;
            font-size: 14px;
        }

        .dropdown-btn:hover+.dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }

        /* Rating item */
        .rating-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-top: 20px;
        }

        /* Thumbnail */
        .thumbnail {
            position: relative;
            width: 100px;
            height: 150px;
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .play-btn {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 50%;
            cursor: pointer;
        }

        /* Movie details */
        .details {
            flex: 1;
        }

        .details h2 {
            font-size: 18px;
            margin: 0;
        }

        .scores {
            margin: 10px 0;
            font-size: 14px;
        }

        .scores span {
            margin-right: 15px;
        }

        /* User rating */
        .user-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .stars {
            color: gold;
            font-size: 16px;
        }

        .edit-btn {
            background: none;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        .add-review {
            display: inline-block;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Back button -->
        <div class="back-btn">
            <a href="#"><span>←</span> Overview</a>
        </div>

        <!-- Section title -->
        <h1>My Ratings</h1>

        <!-- Dropdown menu -->
        <div class="dropdown">
            <button class="dropdown-btn">MOVIES ▼</button>
            <div class="dropdown-menu">
                <div class="menu-header">
                    <span>MOVIES</span>
                    <button class="close-btn">✖</button>
                </div>
                <ul>
                    <li><a href="#">MOVIES</a></li>
                    <li><a href="#">TV SHOWS</a></li>
                </ul>
            </div>
        </div>

        <!-- Ratings section -->
        <div class="rating-item">
            <!-- Movie thumbnail -->
            <div class="thumbnail">
                <img src="movie-thumbnail.jpg" alt="Saturday Night">
                <button class="play-btn">▶</button>
            </div>

            <!-- Movie details -->
            <div class="details">
                <h2>Saturday Night</h2>
                <div class="scores">
                    <span>MI Rating:</span>
                </div>
                <div class="user-rating">
                    <span>Your rating:</span>
                    <span class="stars">★★★★☆</span>
                    <button class="edit-btn">✏</button>
                </div>
                <a href="#" class="add-review">+ ADD A REVIEW</a>
            </div>
        </div>
    </div>
</body>

</html>