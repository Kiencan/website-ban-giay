<?php
if (!defined('_CODE')) {
    die('Access denied');
}

// $filterAll = filter();

// if (!empty($filterAll['cart_id'])) {
//     $cartId = $filterAll['cart_id'];
//     $carttDetail = oneRaw("SELECT * FROM cart WHERE cart_id = $cartId");
//     if (!empty($carttDetail)) {
//         $deleteOrder = delete('cart', "cart_id = '$cartId'");
//         if ($deleteOrder) {
//             echo 'success';
//         } else {
//             echo 'error';
//         }
//     }
// } else {
//     echo 'error';
// }

// redirect('?module=user&action=cart&id=' . $filterAll["id"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if ($cart_id && $user_id) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $result = delete('cart', "cart_id = '$cart_id'");

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Xóa sản phẩm thành công.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể xóa sản phẩm khỏi giỏ hàng.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không được hỗ trợ.']);
}
