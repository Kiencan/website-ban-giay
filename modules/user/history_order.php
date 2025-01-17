<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang lịch sử mua hàng'
];


// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
    redirect('?module=auth&action=login');
}
$user_id = getUserIdByToken();

$listOrder = getRaw("SELECT * FROM orders WHERE user_id = '$user_id'");
// echo '<pre>';
// print_r($listOrder);
// echo '</pre>';

// Kết quả lưu trữ
$result = [];

foreach ($listOrder as $order) {
    $p_ids = explode(',', $order['p_id']);
    $p_sizes = explode(',', $order['p_size']);
    $p_prices = explode(',', $order['p_price']);
    $p_quantities = explode(',', $order['p_quantity']);

    foreach ($p_ids as $index => $p_id) {
        $result[] = [
            "p_id" => $p_id,
            "p_size" => $p_sizes[$index] ?? null,
            "p_price" => $p_prices[$index] ?? null,
            "p_quantity" => $p_quantities[$index] ?? null,
            "order_create_at" => $order['order_create_at'],
        ];
    }
}

// In kết quả
// print_r($result);
layouts('header', $title);
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Lịch sử mua hàng</h1>
</div>
<!-- Single Page Header End -->


<!-- Favourite Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Size</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Ngày đặt hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (!empty($result)):
                        $count = 0;
                        foreach ($result as $item):
                            $count++;
                            $product_name = oneRaw("SELECT p_name_custom FROM products WHERE p_id = '" . $item["p_id"] . "'");
                            $productImage = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $item["p_id"] . "'");
                    ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <a href="?module=user&action=shop-detail&p_id=<?php echo $item["p_id"]; ?>">
                                            <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $productImage["product_image"]; ?> " class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </a>
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $product_name['p_name_custom']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo is_int((float)$item['p_size']) ? (int)$item['p_size'] : (float)$item['p_size']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo number_format($item['p_price'], 0, ',', '.') ?> VNĐ</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $item["order_create_at"]; ?></p>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    else:
                        $total = 0;
                        ?>
                        <tr>
                            <td colspan="7">
                                <div class="alert alert-danger text-center">Chưa có sản phẩm nào!</div>
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
<!-- Favourite Page End -->
<?php
layouts('footer');
?>