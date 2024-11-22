<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['size_id'])) {
    $size_id = $filterAll['size_id'];
    $sizeDetail = oneRaw("SELECT * FROM product_size WHERE size_id = $size_id");
    if (!empty($sizeDetail)) {
        $deleteSize = delete('product_size', "size_id = '$size_id'");
        if ($deleteSize) {
            setFlashData('smg', 'Xóa sản phẩm thành công');
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

redirect('?module=admin&action=product_edit&p_id=' . $filterAll['p_id']);
