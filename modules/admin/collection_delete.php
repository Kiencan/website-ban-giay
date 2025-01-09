<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['collection_id'])) {
    $collectionId = $filterAll['collection_id'];
    $collectionDetail = oneRaw("SELECT * FROM collection WHERE collection_id = $collectionId");
    if ($collectionDetail > 0) {
        $productNameDetail = getRaw("SELECT * FROM product_name WHERE collection_id = $collectionId");
        if ($productNameDetail > 0) {
            $productsDetail = getRaw("SELECT * FROM product WHERE collection_id = $collectionId");
        }
        $deletecollection = delete('collection', "collection_id = '$collectionId'");
        if ($deletecollection) {
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
