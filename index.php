<?php
session_start();
require_once('config.php');
require_once('./admin/include/connect.php');

//Thư viên phpmailer
require_once('./admin/include/phpmailer/Exception.php');
require_once('./admin/include/phpmailer/PHPMailer.php');
require_once('./admin/include/phpmailer/SMTP.php');

require_once('./admin/include/functions.php');
require_once('./admin/include/database.php');
require_once('./admin/include/session.php');

$module = _MODULE;
$action = _ACTION;

if(!empty($_GET['module'])){
    if(is_string($_GET['module'])){
        $module = trim($_GET['module']);
    }
}

if(!empty($_GET['action'])){
    if(is_string($_GET['action'])){
        $action = trim($_GET['action']);
    }
}

$path = 'admin/modules/'. $module. '/' . $action . '.php';

if(file_exists($path)){
    require_once($path);
}else{
    require_once('admin/modules/error/404.php');
}

?>
