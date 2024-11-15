<div class="container p-5">

  <h4>Edit Movies Detail</h4>
  <?php
  const _CODE = true;
  include_once 'C:/xampp/htdocs/MovieInsightProject/admin/include/connect.php';

  $ID = $_POST['record'];

  $qry = mysqli_query($con, "SELECT * FROM movies WHERE movie_id='$ID'");

  $numberOfRow = mysqli_num_rows($qry);

  if ($numberOfRow > 0) {
    while ($row1 = mysqli_fetch_array($qry)) {
      $catID = $row1["genres_id"];
      $actorIds = $row1['actors_id'];  // Lấy actors_id từ bảng movies
      $actorNames = [];
      // Lấy tên diễn viên từ bảng actors dựa trên actors_id
      if (!empty($actorIds)) {
        $actorIdsArray = explode(",", $actorIds);  // Chuyển actors_id thành mảng
        foreach ($actorIdsArray as $actorId) {
            $actorQuery = "SELECT actor_name FROM actors WHERE actors_id = ?";
            $actorStmt = $con->prepare($actorQuery);
            $actorStmt->bind_param("i", $actorId);
            $actorStmt->execute();
            $actorResult = $actorStmt->get_result();

            if ($actorResult->num_rows > 0) {
                $actorRow = $actorResult->fetch_assoc();
                $actorNames[] = $actorRow['actor_name'];  // Thêm tên diễn viên vào mảng
            }
            $actorStmt->close();
        }
    }

    // Chuyển mảng actorNames thành chuỗi
    $actorNamesString = implode(", ", $actorNames);
  ?>
      <form id="update-Items" onsubmit="updateItems()" enctype='multipart/form-data'>
        <div class="form-group">
          <input type="text" class="form-control" id="movie_id" value="<?= $row1['movie_id'] ?>" hidden>
        </div>
        <div class="form-group">
          <label for="name">Movie Name:</label>
          <input type="text" class="form-control" id="p_name" value="<?= $row1['movie_name'] ?>">
        </div>
        <div class="form-date-duration">
          <div>
            <label for="qty">Release Date:</label>
            <input type="text" class="form-control" id="p_date" value="<?= $row1['release_date'] ?>" required>
          </div>
          <div>
            <label for="qty">Duration:</label>
            <input type="text" class="form-control" id="p_duration" value="<?= $row1['duration'] ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="desc">Movie Description:</label>
          <input type="text" class="form-control" id="p_desc" value="<?= $row1['movie_desc'] ?>">
        </div>
        <div class="form-group">
          <label for="director">Director</label>
          <input type="text" class="form-control" id="p_director" value="<?= $row1['director'] ?>">
        </div>
        <div class="form-group">
          <label for="actors">Actors (separate by commas):</label>
          <input type="text" class="form-control" id="p_actors" value="<?= $actorNamesString ?>">
        </div>
        <div class="form-group">
          <label>Genres:</label>
          <select id="genres">
            <?php
            $sql = "SELECT * from genres WHERE genres_id='$catID'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['genres_id'] . "' selected>" . $row['genres_name'] . "</option>";
              }
            }
            ?>
            <?php
            $sql = "SELECT * from genres WHERE genres_id!='$catID'";
            $result = $con->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['genres_id'] . "'>" . $row['genres_name'] . "</option>";
              }
            }
            ?>
          </select>
          
        </div>
        <div class="form-group">
          <img width='200px' height='150px' src='<?= $row1["movie_image"] ?>'>
          <div>
            <label for="file">Choose Image:</label>
            <input type="text" id="existingImage" class="form-control" value="<?= $row1['movie_image'] ?>" hidden>
            <input type="file" id="newImage" value="">
          </div>
        </div>
        <div class="form-group">
          <button type="submit" style="height:40px" class="btn btn-primary">Update Item</button>
        </div>
    <?php
    }
  }
    ?>
      </form>

</div>