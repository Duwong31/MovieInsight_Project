<?php
    if(!defined('_CODE')){
        die('Access denied...');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($data['pageTitle']) ? $data['pageTitle'] : 'Quản lý người dùng'; ?></title>
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATES; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href=" <?php echo _WEB_HOST_TEMPLATES; ?>/css/admin.css">
    <link rel="stylesheet" href="templates/fonts/Awesome/css/all.css">
</head>