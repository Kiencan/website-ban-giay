<?php

if (!defined('_CODE')) {
    die('Access denied');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;

    if ($user_id) {
        // Đếm số lượng sản phẩm trong giỏ hàng
        $cartCount = getRows("SELECT * FROM cart WHERE user_id = '$user_id'");
        echo $cartCount;
    } else {
        echo 0; // Người dùng chưa đăng nhập
    }
} else {
    echo "Phương thức không được hỗ trợ.";
}
