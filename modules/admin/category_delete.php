<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['category_id'])) {
    $categoryId = $filterAll['category_id'];
    $categoryDetail = oneRaw("SELECT * FROM category WHERE category_id = $categoryId");
    if (!empty($categoryDetail)) {
        $collectionDetail = getRaw("SELECT * FROM collection WHERE category_id = $categoryId");
        if (!empty($collectionDetail)) {
            foreach ($collectionDetail as $key => $value) {
                $productNameDetail = getRaw("SELECT * FROM product_name WHERE collection_id = " . $value['collection_id']);
                if (!empty($productNameDetail)) {
                    foreach ($productNameDetail as $key => $value) {
                        $productDetail = getRaw("SELECT * FROM products WHERE p_name_id = " . $value['p_name_id']);
                        if (!empty($productDetail)) {
                            foreach ($productDetail as $key => $value) {
                                $productImageDetail = getRaw("SELECT * FROM product_image WHERE p_id = " . $value['p_id']);
                                if (!empty($productImageDetail)) {
                                    unlink(_WEB_PATH_TEMPLATE . "image/" . $value['product_image']);
                                }
                            }
                            $deleteCart = delete('cart', "p_id = '" . $value['p_id'] . "'");
                            foreach ($productImageDetail as $key => $value) {
                                $deleteProduct_image = delete('product_image', "image_id = '" . $value['image_id'] . "'");
                                $deleteProduct = delete('products', "p_id = '" . $value['p_id'] . "'");
                            }
                        }
                    }
                }
                $deleteProduct_name = delete('product_name', "collection_id = " . $value['collection_id']);
            }
        }
        $deletecollection = delete('collection', "category_id = '$categoryId'");
    }

    $deletecategory = delete('category', "category_id = '$categoryId'");
    if ($deletecategory) {
        setFlashData('smg', 'Xóa danh mục thành công');
        setFlashData('smg_types', 'success');
    } else {
        setFlashData('smg', 'Lỗi hệ thống');
        setFlashData('smg_types', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=category_management');
