<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$userId = getUserIdByToken();

if (isset($_POST['p_quantity'])) {
    $ship_fee = 30000;
    $p_quantity = $_POST['p_quantity'];
    $cart_id = $_POST['cart_id'];
    $p_price_min = $_POST['p_price_min'];
    $p_price_max = $_POST['p_price_max'];
    $total_price = $p_price_min * $p_quantity;

    $updateQuantity = update('cart', ['p_quantity' => $p_quantity, 'total_price' => $total_price], "cart_id = '$cart_id'");
    $total = oneRaw("SELECT sum(total_price) FROM cart WHERE user_id = '$userId'");
    $grand_total = $total['sum(total_price)'] + $ship_fee;

    if ($updateQuantity) {
        echo json_encode(['status' => 'exists', 'total_price' => $total_price, 'total' => number_format($total['sum(total_price)'], 0, ',', '.'), 'grand_total' => number_format($grand_total, 0, ',', '.')]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật số lượng sản phẩm.']);
    }
}
