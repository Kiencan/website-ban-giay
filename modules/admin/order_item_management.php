<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Quản lý đơn hàng'
];

layouts('header-admin', $title);

// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

if (!isAdmin()) {
    redirect('?module=user&action=trangchu');
}
$listOrder = getRaw("SELECT * FROM orders");
// echo '<pre>';
// print_r($listOrder);
// echo '</pre>';

$products = [];
// Xử lý dữ liệu
foreach ($listOrder as $order) {
    $p_ids = explode(',', $order['p_id']);
    $p_sizes = explode(',', $order['p_size']);
    $p_quantities = explode(',', $order['p_quantity']);

    $result = [];
    foreach ($p_ids as $index => $p_id) {
        $shoeName = oneRaw("SELECT p_name_custom FROM products WHERE p_id = '$p_id'")['p_name_custom'];
        $size = $p_sizes[$index] ?? '';
        $quantity = $p_quantities[$index] ?? '0';
        $result[] = "x$quantity $shoeName size $size";
    }

    // Kết hợp chuỗi theo yêu cầu
    $finalString = implode(" <br> ", $result);
    array_push($products, $finalString);
}
// print_r($products);

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');

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
                    class="list-group-item list-group-item-action px-4 py-3 fw-bold active"><i class="fa-regular fa-newspaper me-2"></i>Quản lý đơn hàng</a>
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
                    <li class="breadcrumb-item"><a href="" style="text-decoration: none">Quản lý đơn hàng</a></li>
                    <li class="breadcrumb-item active"> Danh sách đơn hàng </li>
                </ul>
            </div>

            <div class="container-fluid px-4">
                <h1 class="mt-4">Danh sách đơn hàng</h1>
            </div>

            <div class="container-fluid px-4">
                <div class="row my-5">
                    <div class="col overflow-auto">
                        <table class="table bg-white rounded shadow-sm table-hover" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">Mã đơn hàng</th>
                                    <th scope="col">Tên người nhận</th>
                                    <th scope="col">Địa chỉ nhận hàng</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt hàng</th>
                                    <th scope="col">Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($listOrder)):
                                    for ($i = 0; $i < count($listOrder); $i++):
                                ?>
                                        <tr>
                                            <td><?php echo $listOrder[$i]['payment_id'] ?></td>
                                            <td><?php echo $listOrder[$i]['receiver_name'] ?></td>
                                            <td><?php echo $listOrder[$i]['receiver_address'] ?></td>
                                            <td><?php echo $listOrder[$i]['phone_number'] ?></td>
                                            <td><?php echo $products[$i] ?></td>
                                            <td><?php echo number_format($listOrder[$i]['total'], 0, ',', '.') ?> VNĐ</td>
                                            <td><?php echo $listOrder[$i]['order_create_at'] ?></td>
                                            <td><?php
                                                if ($listOrder[$i]['order_status'] == 0) {
                                                    echo '<a href="' . "?module=admin&action=order_item_edit&id=" . $listOrder[$i]['payment_id'] . '" class="btn btn-danger">Đang chuẩn bị</a>';
                                                } else if ($listOrder[$i]['order_status'] == 1) {
                                                    echo '<a href="' . "?module=admin&action=order_item_edit&id=" . $listOrder[$i]['payment_id'] . '" class="btn btn-warning">Đang giao hàng</span>';
                                                } else {
                                                    echo '<a href="' . "?module=admin&action=order_item_edit&id=" . $listOrder[$i]['payment_id'] . '" class="btn btn-success">Đã nhận hàng</span>';
                                                }
                                                ?></td>
                                        </tr>
                                    <?php
                                    endfor;
                                else:
                                    ?>
                                    <tr>
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center">Không có đơn hàng nào!</div>
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