<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['id'])) {
    $orderId = $filterAll['id'];
    $orderDetail = oneRaw("SELECT * FROM orders WHERE payment_id = $orderId");
    if ($orderDetail > 0) {
        if ($orderDetail['order_status'] == 0) {
            $updateOrder['order_status'] = 1;
        } elseif ($orderDetail['order_status'] == 1) {
            $updateOrder['order_status'] = 2;
        } else {
            $updateOrder['order_status'] = 2;
        }
        $updateOrder = update('orders', $updateOrder, "payment_id = '$orderId'");
        if ($updateOrder) {
            setFlashData('smg', 'Xử lý đơn hàng thành công');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Đơn hàng không tồn tại');
        setFlashData('smg_types', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=order_item_management');
