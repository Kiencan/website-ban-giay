<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$user_id = getUserIdByToken();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_id = $_POST['cart_id'] ?? null;

    if ($cart_id && $user_id) {
        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $result = delete('cart', "cart_id = '$cart_id'");
        $total = oneRaw("SELECT sum(total_price) FROM cart WHERE user_id = '$user_id'");
        $total = $total['sum(total_price)'];
        $total > 0 ? $ship_fee = 30000 : $ship_fee = 0;
        $grand_total = $total + $ship_fee;

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Xóa sản phẩm thành công.', 'total' => number_format($total, 0, ',', '.'), 'grand_total' => number_format($grand_total, 0, ',', '.'), 'ship_fee' => number_format($ship_fee, 0, ',', '.')]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể xóa sản phẩm khỏi giỏ hàng.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Phương thức không được hỗ trợ.']);
}
