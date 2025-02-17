<?php 
        include(__DIR__ . '/../home/header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top TVshows</title>
    <link rel="shortcut icon" href="./templates/img/icons8-movie-30.png">
    <link rel="stylesheet" href="./templates/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="./templates/fonts/Awesome/css/all.css" rel="stylesheet">
    <style>
        body{
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: black;
            color: black;
            margin: 0;
            padding: 0;
        }
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 500px;
            margin-top: 100px;
        }
        .container {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr; /* Sidebar trái | Nội dung chính | Sidebar phải */
            gap: 20px;
        }

        .sidebar-left {
            width: 100px;
        }

        .content {
            flex: 3;
        }

        .sidebar-right {
            flex: 1;
        }

    </style>
<body>
    <main>

    </main>
</body>
<?php include(__DIR__ . '/../home/footer.php')  ?>
<script src="./templates/js/script.js"></script>

</html>