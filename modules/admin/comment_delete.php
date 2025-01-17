<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$filterAll = filter();

if (!empty($filterAll['id'])) {
    $commentId = $filterAll['id'];
    $commentDetail = oneRaw("SELECT * FROM comment WHERE comment_id = $commentId");
    if ($commentDetail > 0) {
        $deleteComment = delete('comment', "comment_id = '$commentId'");
        if ($deleteComment) {
            setFlashData('smg', 'Xóa bình luận thành công');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Lỗi hệ thống');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Bình luận không tồn tại');
        setFlashData('smg_types', 'danger');
    }
} else {
    setFlashData('smg', 'Liên kết không tồn tại');
    setFlashData('smg_types', 'danger');
}

redirect('?module=admin&action=comment_management');
