<?php

if (!defined('_CODE')) {
    die('Access denied');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $p_id = $_POST['p_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;
    $p_price_min = $_POST['p_price_min'] ?? null;
    $p_size = $_POST['p_size'] ?? null;
    $p_quantity = $_POST['p_quantity'] ?? null;

    if ($p_quantity < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Số lượng không hợp lệ.']);
    }

    if ($p_id && $user_id) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $checkCart = getRaw("SELECT * FROM cart WHERE user_id = '$user_id' AND p_id = '$p_id' AND p_size = '$p_size'");

        if ($checkCart) {
            echo json_encode(['status' => 'exists', 'message' => 'Sản phẩm đã có trong giỏ hàng.']);
        } else {
            // Thêm sản phẩm vào giỏ hàng
            $data = [
                'user_id' => $user_id,
                'p_id' => $p_id,
                'p_quantity' => $p_quantity,
                'total_price' => $p_price_min * $p_quantity,
                'p_size' => $p_size,
            ];

            $insert = insert('cart', $data);
            if ($insert) {
                echo json_encode(['status' => 'added', 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Không thể thêm sản phẩm vào giỏ hàng.']);
            }
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không được hỗ trợ.']);
}
