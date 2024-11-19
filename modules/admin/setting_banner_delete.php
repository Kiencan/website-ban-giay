<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['id'])) {
    $bannerId = $filterAll['id'];
    $bannerDetail = oneRaw("SELECT * FROM banner WHERE id = $bannerId");
    if (!empty($bannerDetail)) {
        $imagePath = _WEB_PATH_TEMPLATE . 'image/' . $bannerDetail['banner'];
        $deleteBanner = delete('banner', "id = '$bannerId'");
        if ($deleteBanner) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
                setFlashData('smg', 'Xóa banner thành công');
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

redirect('?module=admin&action=setting_banner');
