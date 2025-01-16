<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang giỏ hàng'
];

layouts('header', $title);

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
?>

<!-- Spinner Start -->
<div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->


<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div
        class="container topbar d-none d-lg-block mb-3"
        style="background-color: #4856dd">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Về chúng tôi</small>/</a>
                <a href="?module=user&action=contact" class="text-white"><small class="text-white mx-2">Liên hệ</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Trở thành đối tác </small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Chương trình</small></a>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Hỗ trợ</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Thông báo</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="?module=user&action=trangchu" class="navbar-brand">
                <h1 class="display-6" style="color: #4856dd">3H1A Store</h1>
            </a>
            <button
                class="navbar-toggler py-2 px-3"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars" style="color: #4856dd"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="?module=user&action=trangchu" class="nav-item nav-link">Trang chủ</a>
                    <a href="?module=user&action=shop&id=bestSelling" class="nav-item nav-link">Bán chạy</a>
                    <a href="?module=user&action=shop&id=discount" class="nav-item nav-link">Giảm giá</a>
                    <div class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown">Sneaker</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="?module=user&action=shop&id=giayAdidas" class="dropdown-item">Giày Adidas</a>
                            <a href="?module=user&action=shop&id=giayNike" class="dropdown-item">Giày Nike</a>
                            <a href="??module=user&action=shop&id=giayPuma" class="dropdown-item">Giày Puma</a>
                            <a href="?module=user&action=shop&id=giayLining" class="dropdown-item">Giày Lining</a>
                            <a href="?module=user&action=shop&id=giayAnta" class="dropdown-item">Giày Anta</a>
                        </div>
                    </div>
                    <a href="?module=user&action=shop&id=quanao" class="nav-item nav-link">Quần áo</a>
                    <a href="?module=user&action=shop&id=phukien" class="nav-item nav-link">Phụ kiện</a>
                    <a href="?module=user&action=shop&id=sandal" class="nav-item nav-link">Sandal</a>
                </div>

                <div class="d-flex m-3 me-0">
                    <button
                        class="btn-search btn border border-secondary rounded-circle bg-white me-4 my-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#searchModal"
                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-search" style="color: #4856dd; font-size: 20px;"></i>
                    </button>
                    <a href="?module=user&action=cart&id=<?php echo $user_id ?>" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x" style="color: #4856dd"></i>
                        <span
                            id="cart-count"
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            <?php
                            if (empty($user_id)) {
                                echo 0;
                            } else {
                                echo getRows("SELECT * FROM cart WHERE user_id = " . $user_id);
                            }
                            ?>
                        </span>
                    </a>
                    <?php
                    if (empty($user_id)):
                    ?>
                        <div class="d-flex flex-column gap-1 " style="width: 130px;">
                            <a type="button" class="btn btn-dark" href="?module=auth&action=login">Đăng nhập</a>
                            <a type="button" class="btn btn-dark" href="?module=auth&action=register">Đăng kí</a>
                        </div>
                    <?php
                    else:
                    ?>
                        <div class="dropdown">
                            <a
                                href="#"
                                class="my-auto"
                                id="dropdownMenuButton"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-user fa-2x" style="color: #4856dd"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Trang cá nhân</a></li>
                                <li><a class="dropdown-item" href="?module=user&action=favourite">Mục yêu thích</a></li>
                                <li><a class="dropdown-item" href="?module=auth&action=logout">Đăng xuất</a></li>
                            </ul>
                        </div>
                    <?php
                    endif
                    ?>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Modal Search Start -->
<div class="modal fade"
    id="searchModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tìm kiếm</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body align-items-center">
                <div class="input-group w-75 mx-auto" id="form-search">
                    <input
                        type="search"
                        class="form-control p-3"
                        placeholder="Nhập tại đây"
                        aria-describedby="search-icon-1"
                        id="search" />
                    <span id="search-icon-1" class="input-group-text p-3">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
                <div class="live-search-result">
                    <ul class="search-result" id="search-results"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->


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


