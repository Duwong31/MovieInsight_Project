<div >
  <h2>All Customers</h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">S.N.</th>
        <th class="text-center">Username </th>
        <th class="text-center">Email</th>
        <th class="text-center">Contact Number</th>
        <th class="text-center">Joining Date</th>
      </tr>
    </thead>
    <?php
      const _CODE = true;
      include_once '../include/connect.php';
      
      $sql="SELECT * from users where isAdmin=0";
      $result=$con-> query($sql);
      $count=1;
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
           
    ?>
    <tr>
      <td><?=$count?></td>
      <td><?=$row["fullname"]?></td>
      <td><?=$row["email"]?></td>
      <td><?=$row["phone"]?></td>
      <td><?=$row["create_at"]?></td>
    </tr>
    <?php
            $count=$count+1;
           
        }
    }
    ?>
  </table>