<?php
if (!defined('_CODE')) {
    die('Access denied');
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $subject = 'Giới thiệu về 3H1A Store!';
    $content = 'Chào ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '<br>'; // Xử lý để tránh XSS
    $content .= 'Giới thiệu về 3H1A Store';
    $sendMail = sendMail($email, $subject, $content);
    if ($sendMail) {
        echo json_encode(['status' => 'success', 'message' => 'Đã gửi thông tin đến email của bạn. Vui lòng kiểm tra!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
}
