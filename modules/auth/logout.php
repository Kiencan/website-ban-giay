<!-- Đăng xuất tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}

if (isLogin()) {
    $token = getSession('token_login');
    delete('token_login', "token = '$token'");
    removeSession('token_login');
    redirect('?module=user&action=dashboard');
}
