<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['category_id'])) {
    $categoryId = $filterAll['category_id'];
    $categoryDetail = oneRaw("SELECT * FROM category WHERE category_id = $categoryId");
    if ($categoryDetail > 0) {
        $deletecategory = delete('category', "category_id = '$categoryId'");
        if ($deletecategory) {
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

redirect('?module=admin&action=category_management');
