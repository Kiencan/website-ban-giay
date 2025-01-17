<?php
if (!defined('_CODE')) {
    die('Access denied');
}

if (isset($_POST['different_email'])) {
    $name = $_POST['name'] ?? '';
    $different_email = $_POST['different_email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Kiểm tra đầu vào
    if (empty($name) || empty($different_email) || empty($message)) {
        echo json_encode(['status' => 'error', 'message' => 'Vui lòng điền đầy đủ thông tin!']);
        exit;
    }

    // Gửi email
    $to = 'kienbestdaxua@gmail.com'; // Địa chỉ email của bạn
    $subject = 'Liên hệ từ ' . $name . ' - ' . $different_email;
    $content = $message;

    $sendMail = sendMail($to, $subject, $content, $from = $different_email);
    if ($sendMail) {
        echo json_encode(['status' => 'success', 'message' => 'Chúng tôi đã nhận được tin nhắn. Cảm ơn bạn!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
}
