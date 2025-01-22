<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang đổi mật khẩu'
];
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
# Lấy userId
$user_id = getUserIdByToken();


if (!empty($user_id)) {
    $userDetail = oneRaw("SELECT * FROM user WHERE user_id = $user_id");
    // echo '<pre>';
    // print_r($userDetail);
    // echo '</pre>';
    if (!empty($userDetail)) {
        // Tồn tại
        setFlashData('user-detail', $userDetail);
    } else {
        redirect('?module=user&action=profile');
    }
}

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi
    if (empty($filterAll['password'])) {
        $errors['password']['required'] = 'Vui lòng nhập lại password';
    } else {
        if ($filterAll['password'] != $userDetail['password']) {
            $errors['password']['match'] = 'Mật khẩu cũ không đúng. Vui lòng nhập lại';
        }
    }

    // Kiểm tra password: Bắt buộc phải nhập, ít nhất 8 ký tự
    if (empty($filterAll['new_password'])) {
        $errors['new_password']['required'] = 'Vui lòng nhập password';
    } else {
        if (strlen($filterAll['new_password']) < 8) {
            $errors['new_password']['min'] = 'Password phải ít nhất 8 ký tự';
        }
    }

    // Kiểm tra password confirm: Bắt buộc phải nhập, giống với password
    if (empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Vui lòng nhập lại password';
    } else {
        if ($filterAll['new_password'] != $filterAll['password_confirm']) {
            $errors['password_confirm']['match'] = 'Password nhập lại không đúng';
        }
    }

    if (empty($errors)) {

        $dataUpdate = [
            'password' => $filterAll['new_password'],
        ];

        $updateStatus = update('user', $dataUpdate, "user_id = '$user_id'");
        if ($updateStatus) {
            setFlashData('smg', 'Cập nhật mật khẩu thành công!');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
    }
    redirect('?module=user&action=change_password');
}
$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail = getFlashData('user-detail');
if (!empty($userDetail)) {
    $old = $userDetail;
}

layouts('header', $title);

?>
<div class="container emp-profile">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md">
                <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row mt-3">
                            <?php
                            if (!empty($smg)) {
                                getSmg($smg, $smg_types);
                            }
                            ?>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Mật khẩu cũ</label>
                                <input class="form-control" type="password" placeholder="Password" name="password" />
                                <?php
                                echo form_error('password', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Mật khẩu mới</label>
                                <input class="form-control" type="password" placeholder="Mật khẩu mới" name="new_password" />
                                <?php
                                echo form_error('new_password', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Xác nhận mật khẩu</label>
                                <input class="form-control" type="password" placeholder="Xác nhận mật khẩu" name="password_confirm" />
                                <?php
                                echo form_error('password_confirm', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Xác nhận</button>
                <a href="?module=user&action=profile" class="btn btn-primary mt-3" type="button">Quay lại</a>
            </div>
        </div>
    </form>
</div>

<?php
layouts('footer');
?>