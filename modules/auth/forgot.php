<!-- Đăng nhập tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = ['pageTitle' => 'Quên mật khẩu'];
layouts('header-login', $title);

// Kiểm tra trạng thái đăng nhập
if (isLogin()) {
    redirect('?module=user&action=trangchu');
}

if (isPost()) {
    $filterAll = filter();
    if (!empty($filterAll['Email'])) {
        $email = $filterAll['Email'];
        echo $email;

        $queryUser = oneRaw("SELECT user_id FROM user WHERE email = '$email'");
        if (!empty($queryUser)) {
            $userId = $queryUser['user_id'];
            $forgotToken = sha1(uniqid() . time());

            $dataUpdate = [
                'forgotToken' => $forgotToken
            ];

            $updateStatus = update('user', $dataUpdate, "user_id=$userId");
            if ($updateStatus) {
                // Tạo link khôi phục mật khẩu
                $linkForgot = _WEB_HOST . '?module=auth&action=reset&token=' . $forgotToken;
                // Gửi email
                $subject = 'Yêu cầu khôi phục mật khẩu.';
                $content = 'Chào bạn, chúng tôi vừa nhận được yêu cầu đổi mật khẩu. <br>';
                $content .= 'Vui lòng click vào link sau để khôi phục mật khẩu: <br>';
                $content .= $linkForgot . '<br>';
                $content .= 'Trân trọng cảm ơn';

                $sendMail = sendMail($email, $subject, $content);
                if ($sendMail) {
                    setFlashData('smg', 'Vui lòng kiểm tra email xem hướng dẫn để khôi phục mật khẩu!');
                    setFlashData('smg_types', 'success');
                } else {
                    setFlashData('smg', 'Hệ thống đang gặp sự cố, vui này gửi lại sau!');
                    setFlashData('smg_types', 'danger');
                }
            }
        } else {
            setFlashData('smg', 'Email này chưa được đăng ký!');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng nhập địa chỉ email!');
        setFlashData('smg_types', 'danger');
    }
    redirect('?module=auth&action=forgot');
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');

?>

<div
    class="login template d-flex justify-content-center align-items-center 100-w vh-100 bg-primary">
    <div class="form-container p-5 rounded bg-white">
        <h2>Quên mật khẩu</h2>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_types);
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="" class="mb-3">Nhập tài khoản email đăng ký</label>
                <input class="form-control mb-3" type="email" placeholder="Enter your email" name="Email"
                    value="" />
            </div>

            <div class="d-grid mt-2">
                <button class="btn btn-primary" type="submit">Gửi</button>
            </div>
        </form>
    </div>
</div>


<?php
layouts('footer-login');
?>