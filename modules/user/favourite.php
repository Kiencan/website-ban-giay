<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang mục yêu thích'
];


// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
    redirect('?module=auth&action=login');
}
$user_id = getUserIdByToken();

$listOrder = getRaw("SELECT * FROM cart INNER JOIN products ON cart.p_id = products.p_id INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id WHERE user_id = '$user_id'");
// echo '<pre>';
// print_r($total);
// echo '</pre>';
layouts('header', $title);
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Mục yêu thích</h1>
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
                        <th scope="col">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listOrder)):
                        $count = 0;
                        $total = 0;
                        foreach ($listOrder as $item):
                            $count++;
                            $productImage = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $item["p_id"] . "'");
                            $total += $item["total_price"];
                            $grand_total = $total + $ship_fee;
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
                                    <p class="mb-0 mt-4"><?php echo $item["p_name"] . " " . $item["p_color"]; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo is_int((float)$item['p_size']) ? (int)$item['p_size'] : (float)$item['p_size']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo number_format($item['p_price_min'] * (100 - $item['discount']) / 100, 0, ',', '.') . " - " . number_format($item['p_price_max'] * (100 - $item['discount']) / 100, 0, ',', '.'); ?></p>
                                </td>
                                <input type="hidden" class="cart_id" value="<?php echo $item['cart_id']; ?>">
                                <input type="hidden" class="p_price_min" value="<?php echo $item['p_price_min']; ?>">
                                <input type="hidden" class="p_price_max" value="<?php echo $item['p_price_max']; ?>">

                                <td>
                                    <form action="" class="form-submit1">
                                        <input type="hidden" class="cart_id" value="<?php echo $item['cart_id']; ?>">
                                        <input type="hidden" class="user_id" value="<?php echo $user_id; ?>">
                                        <button class="btn btn-md rounded-circle bg-light border mt-4 deleteItemBtn">
                                            <i class="fa fa-times text-danger text-primary"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    else:
                        $total = 0;
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
<!-- Favourite Page End -->
<?php
layouts('footer');
?>