<!-- Footer Start -->
<div
    class="container-fluid text-white-50 footer pt-5 mt-5"
    style="background-color: #4f4f58">
    <div class="container py-5">
        <div
            class="pb-4 mb-4"
            style="border-bottom: 1px solid rgba(226, 175, 24, 0.5)">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="mb-0" style="color: #4856dd; font-weight: 1000">
                            3H1A Store
                        </h1>
                        <p class="text-secondary mb-0">Chuyên hàng chính hãng</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                        <input
                            id="email-input"
                            class="form-control border-0 w-100 py-3 px-4 rounded-pill"
                            type="email"
                            placeholder="Nhập email của bạn" />
                        <button
                            id="send-button"
                            type="button"
                            class="btn border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                            style="top: 0; right: 0; background-color: #4856dd">
                            Gửi ngay
                        </button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a
                            class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                            href=""><i class="fab fa-twitter"></i></a>
                        <a
                            class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                            href=""><i class="fab fa-facebook-f"></i></a>
                        <a
                            class="btn btn-outline-secondary me-2 btn-md-square rounded-circle"
                            href=""><i class="fab fa-tiktok"></i></a>
                        <a
                            class="btn btn-outline-secondary btn-md-square rounded-circle"
                            href=""><i class="fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Tại sao nên chọn 3H1A?</h4>
                    <p class="mb-4">
                        typesetting, remaining essentially unchanged. It was popularised
                        in the 1960s with the like Aldus PageMaker including of Lorem
                        Ipsum.
                    </p>
                    <a
                        href=""
                        class="btn border-secondary py-2 px-4 rounded-pill"
                        style="color: aliceblue">Xem thêm</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Thông tin</h4>
                    <a class="btn-link" href="">Về chúng tôi</a>
                    <a class="btn-link" href="?module=user&action=contact">Liên hệ</a>
                    <a class="btn-link" href="">Chính sách bảo mật</a>
                    <a class="btn-link" href="">Điều khoản và dịch vụ</a>
                    <a class="btn-link" href="">Chính sách hoàn trả</a>
                    <a class="btn-link" href="">Hỏi đáp & Trợ giúp</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Tài khoản</h4>
                    <a class="btn-link" href="">Tài khoản của bạn</a>
                    <a class="btn-link" href="">Thông tin cửa hàng</a>
                    <a class="btn-link" href="">Giỏ hàng</a>
                    <a class="btn-link" href="">Lịch sử mua hàng</a>
                    <a class="btn-link" href="">Đơn hàng</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Liên hệ</h4>
                    <p>Địa chỉ: 89 Phùng Hưng Hà Đông</p>
                    <p>Email: Example@gmail.com</p>
                    <p>Điện thoại: 0383083743</p>
                    <p>Phương thức thanh toán</p>
                    <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/payment.png" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Side-right container -->
<div class="container">
    <div class="row justify-content-end">
        <div class="col-auto">
            <div class="side-right position-fixed">
                <div class="echbay-sms-messenger">
                    <div class="phonering-alo-alo">
                        <a
                            href="tel:0387440192"
                            rel="nofollow"
                            class="echbay-phonering-alo-event"></a>
                    </div>
                    <div class="phonering-alo-sms">
                        <a
                            href="sms:0387440192"
                            rel="nofollow"
                            class="echbay-phonering-sms-event"></a>
                    </div>
                    <div class="phonering-alo-zalo">
                        <a
                            href="https://zalo.me/0387440192"
                            target="_blank"
                            rel="nofollow"
                            class="echbay-phonering-zalo-event"></a>
                    </div>
                    <div class="phonering-alo-messenger">
                        <a
                            href="https://www.facebook.com/3h1a.store"
                            target="_blank"
                            rel="nofollow"
                            class="echbay-phonering-messenger-event"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Side-right container -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>3H1A Strore</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By
                <a class="border-bottom" href="https://htmlcodex.com">KTN Group</a>
                Distributed By
                <a class="border-bottom" href="https://themewagon.com">HUS</a>
            </div>
        </div>
    </div>
