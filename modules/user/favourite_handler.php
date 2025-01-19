<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$userId = getUserIdByToken();

if (isset($_POST['product_id'])) {
    $p_id = $_POST['product_id'];
    $fav = oneRaw("SELECT * FROM favourite WHERE user_id = '$userId' AND p_id = '$p_id'");
    if ($fav) {
        delete('favourite', "user_id = '$userId' AND p_id = '$p_id'");
        echo json_encode(['status' => 'removed', 'message' => 'Xoa thanh cong.']);
    } else {
        $data = [
            'user_id' => $userId,
            'p_id' => $_POST['product_id'],
            'favourite' => 1,
        ];
        $updateFavourite = insert('favourite', $data);
        if ($updateFavourite) {
            echo json_encode(['status' => 'success', 'message' => 'Cập nhật số lượng sản phẩm thành công.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Không thể cập nhật số lượng sản phẩm.']);
        }
    }
}
