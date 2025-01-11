<?php
if (!defined('_CODE')) {
    die('Access denied');
}
?>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/lib/easing/easing.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/lib/waypoints/waypoints.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/main.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const BASE_URL = '<?php echo _WEB_HOST_TEMPLATE ?>';
</script>
<script>
    $(document).ready(function() {
        $(".addItemBtn").click(function(e) {
            e.preventDefault();

            const form = $(this).closest(".form-submit");
            const p_id = form.find(".p_id").val();
            const user_id = form.find(".user_id").val();
            const p_price_min = form.find(".p_price_min").val();


            const p_size = $(".chon-size .form-check-input:checked").val();
            const p_quantity = $(".itemQty").val();
            // console.log(p_id);
            // console.log(user_id);
            // console.log(p_price_min);
            // console.log(p_size);
            // console.log(p_quantity);

            // Kiểm tra các giá trị trước khi gửi AJAX
            if (!p_id || !user_id || !p_price_min || !p_size || !p_quantity) {
                Swal.fire({
                    icon: "warning",
                    title: "Cảnh báo",
                    text: "Vui lòng chọn đầy đủ thông tin sản phẩm!",
                    showConfirmButton: true
                });
                return;
            }

            // Hiển thị trạng thái loading
            Swal.fire({
                title: "Đang xử lý...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "?module=user&action=add_to_cart", // File PHP xử lý thêm vào giỏ hàng
                method: "POST",
                dataType: "json",
                data: {
                    p_id: p_id,
                    user_id: user_id,
                    p_price_min: p_price_min,
                    p_size: p_size, // Gửi thông tin size
                    p_quantity: p_quantity // Gửi thông tin số lượng
                },
                success: function(response) {
                    Swal.close(); // Đóng trạng thái loading

                    if (response && response.status) {
                        if (response.status === "added") {
                            Swal.fire({
                                icon: "success",
                                title: "Thành công!",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else if (response.status === "exists") {
                            Swal.fire({
                                icon: "info",
                                title: "Thông báo",
                                text: response.message,
                                showConfirmButton: true
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Lỗi",
                                text: response.message,
                                showConfirmButton: true
                            });
                        }

                        // Gọi API để cập nhật số lượng sản phẩm
                        updateCartCount(user_id);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: "Phản hồi không hợp lệ từ server.",
                            showConfirmButton: true
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.close();
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: `Đã xảy ra lỗi: ${error}. Vui lòng thử lại!`,
                        showConfirmButton: true
                    });
                }
            });
        });

        // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
        function updateCartCount(user_id) {
            if (!user_id) return;

            $.ajax({
                url: "?module=user&action=cart_count",
                method: "POST",
                data: {
                    user_id: user_id
                },
                success: function(response) {
                    if (response && !isNaN(response)) {
                        $("#cart-count").text(response);
                    }
                },
                error: function() {
                    console.error("Không thể cập nhật số lượng sản phẩm.");
                }
            });
        }

        // Thêm class active khi chọn size
        $(".chon-size .size").click(function() {
            $(".chon-size .size").removeClass("active");
            $(this).addClass("active");
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Lắng nghe sự kiện nhập vào ô tìm kiếm
        $('#search').on('keyup', function() {
            let query = $(this).val(); // Lấy giá trị từ input search

            if (query.length > 1) { // Chỉ tìm kiếm khi từ khóa > 1 ký tự
                $.ajax({
                    url: '?module=user&action=search', // File PHP xử lý tìm kiếm
                    method: 'POST',
                    data: {
                        query: query
                    }, // Gửi dữ liệu tìm kiếm
                    success: function(response) {
                        $('#search-results').html(response); // Hiển thị kết quả
                    },
                    error: function() {
                        console.log('Có lỗi xảy ra.');
                    }
                });
            } else {
                $('#search-results').html(''); // Xóa kết quả nếu input rỗng
            }
        });
    });
</script>