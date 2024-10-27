<!-- Reset mật khẩu -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = ['pageTitle' => 'Khôi phương mật khẩu'];
layouts('header-login', $title);

$token = filter()['token'];
if (!empty($token)) {
    // Truy vấn database kiểm tra token
    $tokenQuery = oneRaw("SELECT id, username, email FROM customer WHERE forgotToken = '$token'");
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];
        if (isPost()) {
            $filterAll = filter();
            $errors = []; // mảng chứa lỗi
            echo $token;

            // Kiểm tra password: Bắt buộc phải nhập, ít nhất 8 ký tự
            if (empty($filterAll['password'])) {
                $errors['password']['required'] = 'Vui lòng nhập password';
            } else {
                if (strlen($filterAll['password']) < 8) {
                    $errors['password']['min'] = 'Password phải ít nhất 8 ký tự';
                }
            }

            // Kiểm tra password confirm: Bắt buộc phải nhập, giống với password
            if (empty($filterAll['password_confirm'])) {
                $errors['password_confirm']['required'] = 'Vui lòng nhập lại password';
            } else {
                if ($filterAll['password'] != $filterAll['password_confirm']) {
                    $errors['password_confirm']['match'] = 'Password nhập lại không đúng';
                }
            }


            if (empty($errors)) {
                // Xử lý update mật khẩu
                // Mã hóa mật khẩu (optional)
                // $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $filterAll['password'],
                    'forgotToken' => null,
                    'update_at' => date('Y-m-d H:i:s')
                ];
                $updateStatus = update('customer', $dataUpdate, "id = '$userId'");
                if ($updateStatus) {
                    setFlashData('smg', 'Thay đổi mật khẩu thành công');
                    setFlashData('smg_types', 'success');
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('smg', 'Lỗi hệ thống vui lòng thử lại sau!');
                    setFlashData('smg_types', 'danger');
                }
            } else {
                setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
                setFlashData('smg_types', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token=' . $token);
            }
        }
        $smg = getFlashData('smg');
        $smg_types = getFlashData('smg_types');
        $errors = getFlashData('errors');
?>
        <!-- form reset password -->
        <div
            class="login template d-flex justify-content-center align-items-center 100-w vh-100 bg-primary">
            <div class="form-container p-5 rounded bg-white">
                <h3>Reset password</h3>
                <?php
                if (!empty($smg)) {
                    getSmg($smg, $smg_types);
                }
                ?>
                <form action="" method="post">
                    <div class="mb-2">
                        <label for="password">New password</label>
                        <input class="form-control" type="password" placeholder="Password" name="password" />
                        <?php
                        echo form_error('password', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="mb-2">
                        <label for="password">Confirm password</label>
                        <input class="form-control" type="password" placeholder="Repeated password" name="password_confirm" />
                        <?php
                        echo form_error('password_confirm', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        <button class="btn btn-primary" type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    } else {
        getSmg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
        echo 'trong';
    }
} else {
    getSmg('Liên kết không tồn tại hoặc đã hết hạn', 'danger');
    echo 'ngoài';
}

layouts('footer-login');
?>