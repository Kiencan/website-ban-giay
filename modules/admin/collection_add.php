<!-- Đăng ký tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm bộ sưu tập'];

layouts('header-admin', $title);

// Kiểm tra trạng thái admin
if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi\

    // Kiểm tra họ và tên: bắt buộc phải nhập, nhập ít nhất 5 ký tự
    if (empty($filterAll['collection_name'])) {
        $errors['collection_name']['required'] = 'Vui lòng nhập tên bộ sưu tập';
    } else {
        $collection_name = $filterAll['collection_name'];
        $category_id = $filterAll['category_id'];
        $sql = "SELECT * FROM collection WHERE collection_name = '$collection_name' AND category_id = '$category_id'";
        if (getRows($sql) > 0) {
            $errors['collection_name']['unique'] = 'Bộ sưu tập đã tồn tại';
        }
    }


    if (empty($errors)) {
        $dataInsert = [
            'collection_name' => $filterAll['collection_name'],
            'category_id' => $filterAll['category_id'],
        ];
        $insertStatus = insert('collection', $dataInsert);
        if ($insertStatus) {
            setFlashData('smg', 'Thêm bộ sưu tập thành công!');
            setFlashData('smg_types', 'success');
            redirect('?module=admin&action=collection_management');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
            redirect('?module=admin&action=collection_add');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=admin&action=collection_add');
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

            <div class="collapse navbar-collapse me-5" id="navbarSupportedContent">
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
                <a
                    href="?module=admin&action=dashboard"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
                <a
                    href="?module=admin&action=user_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-regular fa-user me-2"></i>Quản lý thành viên</a>
                <a
                    href="?module=admin&action=category_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fas fa-chart-line me-2"></i>Quản lý danh mục</a>
                <a
                    href="?module=admin&action=collection_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fas fa-chart-line me-2"></i>Quản lý bộ sưu tập</a>
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
                    <li class="breadcrumb-item"><a href="?module=admin&action=dashboard" style="text-decoration: none"><i class="fa-solid fa-house"></i></a></li>
                    <li class="breadcrumb-item"><a href="?module=admin&action=user_management" style="text-decoration: none">Quản lý bộ sưu tập</a></li>
                    <li class="breadcrumb-item active"> Thêm bộ sưu tập </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm bộ sưu tập</h1>
            </div>

            <div class="container px-4">
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
                                    <label for="">Tên bộ sưu tập</label>
                                    <input class="form-control" type="text" placeholder="Tên bộ sưu tập" name="collection_name"
                                        value="<?php echo old('collection_name', $old) ?>" />
                                    <?php
                                    echo form_error('collection_name', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for=""> Danh mục
                                    </label>
                                    <select class="form-control" name="category_id">
                                        <?php
                                        $listCategory = getRaw("SELECT * FROM category");
                                        foreach ($listCategory as $category):
                                        ?>
                                            <option value=<?= $category['category_id'] ?> <?php echo (old('category_id', $old) == $category['category_id']) ? 'selected' : false; ?>><?= $category['category_name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row d-grid gap-2 justify-content-center">
                    <button class="btn btn-primary" type="submit">Thêm bộ sưu tập</button>
                    <a href="?module=admin&action=collection_management" class="btn btn-success" type="submit">Quay lại</a>
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