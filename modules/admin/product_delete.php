<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['p_id'])) {
    $p_id = $filterAll['p_id'];
    $productDetail = oneRaw("SELECT * FROM products WHERE p_id = $p_id");
    if (!empty($productDetail)) {
        $imagePath = _WEB_PATH_TEMPLATE . 'image/giay1/' . $productDetail['p_image'];
        $deletePrododuct = delete('products', "p_id = '$p_id'");
        if ($deletePrododuct) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
                setFlashData('smg', 'Xóa sản phẩm thành công');
                setFlashData('smg_types', 'success');
            } else {
                setFlashData('smg', 'Lỗi hệ thống');
                setFlashData('smg_types', 'danger');
            }
        } else {
            setFlashData('smg', 'Lỗi hệ thống');
            setFlashData('smg_types', 'danger');
        }
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=product_management');
