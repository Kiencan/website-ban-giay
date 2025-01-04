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

$user_id = getUserIdByToken();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'] ?? null;

    if ($cart_id && $user_id) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $result = delete('cart', "cart_id = '$cart_id'");
        $total = oneRaw("SELECT sum(total_price) FROM cart WHERE user_id = '$user_id'");
        $total = $total['sum(total_price)'];
        $grand_total = $total + 30000;

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Xóa sản phẩm thành công.', 'total' => number_format($total, 0, ',', '.'), 'grand_total' => number_format($grand_total, 0, ',', '.')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể xóa sản phẩm khỏi giỏ hàng.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không được hỗ trợ.']);
}
