<!-- Tài khoản kích hoạt -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}

layouts('header-login', ['pageTitle' => 'Active']);

$token = filter()['token'];
if (!empty($token)) {
    // Truy vấn để kiểm tra token tồn tại trong database
    $tokenQuery = oneRaw("SELECT user_id FROM user WHERE activeToken = '$token'");
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['user_id'];
        // Insert vào bảng users
        $dataUpdate = [
            'status' => 1,
            'activeToken' => null,
        ];
        $updateStatus = update('user', $dataUpdate, "user_id=$userId");
        if ($updateStatus) {
            setFlashData('smg', 'Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Kích hoạt tài khoản không thành công, vui lòng liên hệ admin để kiểm tra');
            setFlashData('smg_types', 'danger');
        }
        redirect('?module=auth&action=login');
    } else {
        getSmg('Liên kết không tồn tại!', 'danger');
    }
} else {
    getSmg('Liên kết không tồn tại!', 'danger');
}


layouts('footer-login');
?>