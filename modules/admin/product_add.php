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

    if (empty($filterAll['p_id'])) {
        $errors['p_id']['required'] = 'Vui lòng mã sản phẩm';
    }
    if (empty($filterAll['p_color'])) {
        $errors['p_color']['required'] = 'Vui lòng màu sắc sản phẩm';
    }

    if (empty($filterAll['p_description'])) {
        $errors['p_description']['required'] = 'Vui lòng nhập mô tả sản phẩm';
    } else {
        if (strlen($filterAll['p_description']) > 2000) {
            $errors['p_description']['max'] = 'Vui lòng nhập không quá 200 ký tự!';
        }
    }
    if (empty($filterAll['p_price_min'])) {
        $errors['p_price_min']['required'] = 'Vui lòng nhập giá';
    } else {
        if ($filterAll['p_price_min'] < 0) {
            $errors['p_price_min']['negative'] = 'Giá tiền phải lớn hơn 0!';
        }
    }

    if (empty($filterAll['p_price_max'])) {
        $errors['p_price_max']['required'] = 'Vui lòng nhập giá';
    } else {
        if ($filterAll['p_price_max'] < $filterAll['p_price_min']) {
            $errors['p_price_max']['greater'] = 'Giá max phải lớn hơn giá min!';
        }
    }
    // if (empty($filterAll['size_available'])) {
    //     $errors['size_available']['required'] = 'Vui lòng nhập size còn';
    // }
    // if (empty($filterAll['size_not_available'])) {
    //     $errors['size_not_available']['required'] = 'Vui lòng nhập size hết';
    // }
    if (empty($filterAll['discount'])) {
        $errors['discount']['required'] = 'Vui lòng nhập % giảm giá';
    } else {
        if ($filterAll['discount'] < 0) {
            $errors['discount']['negative'] = '% giảm giá phải lớn hơn 0!';
        } else if ($filterAll['discount'] > 100) {
            $errors['discount']['greater'] = '% giảm giá phải nhỏ hơn 100!';
        }
    }

    if (empty($errors)) {
        if ($insertNameStatus) {
            $productInsert = [
                'p_id' => $filterAll['p_id'],
                'p_name_id' => $filterAll['p_name_id'],
                'p_color' => $filterAll['p_color'],
                'p_rate' => $filterAll['p_rate'],
                'p_description' => $filterAll['p_description'],
                'p_price_min' => $filterAll['p_price_min'],
                'p_price_max' => $filterAll['p_price_max'],
                'size_available' => $filterAll['size_available'],
                'size_not_available' => $filterAll['size_not_available'],
                'isBestSelling' => $filterAll['isBestSelling'],
                'discount' => $filterAll['discount'],
                'create_at' => date('Y-m-d H:i:s'),
            ];
            $insertStatus = insert('products', $productInsert);
            if ($insertStatus) {
                setFlashData('smg', 'Thêm sản phẩm thành công!');
                setFlashData('smg_types', 'success');
                redirect('?module=admin&action=product_management');
            } else {
                setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
                setFlashData('smg_types', 'danger');
                redirect('?module=admin&action=product_add');
            }
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
                    <li class="breadcrumb-item"><a href="?module=admin&action=dashboard" style="text-decoration: none"><i class="fa-solid fa-house"></i></a></li>
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
                    <form action="" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group mg-form">
                                    <label for="">Mã sản phẩm</label>
                                    <input class="form-control" type="text" placeholder="Mã sản phẩm" name="p_id"
                                        value="<?php echo old('p_id', $old) ?>" />
                                    <?php
                                    echo form_error('p_id', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for=""> Bộ sưu tập
                                    </label>
                                    <select class="form-control" name="collection_id">
                                        <?php
                                        $listCategory = getRaw("SELECT * FROM collection");
                                        foreach ($listCategory as $category):
                                        ?>
                                            <option value=<?= $category['collection_id'] ?> <?php echo (old('collection_id', $old) == $category['collection_id']) ? 'selected' : false; ?>><?= $category['collection_name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mg-form">
                                    <label for=""> Tên sản phẩm
                                    </label>
                                    <select class="form-control" name="p_name_id">
                                        <?php
                                        $listProdName = getRaw("SELECT * FROM product_name");
                                        foreach ($listProdName as $prodName):
                                        ?>
                                            <option value=<?= $prodName['p_name_id'] ?> <?php echo (old('p_name_id', $old) == $prodName['p_name_id']) ? 'selected' : false; ?>><?= $prodName['p_name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Màu sắc</label>
                                    <input class="form-control" type="text" placeholder="Màu sản phẩm" name="p_color"
                                        value="<?php echo old('p_color', $old) ?>" />
                                    <?php
                                    echo form_error('p_color', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Đánh giá</label>
                                    <input class="form-control" type="number" placeholder="Số sao" name="p_rate"
                                        value="<?php echo old('p_rate', $old) ?>" />
                                    <?php
                                    echo form_error('p_rate', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="p_description" placeholder="Mô tả" name="p_description" rows="3"><?php echo old('p_description', $old) ?></textarea>
                                    <?php
                                    echo form_error('p_description', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Giá sản phẩm</label>
                                    <div class="d-flex align-items-center">
                                        <!-- Giá nhỏ nhất -->
                                        <input class="form-control me-2" type="text" placeholder="Giá nhỏ nhất" name="p_price_min"
                                            value="<?php echo old('p_price_min', $old) ?>" style="width: 48%;" />
                                        <span class="mx-1">-</span>
                                        <!-- Giá lớn nhất -->
                                        <input class="form-control ms-2" type="text" placeholder="Giá lớn nhất" name="p_price_max"
                                            value="<?php echo old('p_price_max', $old) ?>" style="width: 48%;" />
                                    </div>
                                    <?php
                                    echo form_error('p_price_min', '<p class="text-danger">', '</p>', $errors);
                                    echo form_error('p_price_max', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Size còn</label>
                                    <input class="form-control" type="text" placeholder="Nhập size giày" name="size_available"
                                        value="<?php echo old('size_available', $old) ?>" />
                                    <?php
                                    echo form_error('size_available', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Size hết</label>
                                    <input class="form-control" type="text" placeholder="Nhập size giày" name="size_not_available"
                                        value="<?php echo old('size_not_available', $old) ?>" />
                                    <?php
                                    echo form_error('size_not_available', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for=""> Bán chạy
                                    </label>
                                    <select class="form-control" name="isBestSelling">
                                        <option value=0 <?php echo (old('isBestSelling', $old) == 0) ? 'selected' : false; ?>>Hết bán chạy</option>
                                        <option value=1 <?php echo (old('isBestSelling', $old) == 1) ? 'selected' : false; ?>>Đang bán chạy</option>
                                    </select>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Giảm giá</label>
                                    <input class="form-control" type="number" placeholder="Nhập % giảm giá" name="discount"
                                        value="<?php echo old('discount', $old) ?>" />

                                    <?php
                                    echo form_error('discount', '<p class="text-danger">', '</p>', $errors);
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