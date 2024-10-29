<!--- Các hàm chung của project ---------->

<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }

function layouts($layoutName='header', $data = []){
    if(file_exists(_WEB_PATH_TEMPLATES . '/layout/' .$layoutName.'.php')){
        require_once _WEB_PATH_TEMPLATES . '/layout/' .$layoutName.'.php';
    }
}
?>