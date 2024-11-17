<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./assets/css/style.css">
        </link>
    </head>
</head>

<body>

    <?php
    const _CODE = true;
    include "./adminHeader.php";
    include "./sidebar.php";

    include_once "../admin/include/connect.php";
    ?>

    <div id="main-content" class="container allContent-section py-4">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-users  mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Total Users</h4>
                    <h5 style="color:white;">
                        <?php
                        $sql = "SELECT * from users where isAdmin=0";
                        $result = $con->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $count = $count + 1;
                            }
                        }
                        echo $count;
                        ?></h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th-large mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Genres</h4>
                    <h5 style="color:white;">
                        <?php

                        $sql = "SELECT * from genres";
                        $result = $con->query($sql);
                        $count = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $count = $count + 1;
                            }
                        }
                        echo $count;
                        ?>
                    </h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-th mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">Movies</h4>
                    <h5 style="color:white;">
                        <?php

                        $sql = "SELECT COUNT(*) AS total FROM movies WHERE movie_type = 'isMovie'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        ?>
                    </h5>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <i class="fa fa-tv mb-2" style="font-size: 70px;"></i>
                    <h4 style="color:white;">TVShows</h4>
                    <h5 style="color:white;">
                        <?php
                        $sql = "SELECT COUNT(*) AS total FROM movies WHERE movie_type = 'isTVShow'";
                        $result = $con->query($sql);
                        $row = $result->fetch_assoc();
                        echo $row['total'];
                        ?>
                    </h5>
                </div>
            </div>


        </div>

    </div>


    <?php
    if (isset($_GET['category']) && $_GET['category'] == "success") {
        echo '<script> alert("Category Successfully Added")</script>';
    } else if (isset($_GET['category']) && $_GET['category'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
    }
    if (isset($_GET['size']) && $_GET['size'] == "success") {
        echo '<script> alert("Size Successfully Added")</script>';
    } else if (isset($_GET['size']) && $_GET['size'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
    }
    if (isset($_GET['variation']) && $_GET['variation'] == "success") {
        echo '<script> alert("Variation Successfully Added")</script>';
    } else if (isset($_GET['variation']) && $_GET['variation'] == "error") {
        echo '<script> alert("Adding Unsuccess")</script>';
    }
    ?>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="./assets/js/ajaxWork.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>