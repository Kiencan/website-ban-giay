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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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