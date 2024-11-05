<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }

    $data = [
        'pageTitle' => 'Trang dashboard'
    ];

    layouts('header', $data);

    //Kiểm tra trạng thái đăng nhập

    if(!isLogin()){
        redirect('?module=auth&action=login');
    }
?>
<h1>Dashboard</h1>

<?php
layouts('footer');  
?>