<div>
  <h2>Movie Items</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Poster</th>
        <th class="text-center">Movie Name</th>
        <th class="text-center">Release Year</th>
        <th class="text-center">Genres Name</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
    const _CODE = true;
    include_once '../include/connect.php';


    $sql = "SELECT * from movies 
            JOIN genres ON movies.genres_id = genres.genres_id 
            WHERE movies.movie_type = 'isMovie'";
    $result = $con->query($sql);
    $count = 1;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <tr>
          <td><?= $count ?></td>
          <td><img height='100px' src='<?= $row["movie_image"] ?>'></td>
          <td><?= $row["movie_name"] ?></td>
          <td><?= $row["release_date"] ?></td>
          <td><?= $row["genres_name"] ?></td>
          <td><button class="btn btn-primary" style="height:40px" onclick="itemEditForm('<?= $row['movie_id'] ?>')">Edit</button></td>
          <td><button class="btn btn-danger" style="height:40px" onclick="itemDelete('<?= $row['movie_id'] ?>')">Delete</button></td>
        </tr>
    <?php
        $count = $count + 1;
      }
    }
    ?>
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#myModal">
    Add movie
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New movie Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form enctype='multipart/form-data' onsubmit="addItems()" method="POST">
            <div class="form-group">
              <label for="name">Movie Name:</label>
              <input type="text" class="form-control" id="p_name" required>
            </div>
            <div class="form-group">
              <label for="date">Release date:</label>
              <input type="text" class="form-control" id="p_date" required>
            </div>
            <div class="form-group">
              <label for="duration">Duration:</label>
              <input type="text" class="form-control" id="p_duration">
            </div>
            <div class="form-group">
              <label for="director">Director:</label>
              <input type="text" class="form-control" id="p_director">
            </div>
            <div class="form-group">
              <label for="actors">Actors (Seperated by comma):</label>
              <input type="text" class="form-control" id="p_actors" required>
            </div>
            <div class="form-group">
              <label for="qty">Description:</label>
              <input type="text" class="form-control" id="p_desc">
            </div>
            <div class="form-group">
              <label>Genres:</label>
              <select id="genres">
                <option disabled selected>Select genres</option>
                <?php

                $sql = "SELECT * from genres";
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
              <label for="file">Choose Image:</label>
              <input type="file" class="form-control-file" id="file">
            </div>
            <!-- Hidden input for movie_type -->
            <input type="hidden" id="movie_type" value="isMovie">
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" id="upload" style="height:40px">Add Item</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>

    </div>
  </div>


</div>