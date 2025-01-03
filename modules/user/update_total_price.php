<?php
if (!defined('_CODE')) {
    die('Access denied');
}

if (isset($_POST['p_quantity'])) {
    $p_quantity = $_POST['p_quantity'];
    $cart_id = $_POST['cart_id'];
    $p_price_min = $_POST['p_price_min'];
    $p_price_max = $_POST['p_price_max'];
    $total_price = $p_price_min * $p_quantity;

    $updateQuantity = update('cart', ['p_quantity' => $p_quantity, 'total_price' => $total_price], "cart_id = '$cart_id'");

    if ($updateQuantity) {
        echo json_encode(['total_price' => $total_price]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật số lượng sản phẩm.']);
    }
}
