<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();
// echo '<pre>';
// print_r($filterAll);
// echo '</pre>';

if (!empty($filterAll['p_id'])) {
    $p_id = $filterAll['p_id'];
    $productDetail = oneRaw("SELECT * FROM products WHERE p_id = '$p_id'");
    $sizeDetail = getRaw("SELECT * FROM product_size WHERE product_id = '$p_id'");
    if (!empty($productDetail && $sizeDetail)) {
        $deleteSize = delete('product_size', "product_id = '$p_id'");
        if ($deleteSize) {
            $deleteProduct = delete('products', "p_id = '$p_id'");
            if ($deleteProduct) {
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
