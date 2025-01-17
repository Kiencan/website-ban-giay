<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['image_id'])) {
    $image_id = $filterAll['image_id'];
    $imageDetail = oneRaw("SELECT * FROM product_image WHERE image_id = $image_id");
    if (!empty($imageDetail)) {
        $imagePath = _WEB_PATH_TEMPLATE . 'image/' . $imageDetail['product_image'];
        $deleteImage = delete('product_image', "image_id = '$image_id'");
        if ($deleteImage) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
                setFlashData('smg', 'Xóa hỉnh ảnh thành công');
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

redirect('?module=admin&action=product_edit&p_id=' . $filterAll['p_id']);
