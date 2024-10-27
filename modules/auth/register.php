<!-- Đăng ký tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Đăng ký tài khoản'];

layouts('header-login', $title);

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi

    // Kiểm tra username: bắt buộc phải nhập, nhập ít nhất 5 ký tự
    if (empty($filterAll['username'])) {
        $errors['username']['required'] = 'Vui lòng nhập username';
    } else {
        if (strlen($filterAll['username']) < 5) {
            $errors['username']['min'] = 'Username phải lớn hơn 5 ký tự';
        } else {
            $username = $filterAll['username'];
            $sql = "SELECT * FROM customer WHERE username = '$username'";
            if (getRows($sql) > 0) {
                $errors['username']['unique'] = 'Username đã đăng ký';
            }
        }
    }

    // Kiểm tra email: bắt buộc phải nhập email, đúng định dạng email, kiểm tra email đã tồn tại trong database chưa
    if (empty($filterAll['email'])) {
        $errors['email']['required'] = 'Vui lòng nhập email';
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT * FROM customer WHERE email = '$email'";
        if (getRows($sql) > 0) {
            $errors['email']['unique'] = 'Email đã đăng ký';
        }
    }

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
        $activeToken = sha1(uniqid() . time());
        $dataInsert = [
            'username' => $filterAll['username'],
            'email' => $filterAll['email'],
            // 'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'password' => $filterAll['password'],
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('customer', $dataInsert);
        if ($insertStatus) {
            // Tạo link kích hoạt
            $linkActive = _WEB_HOST . '?module=auth&action=active&token=' . $activeToken;

            // Thiết lập gửi email
            $subject = $filterAll['username'] . ' vui lòng kích hoạt tài khoản!';
            $content = 'Chào ' . $filterAll['username'] . '<br>';
            $content .= 'Vui lòng click vào link sau để kích hoạt tài khoản: <br>';
            $content .= $linkActive . '<br>';
            $content .= 'Cảm ơn bạn đã đăng ký tài khoản';

            // Tiến hành gửi email
            $senMail = sendMail($filterAll['email'], $subject, $content);
            if ($senMail) {
                setFlashData('smg', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản!');
                setFlashData('smg_types', 'success');
            } else {
                setFlashData('smg', 'Hệ thống đang gặp sự cố, vui lòng gửi lại sau!');
                setFlashData('smg_types', 'danger');
            }
        } else {
            setFlashData('smg', 'Đăng ký không thành công!');
            setFlashData('smg_types', 'danger');
        }
        redirect('?module=auth&action=register');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=auth&action=register');
    }
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<div
    class="login template d-flex justify-content-center align-items-center 100-w vh-100 bg-primary">
    <div class="form-container p-5 rounded bg-white">
        <h3>Sign up</h3>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_types);
        }
        ?>
        <form action="" method="post">
            <div class="mb-2">
                <label for="text">Username</label>
                <input class="form-control" type="text" placeholder="Enter username" name="username"
                    value="<?php echo old('username', $old) ?>" />
                <?php
                echo form_error('username', '<p class="text-danger">', '</p>', $errors);
                ?>
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input class="form-control" type="email" placeholder="Enter email" name="email"
                    value="<?php echo old('email', $old) ?>" />
                <?php
                echo form_error('email', '<p class="text-danger">', '</p>', $errors);
                ?>
            </div>
            <div class="mb-2">
                <label for="password">Password</label>
                <input class="form-control" type="password" placeholder="Enter password" name="password"
                    value="<?= old('password', $old) ?>" />
                <?php
                echo form_error('password', '<p class="text-danger">', '</p>', $errors);
                ?>
            </div>
            <div class="mb-2">
                <label for="password">Repeated password</label>
                <input class="form-control" type="password" placeholder="Repeated password" name="password_confirm"
                    value="<?= old('password_confirm', $old) ?>" />
                <?php
                echo form_error('password_confirm', '<p class="text-danger">', '</p>', $errors);
                ?>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Sign up</button>
            </div>
            <p class="text-end mt-2">
                Already registered?<a class="ms-2" href="?module=auth&action=login">Sign in</a>
            </p>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>