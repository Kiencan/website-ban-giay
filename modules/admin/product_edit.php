<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$title = ['pageTitle' => 'Cập nhật sản phẩm'];

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}

layouts('header-admin', $title);
$filterAll = filter();

if (!empty($filterAll['p_id'])) {
    $p_id = $filterAll['p_id'];

    $productDetail = oneRaw("SELECT * FROM products INNER JOIN category ON products.category_id = category.category_id WHERE p_id = '$p_id'");

    $sizeDetail = getRaw("SELECT * FROM product_size WHERE product_id = '$p_id' ORDER BY size");

    $imageDetail = getRaw("SELECT * FROM product_image WHERE product_id = '$p_id'");

    $listCategory = getRaw("SELECT * FROM category");
    // echo '<pre>';
    // print_r($productDetail);
    // echo '</pre>';

    if (!empty($productDetail)) {
        setFlashData('product-detail', $productDetail);
    } else {
        redirect('?module=admin&action=product_management');
    }
}

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

    if (empty($filterAll['p_description'])) {
        $errors['p_description']['required'] = 'Vui lòng nhập mô tả sản phẩm';
    } else {
        if (strlen($filterAll['category_title']) > 200) {
            $errors['p_description']['max'] = 'Vui lòng nhập không quá 200 ký tự!';
        }
    }

    if (empty($errors)) {
        $productUpdate = [
            'p_id' => $filterAll['p_id'],
            'p_name' => $filterAll['p_name'],
            'category_id' => $filterAll['category_id'],
        ];

        $updateStatus = update('products', $productUpdate, "p_id = '$p_id'");
        if ($updateStatus) {
            setFlashData('smg', 'Cập nhật sản phẩm thành công!');
            setFlashData('smg_types', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đang lỗi vui lòng thử lại sau!');
            setFlashData('smg_types', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin');
        setFlashData('smg_types', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
    }
    redirect('?module=admin&action=product_edit&p_id=' . $p_id);
}

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
$errors = getFlashData('errors');
$old = getFlashData('old');
$productDetail = getFlashData('product-detail');
if (!empty($productDetail)) {
    $old = $productDetail;
}
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
                    <li class="breadcrumb-item active"> Cập nhật sản phẩm </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Cập nhật sản phẩm</h1>
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
                                    <label for="">Mã sản phẩm</label>
                                    <input class="form-control" type="text" placeholder="Mã sản phẩm" name="p_id"
                                        value="<?php echo old('p_id', $old) ?>" />
                                    <?php
                                    echo form_error('p_id', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Tên sản phẩm</label>
                                    <input class="form-control" type="text" placeholder="Tên sản phẩm" name="p_name"
                                        value="<?php echo old('p_name', $old) ?>" />
                                    <?php
                                    echo form_error('p_name', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <div class="form-group mg-form">
                                    <label for=""> Danh mục
                                    </label>
                                    <select class="form-control" name="category_id">
                                        <?php
                                        foreach ($listCategory as $category):
                                        ?>
                                            <option value=<?= $category['category_id'] ?> <?php echo (old('category_id', $old) == $category['category_id']) ? 'selected' : false; ?>><?= $category['category_name'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mg-form">
                                    <label for="">Mô tả sản phẩm</label>
                                    <textarea class="form-control" id="p_description" placeholder="Mô tả" name="p_description" rows="3"><?php echo old('p_description', $old) ?></textarea>
                                    <?php
                                    echo form_error('p_description', '<p class="text-danger">', '</p>', $errors);
                                    ?>
                                </div>
                                <a href="?module=admin&action=product_size_add&p_id=<?php echo $p_id ?>" class="btn btn-success mt-3"><i class="fa-solid fa-plus"></i> Thêm size giày</a>
                                <table class="table bg-white rounded shadow-sm table-hover mt-3" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50">STT</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Giá</th>
                                            <th width="5%"> Sửa </th>
                                            <th width="5%"> Xóa </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (!empty($sizeDetail)):
                                            $count = 0;
                                            foreach ($sizeDetail as $size):
                                                $count++;
                                        ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $size['size'] ?></td>
                                                    <td><?php echo $size['quantity'] ?></td>
                                                    <td><?php echo number_format($size['price'], 0, ',', '.') . " VNĐ"; ?></td>
                                                    <td><a href="<?php echo "?module=admin&action=product_size_edit&p_id=" . $size['product_id'] . "&size_id=" . $size['size_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                                    <td><a href="<?php echo "?module=admin&action=product_size_delete&p_id=" . $size['product_id'] . "&size_id=" . $size['size_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i></a></td>
                                                </tr>
                                            <?php
                                            endforeach;

                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-danger text-center">Không có người dùng nào!</div>
                                                </td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
                                    </tbody>
                                </table>

                                <a href="?module=admin&action=product_image_add&p_id=<?php echo $p_id ?>" class="btn btn-success mt-3"><i class="fa-solid fa-plus"></i> Thêm hình ảnh</a>
                                <table class="table bg-white rounded shadow-sm table-hover mt-3" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col" width="50">STT</th>
                                            <th scope="col">Ảnh</th>
                                            <th width="5%"> Sửa </th>
                                            <th width="5%"> Xóa </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if (!empty($imageDetail)):
                                            $count = 0;
                                            foreach ($imageDetail as $image):
                                                $count++;
                                        ?>
                                                <tr>
                                                    <td><?php echo $count ?></td>
                                                    <td><img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $image['product_image']; ?>" width="100px"></td>
                                                    <td><a href="<?php echo "?module=admin&action=product_image_edit&p_id=" . $image['product_id'] . "&image_id=" . $image['image_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                                    <td><a href="<?php echo "?module=admin&action=product_image_delete&p_id=" . $image['product_id'] . "&image_id=" . $image['image_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i></a></td>
                                                </tr>
                                            <?php
                                            endforeach;

                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-danger text-center">Không có người dùng nào!</div>
                                                </td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                <div class="row d-grid gap-2 justify-content-center">
                    <input type="hidden" name="p_id" value="<?php echo $p_id ?>" />
                    <button class="btn btn-primary" type="submit">Cập nhật sản phẩm</button>
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