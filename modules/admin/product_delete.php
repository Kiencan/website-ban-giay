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
    $imgDetail = getRaw("SELECT * FROM product_image WHERE p_id = '$p_id'");
    $cartDetail = getRaw("SELECT * FROM cart WHERE p_id = '$p_id'");
    if (!empty($productDetail)) {
        foreach ($imgDetail as $key => $value) {
            $deleteImg = delete('product_image', "image_id = '" . $value['image_id'] . "'");
            unlink(_WEB_PATH_TEMPLATE . "image/" . $value['product_image']);
        }
        $deleteCart = delete('cart', "p_id = '$p_id'");
        if ($deleteCart) {
            $deleteProduct = delete('products', "p_id = '$p_id'");
            if ($deleteProduct) {
                setFlashData('smg', 'Xóa sản phẩm thành công');
                setFlashData('smg_types', 'success');
            } else {
                setFlashData('smg', 'Lỗi hệ thống');
                setFlashData('smg_types', 'danger');
            }
        }
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=product_management');
