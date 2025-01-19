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

$listOrder = getRaw("SELECT * FROM favourite INNER JOIN products ON favourite.p_id = products.p_id WHERE user_id = '" . $user_id . "' AND favourite = 1");
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
                        <th scope="col">STT</th>
                        <th scope="col">Ảnh sản phẩm</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Xử lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listOrder)):
                        $count = 0;
                        foreach ($listOrder as $item):
                            $count++;
                            $productImage = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $item["p_id"] . "'");
                    ?>
                            <tr>
                                <td scope="row">
                                    <p class="mb-0 mt-4"><?php echo $count; ?></p>
                                </td>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <a href="?module=user&action=shop-detail&p_id=<?php echo $item["p_id"]; ?>">
                                            <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $productImage["product_image"]; ?> " class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </a>
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $item["p_name_custom"]; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo number_format($item['p_price_min'], 0, ',', '.') . " - " . number_format($item['p_price_max'], 0, ',', '.'); ?></p>
                                </td>
                                <td>
                                    <form action="" class="form-submit2">
                                        <input type="hidden" class="p_id" value="<?php echo $item['p_id']; ?>">
                                        <button class="btn btn-md rounded-circle bg-light border mt-4 deleteFavorite">
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