</div>
<!-- Copyright End -->



<!-- Back to Top -->
<a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
layouts('footer');
?>
<script>
    $(document).ready(function() {
        $(".itemQty").on("change", function() {
            var $el = $(this).closest("tr");

            var cart_id = $el.find(".cart_id").val();
            var p_quantity = $(this).val();
            var p_price_min = $el.find(".p_price_min").val();
            var p_price_max = $el.find(".p_price_max").val();

            // Gửi AJAX để cập nhật số lượng và tính lại tổng giá
            $.ajax({
                url: "?module=user&action=update_total_price",
                method: "POST",
                cache: false,
                data: {
                    cart_id: cart_id,
                    p_quantity: p_quantity,
                    p_price_min: p_price_min,
                    p_price_max: p_price_max
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    let total_price = data.total_price.toLocaleString('vi-VN');
                    $el.find(".total-price").text(total_price);
                    let total = data.total;
                    console.log(total);
                    $(".thanh_tien").text(total + " VNĐ");
                    let ship_fee = data.ship_fee;
                    console.log(ship_fee);
                    $(".tien_ship").text(ship_fee + " VNĐ");
                    let grand_total = data.grand_total;
                    console.log(grand_total);
                    $(".tong_thanh_toan").text(grand_total + " VNĐ");
                },
                error: function() {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: "Không thể cập nhật số lượng, vui lòng thử lại!",
                        showConfirmButton: true
                    });
                }
            });
        });

        // Xử lý sự kiện tăng/giảm số lượng
        $(".btn-minus, .btn-plus").on("click", function(e) {
            e.preventDefault();
            var $input = $(this).closest(".input-group").find(".itemQty");
            var currentValue = parseInt($input.val()) || 0;
            if ($(this).hasClass("btn-minus") && currentValue > 0) {
                $input.val(currentValue).trigger("change");
            } else if ($(this).hasClass("btn-plus")) {
                $input.val(currentValue).trigger("change");
            }
        });

        $(".deleteItemBtn").click(function(e) {
            e.preventDefault();

            const form = $(this).closest(".form-submit1");
            const cart_id = form.find(".cart_id").val();
            const user_id = form.find(".user_id").val();

            // Thêm hộp thoại xác nhận trước khi xóa
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
                text: "Thao tác này không thể hoàn tác!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Nếu người dùng xác nhận, thực hiện xóa
                    $.ajax({
                        url: "?module=user&action=cart_delete", // File PHP xử lý thêm vào giỏ hàng
                        method: "POST",
                        dataType: "json",
                        data: {
                            cart_id: cart_id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công!",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                            console.log(response);
                            let total = response.total;
                            $(".thanh_tien").text(total + " VNĐ");
                            let ship_fee = response.ship_fee;
                            console.log(ship_fee);
                            $(".tien_ship").text(ship_fee + " VNĐ");
                            let grand_total = response.grand_total;
                            $(".tong_thanh_toan").text(grand_total + " VNĐ");

                            // Xóa dòng sản phẩm trên giao diện
                            form.closest("tr").remove();

                            // Kiểm tra nếu giỏ hàng trống, hiển thị thông báo
                            if ($("table tbody tr").length === 0) {
                                $("table tbody").html(`
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-danger text-center">Không có đơn hàng nào!</div>
                                    </td>
                                </tr>
                            `);
                            }
                            updateCartCount(user_id);
                        },
                        error: function() {
                            Swal.fire({
                                icon: "error",
                                title: "Lỗi",
                                text: "Đã xảy ra lỗi, vui lòng thử lại!",
                                showConfirmButton: true
                            });
                        }
                    });
                }
            });
        });

        // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
        function updateCartCount(user_id) {
            $.ajax({
                url: "?module=user&action=cart_count", // File PHP trả về số lượng sản phẩm
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(response) {
                    $("#cart-count").text(response); // Cập nhật số lượng sản phẩm
                }
            });
        }
    });
</script>