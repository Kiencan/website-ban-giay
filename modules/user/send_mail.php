<?php
if (!defined('_CODE')) {
    die('Access denied');
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    $subject = 'Giới thiệu về 3H1A Store!';
    $content = 'Chào ' . $email . '<br>';
    $content .= 'Giới thiệu về 3H1A Store';
    $sendMail = sendMail($email, $subject, $content);
    if ($sendMail) {
        echo json_encode(['status' => 'sended', 'message' => 'Đã gửi thông tin đến email của bạn. Vui lòng kiểm tra!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống.']);
    }
}
