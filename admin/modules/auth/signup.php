<!--- Đăng ký tài khoản ------>

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
    require_once('./include/connect.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ biểu mẫu
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);
    
        // Kiểm tra xem mật khẩu và xác nhận mật khẩu có khớp không
        if ($password !== $confirmPassword) {
            echo "Mật khẩu không khớp.";
        } else {
        
            $sql = "INSERT INTO users (fullname, email, phone, password) VALUES (?, ?, ?, ?)";
    
            $values = [$fullname, $email, $phone, password_hash($password, PASSWORD_DEFAULT)]; // Mã hóa mật khẩu
    
            $datatypes = "ssss"; // Thêm 's' cho mật khẩu
    
            $result = insert($sql, $values, $datatypes);
    
            if ($result > 0) {
                echo "Thêm người dùng thành công.";
            } else {
                echo "Không thể thêm người dùng.";
            }
        }
    }

    $data = [
        'pageTitle' => 'Đăng ký tài khoản'
    ];
    
    layouts('header', $data);
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng ký tài khoản admin</h2>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Họ tên</label>
                <input type="text" name="fullname" class="form-control" placeholder="Họ tên" required>
            </div>
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Địa chỉ email" required>
            </div>
            <div class="form-group mg-form">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="084-XXX-XXXX" required>
            </div>
            <div class="form-group mg-form">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>     
            <div class="form-group mg-form">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
            </div>   

            <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng ký</button>
            <hr>
            
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập tài khoản</a></p>
        </form>    
    </div>
</div>




<?php
layouts('footer');
?>