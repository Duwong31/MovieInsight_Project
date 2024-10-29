<?php

session_start();
require_once('config.php');
require_once('./include/connect.php');
require_once('./include/functions.php');
require_once('./include/database.php');


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


$path = 'modules/'. $module. '/' . $action . '.php';

if(file_exists($path)){
    require_once($path);
}else{
    require_once('modules/error/404.php');
}

?>
