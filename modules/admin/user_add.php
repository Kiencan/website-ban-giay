<!-- Đăng ký tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm người dùng'];

layouts('header-admin', $title);

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
            'admin' => $filterAll['admin'],
            'create_at' => date('Y-m-d H:i:s')
        ];
        $insertStatus = insert('customer', $dataInsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm người dùng thành công!');
            setFlashData('smg_types', 'success');
            redirect('?module=admin&action=user_management');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
            redirect('?module=admin&action=user_add');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=admin&action=user_add');
    }
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<body>
    <div class="header-color sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left text-light fs-4 me-5" id="menu-toggle"></i>
                <a href="?module=user&action=trangchu"><img src="<?php echo _WEB_HOST_TEMPLATE; ?>/image/logo.jpg" width="100px"></a>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light fw-bold" href="#" id="navbarDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-2"></i>Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?module=admin&action=setting">Cấu hình</a></li>
                            <li><a class="dropdown-item" href="?module=auth&action=logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">

            <div class="list-group list-group-flush fw-bold">
                <form class="d-flex p-1 border-bottom border-light my-3">
                    <div class="input-group">
                        <input class="form-control form-control-sm" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-white px-4" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
                <a
                    href="?module=admin"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a
                    href="?module=admin&action=user_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fa-regular fa-user me-2"></i>Quản lý thành viên</a>
                <a
                    href="?module=admin&action=category_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fas fa-chart-line me-2"></i>Quản lý danh mục</a>
                <a
                    href="?module=admin&action=product_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-solid fa-bag-shopping me-2"></i>Quản lý sản phẩm</a>
                <a
                    href="?module=admin&action=order_item_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-regular fa-newspaper me-2"></i>Quản lý đơn hàng</a>
                <a
                    href="?module=admin&action=comment_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fas fa-comment-dots me-2"></i>Quản lý bình luận</a>
                <a
                    href="?module=admin&action=setting"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-solid fa-gear me-2"></i>Cấu hình</a>
                <a
                    href="?module=auth&action=logout"
                    class="list-group-item list-group-item-action px-4 py-3 text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 pt-3 border">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="?module=admin" style="text-decoration: none"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="?module=admin&action=user_management" style="text-decoration: none">Quản lý thành viên</a></li>
                    <li class="breadcrumb-item active"> Thêm thành viên </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm thành viên</h1>
            </div>

            <div class="container-fluid px-4">
                <div class="row" style="margin: 50px auto">
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
                                <div class="form-group mg-form">
                                    <label for=""> Quyền
                                    </label>
                                    <select class="form-control" name="admin">
                                        <option value=0 <?php echo (old('admin', $old) == 0) ? 'selected' : false; ?>>Customer</option>
                                        <option value=1 <?php echo (old('admin', $old) == 1) ? 'selected' : false; ?>>Admin</option>
                                    </select>
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
                <div class="row d-grid gap-2 justify-content-center">
                    <button class="btn btn-primary" type="submit">Thêm người dùng</button>
                    <a href="?module=admin&action=user_management" class="btn btn-success" type="button">Quay lại</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
</body>


<?php
layouts('footer-admin');
?>