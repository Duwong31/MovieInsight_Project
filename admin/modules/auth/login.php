<!--- Đăng nhập tài khoản ---->

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }

$data = [
    'pageTitle' => 'Đăng nhập tài khoản'
];

layouts('header', $data);
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng nhập quản trị viên</h2>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="">Email</label>
                <input type="email" class="form-control" placeholder="Địa chỉ email">
            </div>
            <div class="form-group mg-form">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" placeholder="Mật khẩu">
            </div>     

            <button type="submit" class="mg-btn btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?module=auth&action=signup">Đăng ký tài khoản</a></p>
        </form>    
    </div>
</div>






<?php
layouts('footer');
?>