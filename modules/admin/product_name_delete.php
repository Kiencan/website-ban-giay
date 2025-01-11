<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['p_name_id'])) {
    $p_name_id = $filterAll['p_name_id'];
    $prodNameDetail = oneRaw("SELECT * FROM product_name WHERE p_name_id = $p_name_id");

    if (!empty($prodNameDetail)) {
        $products = getRaw("SELECT * FROM products WHERE p_name_id = '" . $prodNameDetail['p_name_id'] . "'");
        foreach ($products as $key => $value) {
            $product_image = getRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
            foreach ($product_image as $key => $value) {
                $deleteProduct_image = delete('product_image', "image_id = '" . $value['image_id'] . "'");
                unlink(_WEB_PATH_TEMPLATE . "image/" . $value['product_image']);
            }
            $deleteCart = delete('cart', "p_id = '" . $value['p_id'] . "'");
            $deleteProduct = delete('products', "p_id = '" . $value['p_id'] . "'");
        }
        $deleteProduct_name = delete('product_name', "p_name_id = '$p_name_id'");
        if ($deleteProduct_name) {
            setFlashData('smg', 'Xóa danh mục thành công');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Danh mục không tồn tại');
        setFlashData('smg_types', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=collection_management');
