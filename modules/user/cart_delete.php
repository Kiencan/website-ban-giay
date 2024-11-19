<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['order_id'])) {
    $orderId = $filterAll['order_id'];
    $ordertDetail = oneRaw("SELECT * FROM order_item WHERE order_id = $orderId");
    if (!empty($ordertDetail)) {
        $deleteOrder = delete('order_item', "order_id = '$orderId'");
        if ($deleteOrder) {
            setFlashData('smg', 'Xóa đơn hàng thành công');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống');
            setFlashData('smg_types', 'danger');
        }
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=user&action=cart&id=' . $filterAll["id"]);
