<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm hình ảnh'];

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}

layouts('header-admin', $title);
$filterId = filter();
$p_id = $filterId['p_id'];

if (isset($_FILES['product_image']) && count($_FILES['product_image']['name']) > 0) {
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    $targetDir = _WEB_PATH_TEMPLATE . 'image/';
    $errors = [];

    foreach ($_FILES['product_image']['name'] as $key => $imageName) {
        $imageSize = $_FILES['product_image']['size'][$key];
        $imageTemp = $_FILES['product_image']['tmp_name'][$key];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $targetFilePath = $targetDir . basename($imageName);

        // Validate file type
        if (!in_array($fileExtension, $allowedTypes)) {
            $errors['product_image'][$key]['type'] = "Ảnh '$imageName' không đúng định dạng.";
        }

        // Validate file size (5MB max per file)
        if ($imageSize > 5 * 1024 * 1024) {
            $errors['product_image'][$key]['size'] = "Ảnh '$imageName' vượt quá 5MB.";
        }

        // Check if file already exists
        if (file_exists($targetFilePath)) {
            $errors['product_image'][$key]['exists'] = "Ảnh '$imageName' đã tồn tại.";
        }
    }

    if (empty($errors)) {
        foreach ($_FILES['product_image']['tmp_name'] as $key => $imageTemp) {
            $imageName = $_FILES['product_image']['name'][$key];
            $targetFilePath = $targetDir . basename($imageName);

            $dataInsert = [
                'product_image' => basename($imageName),
                'p_id' => $p_id
            ];

            $insertStatus = insert('product_image', $dataInsert);
            if ($insertStatus) {
                if (!move_uploaded_file($imageTemp, $targetFilePath)) {
                    setFlashData('smg', "Upload ảnh '$imageName' không thành công!");
                    setFlashData('smg_types', 'danger');
                    redirect('?module=admin&action=product_image_add&p_id=' . $p_id);
                }
            } else {
                setFlashData('smg', "Lỗi khi lưu ảnh '$imageName' vào cơ sở dữ liệu.");
                setFlashData('smg_types', 'danger');
                redirect('?module=admin&action=product_image_add&p_id=' . $p_id);
            }
        }
        setFlashData('smg', 'Tất cả ảnh đã được tải lên thành công!');
        setFlashData('smg_types', 'success');
        redirect('?module=admin&action=product_edit&p_id=' . $p_id);
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $_FILES['product_image']);
        redirect('?module=admin&action=product_image_add&p_id=' . $p_id);
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
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fa-solid fa-bag-shopping me-2"></i>Quản lý hình ảnh sản phẩm</a>
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
                    <li class="breadcrumb-item"><a href="?module=admin&action=product_management" style="text-decoration: none">Danh sách sản phẩm</a></li>
                    <li class="breadcrumb-item active"> Thêm hình ảnh sản phẩm </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm hình ảnh sản phẩm</h1>
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
                                    <label for="">Ảnh sản phẩm</label>
                                    <input id="productImage" class="form-control" type="file" name="product_image[]" accept="image/*" multiple onchange="previewImages(event)" />
                                    <?php
                                    echo form_error('product_image', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Phần hiển thị ảnh xem trước -->
                        <div class="row">
                            <div class="col text-center">
                                <img id="preview" src="#" alt="Xem trước ảnh" style="display: none; max-width: 300px; margin-top: 20px;" />
                            </div>
                        </div>
                        <div class="row d-grid gap-2 justify-content-center mt-3">
                            <input type="hidden" name="p_id" value="<?php echo $p_id ?>" />
                            <button class="btn btn-primary" type="submit">Thêm hình ảnh sản phẩm</button>
                            <a href="?module=admin&action=product_edit&p_id=<?php echo $p_id ?>" class="btn btn-success" type="button">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
</body>

<?php
layouts('footer-admin');
?>