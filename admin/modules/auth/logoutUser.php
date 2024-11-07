<!----- Đăng xuất tài khoản ------>

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
if(isLogin()){
    $token = getSession('tokenlogin');
    delete('tokenlogin', "token='$token'");
    removeSession('tokenlogin');
    redirect('?module=home&action=index');
}
?>
