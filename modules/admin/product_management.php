<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Quản lý sản phẩm'
];

layouts('header-admin', $title);

// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}

$listProd = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id ORDER BY create_at DESC");
// echo '<pre>';
// print_r($listSize);
// echo '</pre>';


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
                    <li class="breadcrumb-item active"> Quản lý sản phẩm </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Danh sách sản phẩm</h1>
            </div>

            <div class="container-fluid px-4">

                <div class="row my-5">

                    <div class="col overflow-auto">
                        <a href="?module=admin&action=product_add" class="btn btn-success"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</a>
                        <table class="table bg-white rounded shadow-sm table-hover mt-3" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">ID</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Ảnh sản phẩm</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Bộ sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Các size còn</th>
                                    <th scope="col">Các size hết</th>
                                    <th scope="col">Bán chạy</th>
                                    <th scope="col">Giảm giá</th>
                                    <th width="5%"> Sửa </th>
                                    <th width="5%"> Xóa </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($listProd)):
                                    $count = 0;
                                    foreach ($listProd as $product):
                                        $count++;
                                ?>
                                        <tr>
                                            <td><?php echo $product['p_id'] ?></td>
                                            <td><?php echo $product['p_name_custom'] ?></td>
                                            <td><?php echo $product['p_color'] ?></td>
                                            <td><?php
                                                $listImg = oneRaw("SELECT * FROM product_image INNER JOIN products ON product_image.p_id = products.p_id WHERE product_image.p_id = '$product[p_id]'");
                                                if (!empty($listImg)) {
                                                    echo '<img src="' . _WEB_HOST_TEMPLATE . '/image/' . $listImg['product_image'] . '" width="100px" alt="">';
                                                } else {
                                                    echo '<div class="alert alert-danger text-center">Chưa có hình ảnh, nhấn chỉnh sửa để thêm hình ảnh!</div>';
                                                }

                                                ?>
                                            </td>
                                            <td><?php echo $product['category_name'] ?></td>
                                            <td><?php echo $product['p_name'] ?></td>
                                            <td><?php echo number_format($product['p_price_min'], 0, ',', '.') . ' - ' . number_format($product['p_price_max'], 0, ',', '.') ?></td>
                                            <td><?php echo $product['size_available'] ?></td>
                                            <td><?php echo $product['size_not_available'] ?></td>
                                            <td><?php echo $product['isBestSelling'] == 1 ? '<button class="btn btn-success"> Đang bán chạy </button>' :
                                                    '<button class="btn btn-danger"> Hết bán chạy </button>'; ?></td>
                                            <td><?php echo $product['discount'] > 0 ? '<button class="btn btn-success"> Đang giảm giá </button>' :
                                                    '<button class="btn btn-danger"> Hết giảm giá </button>'; ?></td>
                                            <td><a href="<?php echo "?module=admin&action=product_edit&p_id=" . $product['p_id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                            <td><a href="<?php echo "?module=admin&action=product_delete&p_id=" . $product['p_id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">
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
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
</body>

</html>


<?php
layouts('footer-admin');
?>