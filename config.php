
<?php 
const _MODULE = 'home';
const _ACTION = 'index';
const _CODE = true;
//thiết lập host
define('_WEB_HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/MovieInsightProject');
define('_WEB_HOST_TEMPLATES', _WEB_HOST . '/templates');

//thiết lập path
define('_WEB_PATH', __DIR__);
define('_WEB_PATH_TEMPLATES', _WEB_PATH . '/templates')
?>