<?php
if (!defined('_CODE')) {
    die('Access denied');
}

// Kiểm tra id trong database nếu tồn tại thì xóa
// Xóa dữ liệu bảng token_login trước sau đó xóa dữ liệu bảng customer
$filterAll = filter();

if (!empty($filterAll['id'])) {
    $userId = $filterAll['id'];
    $userDetail = oneRaw("SELECT * FROM user WHERE user_id = $userId");
    if ($userDetail > 0) {
        $deleteToken = delete('token_login', "user_id = '$userId'");
        if ($deleteToken) {
            $deleteUser = delete('user', "user_id = '$userId'");
            if ($deleteUser) {
                setFlashData('smg', 'Xóa người dùng thành công');
                setFlashData('smg_types', 'success');
            } else {
                setFlashData('smg', 'Lỗi hệ thống');
                setFlashData('smg_types', 'danger');
            }
        }
    } else {
        setFlashData('smg', 'Người dùng không tồn tại');
        setFlashData('smg_types', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=user_management');
