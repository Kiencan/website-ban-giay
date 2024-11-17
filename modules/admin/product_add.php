<!-- Đăng ký tài khoản -->
<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Thêm sản phẩm'];

layouts('header-admin', $title);

if (isPost()) {
    $filterAll = filter();

    $errors = []; // mảng chứa lỗi

    if (empty($filterAll['p_name'])) {
        $errors['p_name']['required'] = 'Vui lòng nhập tên sản phẩm';
    } else {
        if (strlen($filterAll['p_name']) < 5) {
            $errors['p_name']['min'] = 'Tên sản phẩm quá ngắn';
        }
    }

    if (empty($filterAll['p_price'])) {
        $errors['p_price']['required'] = 'Vui lòng nhập giá sản phẩm';
    } else {
        if ($filterAll['p_price'] < 0) {
            $errors['p_price']['negative'] = 'Giá sản phẩm không âm!';
        }
    }

    if ($filterAll['p_discount'] < 0) {
        $errors['p_discount']['negative'] = 'Giá khuyến mãi không âm!';
    }

    if (empty($filterAll['p_quantity_available'])) {
        $errors['p_quantity_available']['required'] = 'Vui lòng nhập số lượng';
    } else {
        if ($filterAll['p_quantity_available'] < 0) {
            $errors['p_quantity_available']['negative'] = 'Số lượng không âm!';
        } else {
            if (!isNumberInt($filterAll['p_quantity_available'])) {
                $errors['p_quantity_available']['non-int'] = 'Số lượng phải là số nguyên';
            }
        }
    }

    if (empty($_FILES['p_image']['name'])) {
        $errors['p_image']['required'] = 'Vui lòng upload ảnh.';
    } else {
        // Get file information
        $imageName = $_FILES['p_image']['name'];
        $imageSize = $_FILES['p_image']['size'];
        $imageTemp = $_FILES['p_image']['tmp_name'];
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif']; // Allowed file types
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Set target directory
        $targetDir = _WEB_PATH_TEMPLATE . 'image/giay1/';
        $targetFilePath = $targetDir . $imageName;

        // Validate file type
        if (!in_array($fileExtension, $allowedTypes)) {
            $errors['p_image']['type'] = 'Chỉ chấp nhận các định dạng ảnh: JPG, JPEG, PNG, GIF.';
        }

        // Validate file size (e.g., 5MB maximum)
        if ($imageSize > 5 * 1024 * 1024) {
            $errors['p_image']['size'] = 'Dung lượng ảnh không được vượt quá 5MB.';
        }

        // Check if file already exists
        if (file_exists($targetFilePath)) {
            $errors['p_image']['exists'] = 'File này đã tồn tại. Vui lòng chọn một ảnh khác hoặc đổi tên file.';
        }
    }

    if (empty($filterAll['p_model'])) {
        $errors['p_model']['required'] = 'Vui lòng nhập tiêu đề';
    }

    if (empty($filterAll['p_description'])) {
        $errors['p_description']['required'] = 'Vui lòng nhập mô tả sản phẩm';
    } else {
        if (strlen($filterAll['category_title']) > 200) {
            $errors['p_description']['max'] = 'Vui lòng nhập không quá 200 ký tự!';
        }
    }

    if (empty($errors)) {
        $dataInsert = [
            'p_name' => $filterAll['p_name'],
            'p_price' => $filterAll['p_price'],
            'p_discount' => $filterAll['p_discount'],
            'p_quantity_available' => $filterAll['p_quantity_available'],
            'category_id' => $filterAll['category_id'],
            'p_model' => $filterAll['p_model'],
            'p_description' => $filterAll['p_description'],
            'create_at' => date('Y-m-d H:i:s')
        ];

        $image = $_FILES['p_image']['name'];
        $imageTemp = $_FILES['p_image']['tmp_name'];
        $targetDir =  _WEB_PATH_TEMPLATE . 'image/giay1/';
        $targetFilePath = $targetDir . basename($image);

        $dataInsert['p_image'] = basename($image);

        $insertStatus = insert('products', $dataInsert);
        if ($insertStatus) {
            if (move_uploaded_file($imageTemp, $targetFilePath)) {
                setFlashData('smg', 'Thêm sản phẩm thành công!');
                setFlashData('smg_types', 'success');
                redirect('?module=admin&action=product_management');
            } else {
                setFlashData('smg', 'Upload ảnh không thành công!');
                setFlashData('smg_types', 'danger');
                redirect('?module=admin&action=product_add');
            }
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
            redirect('?module=admin&action=product_add');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=admin&action=product_add');
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
                <a
                    href="?module=admin"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-solid fa-house me-2"></i>Dashboard</a>
                <a
                    href="?module=admin&action=user_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fa-regular fa-user me-2"></i>Quản lý thành viên</a>
                <a
                    href="?module=admin&action=category_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold"><i class="fas fa-chart-line me-2"></i>Quản lý danh mục</a>
                <a
                    href="?module=admin&action=product_management"
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fa-solid fa-bag-shopping me-2"></i>Quản lý sản phẩm</a>
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
                    <li class="breadcrumb-item"><a href="?module=admin&action=product_management" style="text-decoration: none">Danh sách sản phẩm</a></li>
                    <li class="breadcrumb-item active"> Thêm sản phẩm </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm sản phẩm</h1>
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
                                    <label for="">Tên sản phẩm</label>
                                    <input class="form-control" type="p_name" placeholder="Tên sản phẩm" name="p_name"
                                        value="<?php echo old('p_name', $old) ?>" />
                                    <?php
                                    echo form_error('p_name', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Giá sản phẩm</label>
                                    <input class="form-control" type="p_price" placeholder="Giá sản phẩm" name="p_price"
                                        value="<?php echo old('p_price', $old) ?>" />
                                    <?php
                                    echo form_error('p_price', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>

                                <div class="form-group mg-form">
                                    <label for="">Giá khuyến mãi</label>
                                    <input class="form-control" type="p_discount" placeholder="Giá khuyến mãi" name="p_discount"
                                        value="<?php echo old('p_discount', $old) ?>" />
                                    <?php
                                    echo form_error('p_discount', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Số lượng</label>
                                    <input class="form-control" type="p_quantity_available" placeholder="Số lượng" name="p_quantity_available"
                                        value="<?php echo old('p_quantity_available', $old) ?>" />
                                    <?php
                                    echo form_error('p_quantity_available', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mg-form">
                                    <label for="">Ảnh sản phẩm</label>
                                    <input class="form-control" type="file" name="p_image" />
                                    <?php
                                    echo form_error('p_image', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="category_id"> Danh mục
                                    </label>
                                    <select class="form-control" name="category_id">
                                        <option value=1 <?php echo (old('category_id', $old) == 1) ? 'selected' : false; ?>>Iphone</option>
                                        <option value=2 <?php echo (old('category_id', $old) == 2) ? 'selected' : false; ?>>Samsung</option>
                                    </select>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Model</label>
                                    <input class="form-control" type="p_model" placeholder="Mẫu" name="p_model"
                                        value="<?php echo old('p_model', $old) ?>" />
                                    <?php
                                    echo form_error('p_model', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="p_description">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="p_description" placeholder="Mô tả" name="p_description" rows="3"><?php echo old('p_description', $old) ?></textarea>
                                    <?php
                                    echo form_error('p_description', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row d-grid gap-2 justify-content-center">
                    <button class="btn btn-primary" type="submit">Thêm sản phẩm</button>
                    <a href="?module=admin&action=product_management" class="btn btn-success" type="button">Quay lại</a>
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