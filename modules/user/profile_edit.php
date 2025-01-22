<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang cập nhật thông tin'
];
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
# Lấy userId
$user_id = getUserIdByToken();

// $user_if = oneRaw("SELECT * FROM user WHERE user_id = '$user_id'");


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

    if (!empty($_FILES['avatar']['name'])) {
        // Get file information
        $imageName = $_FILES['avatar']['name'];
        $imageSize = $_FILES['avatar']['size'];
        $imageTemp = $_FILES['avatar']['tmp_name'];
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Set target directory
        $targetDir = _WEB_PATH_TEMPLATE . 'image/';
        $targetFilePath = $targetDir . $imageName;

        // Validate file type
        if (!in_array($fileExtension, $allowedTypes)) {
            $errors['avatar']['type'] = 'Chỉ chấp nhận các định dạng ảnh: JPG, JPEG, PNG, GIF.';
        }

        // Validate file size (e.g., 5MB maximum)
        if ($imageSize > 5 * 1024 * 1024) {
            $errors['avatar']['size'] = 'Dung lượng ảnh không được vượt quá 5MB.';
        }

        // Check if file already exists
        if (file_exists($targetFilePath)) {
            $errors['avatar']['exists'] = 'File này đã tồn tại. Vui lòng chọn một ảnh khác hoặc đổi tên file.';
        }
    }

    if (empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Vui lòng nhập họ và tên';
    } else {
        if (strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min'] = 'Vui lòng nhập đầy đủ họ và tên!';
        }
    }


    // Kiểm tra email: bắt buộc phải nhập email, đúng định dạng email, kiểm tra email đã tồn tại trong database chưa
    if (empty($filterAll['email'])) {
        $errors['email']['required'] = 'Vui lòng nhập email';
    }

    if (empty($filterAll['address'])) {
        $errors['address']['required'] = 'Vui lòng nhập đúng địa chỉ nhận hàng';
    }

    // Kiểm tra password confirm: Bắt buộc phải nhập, giống với password
    if (empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Vui lòng nhập số điện thoại';
    } else {
        if (!isPhone($filterAll['phone'])) {
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ';
        }
    }

    if (empty($errors)) {
        $imageName = $_FILES['avatar']['name'];
        $targetFilePath = $targetDir . basename($imageName);

        $dataUpdate = [
            'username' => $filterAll['username'],
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
        ];
        if (!empty($imageName)) {
            $dataUpdate['avatar'] = $imageName;
        }

        // echo '<pre>';
        // print_r($dataUpdate);
        // echo '</pre>';
        $updateStatus = update('user', $dataUpdate, "user_id = '$user_id'");
        if ($updateStatus) {
            if (!empty($imageName)) {
                if (move_uploaded_file($imageTemp, $targetFilePath)) {
                    if (!empty($userDetail['avatar'])) {
                        unlink(_WEB_PATH_TEMPLATE . 'image/' . $userDetail['avatar']);
                        setFlashData('smg', 'Chỉnh sửa thông tin người dùng thành công!');
                        setFlashData('smg_types', 'success');
                    }
                } else {
                    setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
                    setFlashData('smg_types', 'danger');
                }
            } else {
                setFlashData('smg', 'Chnh sửa thông tin người dùng thành công!');
                setFlashData('smg_types', 'success');
            }
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
    redirect('?module=user&action=profile_edit');
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
                            <div class="col-md">
                                <label>Avatar</label>
                                <input id="productImage" class="form-control" type="file" name="avatar" accept="image/*" onchange="previewImage(event)" />
                                <?php if (!empty(old('avatar', $old))) : ?>
                                    <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . old('avatar', $old) ?>" alt="" style="width: 100px; height: 100px" />
                                <?php else: ?>
                                    <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/avatar.jpg" ?>" alt="" style="width: 100px; height: 100px" />
                                <?php endif;
                                echo form_error('avatar', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Họ và tên</label>
                                <input type="text" name="fullname" class="form-control" value="<?php echo old('fullname', $old); ?>">
                                <?php
                                echo form_error('fullname', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo old('email', $old); ?>">
                                <?php
                                echo form_error('email', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="<?php echo old('phone', $old); ?>">
                                <?php
                                echo form_error('phone', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="<?php echo old('address', $old); ?>">
                                <?php
                                echo form_error('address', '<p class="text-danger">', '</p>', $errors);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Cập nhật</button>
                <a href="?module=user&action=profile" class="btn btn-primary mt-3" type="button">Quay lại</a>
            </div>
        </div>
    </form>
</div>

<?php
layouts('footer');
?>