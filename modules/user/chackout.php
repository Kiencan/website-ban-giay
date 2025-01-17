<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang shop'
];


$user_id = getUserIdByToken();

if (!isLogin()) {
    redirect('?module=auth&action=login');
}

$listOrders = getRaw("SELECT * FROM cart INNER JOIN products ON cart.p_id = products.p_id INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id WHERE user_id = '$user_id'");
$productImage = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $listOrders[0]["p_id"] . "'");
// echo '<pre>';
// print_r($productImage);
// echo '</pre>';
layouts('header', $title);
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Thông tin đơn hàng</h1>
        <form action="?module=user&action=success" method="POST">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="form-item">
                        <label class="form-label my-3">Họ và tên <sup>*</sup></label>
                        <input type="text" class="form-control" name="fullname" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Địa chỉ <sup>*</sup></label>
                        <input type="text" class="form-control" name="address" placeholder="Số nhà, tên đường, xã/phường, quận/huyện, thành phố,..." required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Số điện thoại<sup>*</sup></label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email<sup>*</sup></label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <!-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> -->
                    <hr>
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Chuyển tới địa chỉ khác</label>
                    </div>
                    <div class="form-item">
                        <textarea name="note" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Ghi chú"></textarea>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col" width="20%">Số lượng</th>
                                    <th scope="col">Tổng giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $listOrder = getRaw("SELECT * FROM cart INNER JOIN products ON cart.p_id = products.p_id INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id WHERE user_id = '$user_id'");
                                if (!empty($listOrder)):
                                    $count = 0;
                                    $total = 0;
                                    foreach ($listOrder as $item):
                                        $count++;
                                        $total += ($item['p_price_min'] + $item['p_price_max']) / 2 * $item["p_quantity"] * (100 - $item['discount']) / 100;
                                        $productImage = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $item["p_id"] . "'");
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $productImage["product_image"]; ?> " class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5"><?php echo $item["p_name"] . " " . $item["p_color"]; ?></td>
                                            <td class="py-5"><?php echo number_format(($item['p_price_min'] + $item['p_price_max']) / 2 * (100 - $item['discount']) / 100, 0, ',', '.') ?></td>
                                            <td class="py-5"><?php echo $item["p_quantity"] ?></td>
                                            <td class="py-5"><?php echo number_format(($item['p_price_min'] + $item['p_price_max']) / 2 * $item["p_quantity"] * (100 - $item['discount']) / 100, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach;
                                    ?>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">Tổng tiền</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark"><?php echo number_format($total, 0, ',', '.') ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1" name="payment_method" value="Chuyển tiền qua App ngân hàng" required>
                                <label class="form-check-label" for="Transfer-1">Chuyển tiền qua App ngân hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-3" name="payment_method" value="Thanh toán khi nhận hàng" required>
                                <label class="form-check-label" for="Transfer-3">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-4" name="payment_method" value="Paypal" required>
                                <label class="form-check-label" for="Transfer-4">Paypal</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Checkout Page End -->
<?php
layouts('footer');
?>