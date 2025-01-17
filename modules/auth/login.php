<!-- Đăng nhập tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = ['pageTitle' => 'Đăng nhập tài khoản'];
layouts('header-login', $title);

// Kiểm tra trạng thái đăng nhập
if (isLogin()) {
    redirect('?module=user&action=trangchu');
}

if (isPost()) {
    $filterAll = filter();
    if (!empty(trim($filterAll['username'])) && !empty(trim($filterAll['password']))) {
        // kiểm tra đăng nhập
        $username = $filterAll['username'];
        $password = $filterAll['password'];
        // truy vấn lấy thông tin users theo email
        $userQuery = oneRaw("SELECT password, user_id, isAdmin FROM user WHERE username = '$username'");
        if (!empty($userQuery)) {
            $passwordHash = $userQuery['password'];
            $userId = $userQuery['user_id'];
            // if (password_verify($password, $passwordHash)) {
            if ($password == $passwordHash) {

                // Kiểm tra xem tài khoản đã login chưa
                $userLogin = oneRaw("SELECT * FROM token_login WHERE user_id = $userId");
                if ($userLogin > 0) {
                    setFlashData('smg', 'Tài khoản đang đăng nhập ở nơi khác');
                    setFlashData('smg_types', 'danger');
                    redirect('?module=auth&action=login');
                } else {
                    // Tạo token login
                    $tokenLogin = sha1(uniqid() . time());

                    // Insert vào bảng loginToken
                    $dataInsert = [
                        'user_id' => $userId,
                        'token' => $tokenLogin,
                        'create_at' => date('Y-m-d H:i:sa')
                    ];

                    $insertStatus = insert('token_login', $dataInsert);
                    if ($insertStatus) {
                        // Insert thành công, lưu loginToken vào session
                        setSession('token_login', $tokenLogin);
                        redirect('?module=user&action=trangchu');
                    } else {
                        setFlashData('smg', 'Không thể đăng nhập vui lòng thử lại sau.');
                        setFlashData('smg_types', 'danger');
                    }
                }
            } else {
                setFlashData('smg', 'Sai mật khẩu hoặc tên đăng nhập không tồn tại.');
                setFlashData('smg_types', 'danger');
            }
        }
    } else {
        setFlashData('smg', 'Vui lòng nhập tên đăng nhập và mật khẩu');
        setFlashData('smg_types', 'danger');
    }
    redirect('?module=auth&action=login');
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');

?>

<div
    class="login template d-flex justify-content-center align-items-center 100-w vh-100 bg-primary">
    <div class="form-container p-5 rounded bg-white">
        <h3>Sign in</h3>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_types);
        }
        ?>
        <form action="" method="post">
            <div class="form-group mb-2">
                <label for="">Username</label>
                <input class="form-control" type="text" placeholder="Enter username" name="username"
                    value="" />

            </div>
            <div class="form-group mb-2">
                <label for="">Password</label>
                <input class="form-control" type="password" placeholder="Enter password" name="password" />
            </div>
            <div class="input-group mb-2 d-flex justify-content-between">
                <div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="formCheck" /><label class="form-check-label text-secondary" for="formCheck"><small>Remeber Me</small></label>
                    </div>
                </div>
                <div class="forgot">
                    <small><a href="?module=auth&action=forgot">Forgot password?</a></small>
                </div>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary" type="submit">Sign in</button>
            </div>
            <p class="mt-2">
                Don't have an account?<a class="ms-2" href="?module=auth&action=register">Sign up</a>
            </p>
            <p class="mt-2">
                Are you admin?<a class="ms-2" href="?module=auth&action=admin_login">Sign in as admin</a>
            </p>
        </form>
    </div>
</div>


<?php
layouts('footer-login');
?>