<?php
if (!defined('_CODE')) {
    die('Access denied');
}
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $p_id = $_POST['productId'];
    $user_id = getUserIdByToken();
    $comment_content = $_POST['danhgiacuaban'];
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
    $username = $_POST['tencuaban'];

    $commentData = [
        'p_id' => $p_id,
        'user_id' => $user_id,
        'comment_content' => $comment_content,
        'rating' => $rating,
        'user_name' => $username,
    ];

    if (insert('comments', $commentData)) {
        echo "Bình luận của bạn đã được thêm thành công!";
    } else {
        echo "Đã xảy ra lỗi khi thêm bình luận.";
    }
    redirect('?module=user&action=shop-detail&p_id=' . $p_id);
}
