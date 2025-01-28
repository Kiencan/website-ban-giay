<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang liên hệ'
];

// Kiểm tra trạng thái đăng nhập
$user_id = getUserIdByToken();
// if (!isLogin()) {
//     redirect('?module=auth&action=login');
// }
layouts('header', $title);
?>
<!-- Contact Start -->
<div class="container-fluid contact mt-5 py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1>Liên hệ</h1>
                        <!-- <p class="mb-4"> <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p> -->
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100"
                            style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3099.789645728231!2d105.78241507428781!3d20.969825689802057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad283b8f56cb%3A0xb1315454a742531b!2zODkgxJAuIFBow7luZyBIxrBuZywgUC4gUGjDumMgTGEsIE5hbSBU4burIExpw6ptLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e1!3m2!1svi!2s!4v1736608380576!5m2!1svi!2s"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <div class="col-lg-7">
                    <form id="contact-form" class="">
                        <input type="text" id="name" class="w-100 form-control border-0 py-3 mb-4" placeholder="Nhập tên của bạn">
                        <input type="email" id="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Nhập Email của bạn">
                        <textarea id="message" class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Nhập tin nhắn"></textarea>
                        <button id="send-to-admin-button" class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="button">Gửi</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x me-4"></i>
                        <div>
                            <h4>Địa chỉ</h4>
                            <p class="mb-2">89 Phùng Hưng - Hà Đông - Hà Nội - Việt Nam</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x me-4"></i>
                        <div>
                            <h4>Gmail</h4>
                            <p class="mb-2">phamthuthuythuyloi@gmail.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x me-4"></i>
                        <div>
                            <h4>Số điện thoại</h4>
                            <p class="mb-2">0383083743</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<?php
layouts('footer');
?>