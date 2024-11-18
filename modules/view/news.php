<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <link rel="stylesheet" href="./templates/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="./templates/fonts/Awesome/css/all.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .new-title{
            color: white;
        }
        .newsSection {
            margin-top: 75px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .news-article {
            padding: 20px;
            margin-bottom: 20px;
            /* Tạo khoảng cách giữa các bài viết */
            border-bottom: 1px solid #ddd;
            /* Thêm đường phân cách */
        }

        .news-article:last-child {
            border-bottom: none;
            /* Loại bỏ đường kẻ dưới bài viết cuối cùng */
        }


        #news-title {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #222;
        }

        .featured-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .featured-image img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .article-content p {
            margin-bottom: 15px;
        }

        .article-content a {
            color: #007bff;
            text-decoration: none;
        }

        .article-content a:hover {
            text-decoration: underline;
        }

    </style>
</head>

<body>
    <?php
    include(__DIR__ . '/../home/header.php');
    ?>
    <h1 class="newsSection">Movie News</h1>
    <main>
        <?php

        $query = "SELECT title, content, image_url, source FROM news ORDER BY created_at DESC";
        $result = $con->query($query);

        if ($result && $result->num_rows > 0):
            while ($news = $result->fetch_assoc()):
        ?>
                <article class="news-article">
                    <div>
                        <h1 id="news-title"><?php echo htmlspecialchars($news['title']); ?></h1>
                    </div>
                    <section class="featured-image">
                        <img src="./admin/<?php echo htmlspecialchars($news['image_url']); ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                    </section>
                    <section class="article-content">
                        <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                    </section>
                    <footer class="article-content">
                        <small>See full article at <a href="<?php echo htmlspecialchars($news['source']); ?>"><?php echo htmlspecialchars($news['title']); ?></a></small>
                    </footer>
                </article>
            <?php
            endwhile;
        else:
            ?>
            <p>No news articles available.</p>
        <?php endif; ?>
    </main>
</body>
<?php include(__DIR__ . '/../home/footer.php')  ?>
<script src="./templates/js/script.js"></script>
</html>