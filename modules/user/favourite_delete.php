<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$user_id = getUserIdByToken();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id'] ?? null;

    if ($p_id && $user_id) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $result = delete('favourite', "user_id = '$user_id' AND p_id = '$p_id'");

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Đã xóa sản khỏi mục yêu thích']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể xóa sản phẩm']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không được hỗ trợ.']);
}
