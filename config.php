<?php
// Các hằng số chung của project

// Điều hướng file
const _MODULE = 'user';
const _ACTION = 'trangchu';

// Cấp quyền truy cập cho file
const _CODE = true;

// Thiết lập host
define('_WEB_HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/website-ban-giay');
define('_WEB_HOST_TEMPLATE', _WEB_HOST . '/templates');

// Thiết lập path
define('_WEB_PATH', __DIR__);
// define('_WEB_PATH_TEMPLATE', _WEB_PATH . '\templates');
define('_WEB_PATH_TEMPLATE', 'C:/xampp/htdocs/website-ban-giay/templates/');
// define('_WEB_PATH_TEMPLATE', 'D:/XamppData/htdocs/website-ban-giay/templates/');
// Thông tin kết nối
const _HOST = 'localhost';
const _DB = 'shoes_shop_db';
const _USER = 'root';
const _PASS = '';

// Thời gian tại Việt Nam
date_default_timezone_set('Asia/Ho_Chi_Minh');
