<div>
  <h3>Genres Items</h3>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Genres Name</th>
        <th class="text-center" colspan="2">Action</th>
      </tr>
    </thead>
    <?php
      const _CODE = true;
      include_once '../include/connect.php';


      $sql = "SELECT * FROM genres";
      $result = $con->query($sql);
      $count = 1;

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
    <tr>
      <td class="text-center"><?= $count ?></td>
      <td class="text-center"><?= htmlspecialchars($row["genres_name"]) ?></td>
      <td class="text-center">
        <button class="btn btn-danger" style="height:40px" onclick="genresDelete('<?= $row['genres_id'] ?>')">Delete</button>
      </td>
    </tr>
    <?php
          $count++;
        }
      } else {
        echo "<tr><td colspan='4' class='text-center'>No genres found</td></tr>";
      }
    ?>
  </table>

  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-secondary" style="height:40px" data-toggle="modal" data-target="#myModal">
    Add genres
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New genres Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data" action="./controller/addGenresController.php" method="POST">
            <div class="form-group">
              <label for="c_name">Genres Name:</label>
              <input type="text" class="form-control" name="c_name" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-secondary" name="upload" style="height:40px">Add genres</button>
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
