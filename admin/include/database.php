<!-- Các hàm xử lý liên quan đến CSDL------->
<?php
if(!defined('_CODE')){
  die('Access denied...');
}

function query($sql, $data = [], $check = false) {
  global $con;
  $result = false;
  try {
      $statement = $con->prepare($sql);

      if (!empty($data)) {
          // Tạo chuỗi loại dữ liệu cho bind_param
          $types = str_repeat('s', count($data)); 
          $statement->bind_param($types, ...$data);
      }

      $result = $statement->execute();
  } catch (Exception $exp) {
      echo $exp->getMessage() . '<br>';
      echo 'File ' . $exp->getFile() . '<br>';
      echo 'Line ' . $exp->getLine();
      die();
  }
  if($check == true){
    return $statement;
  }
  return $result;
}


//Hàm insert vào data
function insert($table, $data) {
  $keys = array_keys($data); // Lấy tên các cột
  $columns = implode(',', $keys); // Tạo chuỗi cột, ví dụ: "fullname,email,phone"
  $placeholders = implode(',', array_fill(0, count($keys), '?')); // Tạo chuỗi "?, ?, ?" dựa trên số lượng cột

  $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

  return query($sql, array_values($data));
}

//Hàm update 
function update($table, $data, $condition = '') {
  $update = '';
  $values = [];

  foreach ($data as $key => $value) {
      $update .= "$key = ?, ";
      $values[] = $value;
  }
  $update = rtrim($update, ', ');

  if (!empty($condition)) {
      $sql = "UPDATE $table SET $update WHERE $condition";
  } else {
      $sql = "UPDATE $table SET $update";
  }

  return query($sql, $values);
}

//Hàm delete  
function delete($table, $condition = '', $params = []) {
  // Kiểm tra xem có điều kiện không để tránh xóa toàn bộ dữ liệu
  if (empty($condition)) {
      die("Delete operation requires a condition to prevent accidental deletion of all rows.");
  }
  $sql = "DELETE FROM $table WHERE $condition";

  return query($sql, $params);
}

//Lấy nhiều dòng dữ liệu
function getRaw($sql,$data = []){
  $kq = query($sql, $data, true); // Gọi query và yêu cầu trả về statement
    if (is_object($kq)) {
        return $kq->get_result()->fetch_all(MYSQLI_ASSOC); // Lấy tất cả dòng dưới dạng mảng kết hợp
    }
    return [];
}

// Lấy 1 dòng dữ liệu
function oneRaw($sql, $data=[]) {
  $kq = query($sql, $data, true); // Gọi query và yêu cầu trả về statement
    if (is_object($kq)) {
        return $kq->get_result()->fetch_assoc(); // Lấy một dòng dữ liệu dưới dạng mảng kết hợp
    }
    return null;
}

// Đếm số dòng dữ liệu
function getRows($sql, $data=[]) {
  $kq = query($sql, $data, true); // Gọi query và yêu cầu trả về statement
    if (is_object($kq)) {
        return $kq->get_result()->num_rows; // Trả về số dòng
    }
    return 0;
}

?>