<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm sản phẩm'];

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}

layouts('header-admin', $title);

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi


    if (empty($_FILES['banner']['name'])) {
        $errors['banner']['required'] = 'Vui lòng upload ảnh.';
    } else {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        $targetDir = _WEB_PATH_TEMPLATE . 'image/';
        $errors = [];

        foreach ($_FILES['banner']['name'] as $key => $imageName) {
            $imageSize = $_FILES['banner']['size'][$key];
            $imageTemp = $_FILES['banner']['tmp_name'][$key];
            $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $targetFilePath = $targetDir . basename($imageName);

            // Validate file type
            if (!in_array($fileExtension, $allowedTypes)) {
                $errors['banner'][$key]['type'] = "Ảnh '$imageName' không đúng định dạng.";
            }

            // Validate file size (5MB max per file)
            if ($imageSize > 5 * 1024 * 1024) {
                $errors['banner'][$key]['size'] = "Ảnh '$imageName' vượt quá 5MB.";
            }

            // Check if file already exists
            if (file_exists($targetFilePath)) {
                $errors['banner'][$key]['exists'] = "Ảnh '$imageName' đã tồn tại.";
            }
        }
    }

    if (empty($filterAll['banner_name'])) {
        $errors['banner_name']['required'] = 'Vui lòng nhập tên banner';
    }

    if (empty($errors)) {
        foreach ($_FILES['banner']['tmp_name'] as $key => $imageTemp) {
            $imageName = $_FILES['banner']['name'][$key];
            $targetFilePath = $targetDir . basename($imageName);

            $dataInsert = [
                'banner_name' => $filterAll['banner_name'],
                'banner' => basename($imageName),
            ];

            $insertStatus = insert('banner', $dataInsert);
            if ($insertStatus) {
                if (!move_uploaded_file($imageTemp, $targetFilePath)) {
                    setFlashData('smg', "Upload ảnh '$imageName' không thành công!");
                    setFlashData('smg_types', 'danger');
                    redirect('?module=admin&action=setting_banner_add');
                }
            } else {
                setFlashData('smg', "Lỗi khi lưu ảnh '$imageName' vào cơ sở dữ liệu.");
                setFlashData('smg_types', 'danger');
                redirect('?module=admin&action=setting_banner_add');
            }
        }
        setFlashData('smg', 'Tất cả ảnh đã được tải lên thành công!');
        setFlashData('smg_types', 'success');
        redirect('?module=admin&action=setting_banner');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $_FILES['banner']);
        redirect('?module=admin&action=setting_banner_add');
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
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-solid fa-cart-shopping me-2"></i>Quản lý bộ sưu tập</a>
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
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fa-solid fa-gear me-2"></i>Cấu hình</a>
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
                    <li class="breadcrumb-item"><a href="?module=admin&action=product_management" style="text-decoration: none">Danh sách Banner</a></li>
                    <li class="breadcrumb-item active"> Thêm Banner </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm Banner</h1>
            </div>

            <div class="container-fluid px-4">
                <div class="row" style="margin: 50px auto">
                    <?php
                    if (!empty($smg)) {
                        getSmg($smg, $smg_types);
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mg-form">
                                    <label for="">Ảnh banner</label>
                                    <input id="productImage" class="form-control" type="file" name="banner[]" accept="image/*" multiple onchange="previewImages(event)" />
                                    <?php
                                    echo form_error('banner', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Tên banner</label>
                                    <input class="form-control" type="text" placeholder="Tên banner" name="banner_name"
                                        value="<?php echo old('banner_name', $old) ?>" />
                                    <?php
                                    echo form_error('banner_name', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row d-grid gap-2 justify-content-center">
                    <button class="btn btn-primary" type="submit">Thêm Banner</button>
                    <a href="?module=admin&action=setting_banner" class="btn btn-success" type="button">Quay lại</a>
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