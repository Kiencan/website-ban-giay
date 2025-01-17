<!-- Đăng ký tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm người dùng'];

layouts('header-login', $title);

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi\

    // Kiểm tra họ và tên: bắt buộc phải nhập, nhập ít nhất 5 ký tự
    if (empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Vui lòng nhập họ và tên';
    } else {
        if (strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min'] = 'Vui lòng nhập đầy đủ họ và tên!';
        }
    }

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
    if (empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Vui lòng nhập số điện thoại';
    } else {
        if (!isPhone($filterAll['phone'])) {
            $errors['phone']['isPhone'] = 'Số điện thoại không hợp lệ';
        }
    }

    if (empty($errors)) {
        $dataInsert = [
            'username' => $filterAll['username'],
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            // 'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'password' => $filterAll['password'],
            'status' => $filterAll['status'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('customer', $dataInsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm người dùng thành công!');
            setFlashData('smg_types', 'success');
            redirect('?module=management&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
            redirect('?module=management&action=add');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=management&action=add');
    }
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<div class="container">
    <div class="row" style="margin: 50px auto">
        <h3 class="text-center text-uppercase">Thêm người dùng</h3>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_types);
        }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="">Họ và tên</label>
                        <input class="form-control" type="fullname" placeholder="Họ và tên" name="fullname"
                            value="<?php echo old('fullname', $old) ?>" />
                        <?php
                        echo form_error('fullname', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Tên đăng nhập</label>
                        <input class="form-control" type="username" placeholder="Username" name="username"
                            value="<?php echo old('username', $old) ?>" />
                        <?php
                        echo form_error('username', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="">Email</label>
                        <input class="form-control" type="email" placeholder="Email" name="email"
                            value="<?php echo old('email', $old) ?>" />
                        <?php
                        echo form_error('email', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" placeholder="Password" name="password"
                            value="<?= old('password', $old) ?>" />
                        <?php
                        echo form_error('password', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="phone">Số điện thoại</label>
                        <input class="form-control" type="phone" placeholder="Số điện thoại" name="phone"
                            value="<?= old('phone', $old) ?>" />
                        <?php
                        echo form_error('phone', '<p class="text-danger">', '</p>', $errors);
                        ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for=""> Trạng thái
                        </label>
                        <select class="form-control" name="status">
                            <option value=0 <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                            <option value=1 <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã kích hoạt</option>
                        </select>
                    </div>
                </div>
            </div>
    </div>

    <button class="btn btn-primary" type="submit" style="width: 15%">Thêm người dùng</button>
    <a href="?module=management&action=list" class="btn btn-success" type="submit" style="width: 15%">Quay lại</a>
    </form>
</div>
</div>

<?php
layouts('footer-login');
?>