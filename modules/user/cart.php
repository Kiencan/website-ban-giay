<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang giỏ hàng'
];

// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
    redirect('?module=auth&action=login');
}
$user_id = getUserIdByToken();

$listOrder = getRaw("SELECT * FROM cart INNER JOIN products ON cart.p_id = products.p_id INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id WHERE user_id = '$user_id'");
$ship_fee = 30000;
// $total = oneRaw("SELECT sum(total_price) FROM cart WHERE user_id = '$user_id'");
// echo '<pre>';
// print_r($total);
// echo '</pre>';
layouts('header', $title);
?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Giỏ hàng</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Giỏ hàng</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Cart Page Start -->
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
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền</th>
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
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0 itemQty" value="<?php echo $item["p_quantity"]; ?>">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total-price"><?php echo number_format($item['total_price'], 0, ',', '.'); ?></p>
                                </td>

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
        <div class="row g-4 justify-content-end">
            <div class="col-8"></div>
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h2 class="display-7 mb-4">Hóa đơn thanh toán</h2>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Thành tiền:</h5>
                            <p class="mb-0 thanh_tien"><?php
                                                        $total > 0 ? $total : $total = 0;
                                                        echo number_format($total, 0, ',', '.');
                                                        ?> VNĐ</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Phí vận chuyển</h5>
                            <div class="">
                                <p class="mb-0 tien_ship"><?php $total > 0 ? $ship_fee : $ship_fee = 0;
                                                            echo number_format($ship_fee, 0, ',', '.'); ?> VNĐ</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Tổng thanh toán</h5>
                        <p class="mb-0 pe-4 tong_thanh_toan"><?php $total > 0 ? $total + $ship_fee : $total = 0;
                                                                echo number_format($total + $ship_fee, 0, ',', '.'); ?> VNĐ</p>
                    </div>
                    <a href="?module=user&action=chackout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Xử lý thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart Page End -->
<?php
layouts('footer');
?>