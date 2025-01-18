<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Về chúng tôi'
];

# Lấy userId
$user_id = getUserIdByToken();

$listBanner = getRaw("SELECT * FROM banner ORDER BY id");
$listProd = getRaw("SELECT * FROM products");
$user_name = oneRaw("SELECT fullname FROM user WHERE user_id = '$user_id'");
echo $user_name['fullname'];

layouts('header', $title);
?>

<!-- ***** Main Banner Area Start ***** -->
<div class="page-heading about-page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <!-- <h2>Về chúng tôi</h2>
                        <span>3H1A Store – Điểm chạm phong cách, khẳng định đẳng cấp</span> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- ***** About Area Starts ***** -->
<div class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-image">
                    <img src="./templates/image/about_left_img.jpg" alt="" style="width: 570px; height: 422px;">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <h4>Giới thiệu về 3H1A Store</h4>
                    <span>Với sứ mệnh khẳng định phong cách và chất lượng, 3H1A Store không chỉ chú trọng đến sự đa dạng của mẫu mã mà còn đảm bảo nguồn gốc minh bạch và uy tín của từng sản phẩm</span>
                    <div class="quote">
                        <i class="fa fa-quote-left"></i>
                        <p> 3H1A Store – Chất riêng đẳng cấp, khẳng định phong cách thời thượng. Từ các thương hiệu thời trang đình đám trên thế giới, chúng tôi giúp bạn tự tin hơn trong từng bước đi và tỏa sáng hơn với phong cách riêng.</p>
                    </div>
                    <p>
                        Đến với 3H1A Store, bạn sẽ được trải nghiệm dịch vụ tư vấn tận tình, giúp bạn lựa chọn những món đồ phù hợp với cá tính và phong cách riêng. Đặt niềm tin vào chất lượng và dịch vụ, 3H1A Store là điểm đến lý tưởng cho những tín đồ thời trang yêu thích hàng hiệu chính hãng tại Việt Nam.
                    </p>
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-tiktok"></i></a></li>
                        <li><a href="#"><i class="fa fa-phone"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** About Area Ends ***** -->

<!-- ***** Our Team Area Starts ***** -->
<section class="our-team">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Thành viên</h2>
                    <span>Đội ngũ nhân sự tại 3H1A Store – Tận tâm, chuyên nghiệp, đầy nhiệt huyết

                    </span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item">
                    <div class="thumb">
                        <img src="./templates/image/avt_CEO.JPG">
                    </div>
                    <div class="down-content">
                        <h4>Nguyễn Thu Hà</h4>
                        <span>Nhà sáng lập, CEO</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item">
                    <div class="thumb">
                        <img src="./templates/image/hao.JPG">
                    </div>
                    <div class="down-content">
                        <h4>Nguyễn Nhật Hào</h4>
                        <span>Đồng sáng lập</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="team-item">
                    <div class="thumb">
                        <img src="./templates/image/thuy.JPG">
                    </div>
                    <div class="down-content">
                        <h4>Phạm Thu Thủy</h4>
                        <span>Vận hành</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Our Team Area Ends ***** -->

<!-- ***** Services Area Starts ***** -->
<section class="our-services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Dịch vụ của chúng tôi</h2>
                    <span>Tại 3H1A Store, chúng tôi không chỉ tập trung vào việc cung cấp sản phẩm thời trang chính hãng mà còn mang đến những dịch vụ vượt trội nhằm đem lại trải nghiệm mua sắm hoàn hảo nhất cho khách hàng</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-item">
                    <h4>Tư Vấn Cá Nhân Hóa</h4>
                    <p>Chúng tôi lắng nghe sở thích, nhu cầu và mục tiêu của bạn để đưa ra những gợi ý phù hợp nhất, từ giày dép, quần áo đến phụ kiện. Dù bạn đang tìm kiếm một set đồ lịch lãm cho sự kiện quan trọng hay phong cách năng động hàng ngày, đội ngũ của chúng tôi luôn đảm bảo bạn sẽ hài lòng và tự tin với lựa chọn của mình.</p>
                    <img src="./templates/image/service-01.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-item">
                    <h4>Xác Thực Chính Hãng</h4>
                    <p>Cam kết mang đến sản phẩm thời trang chính hãng là giá trị cốt lõi của 3H1A Store. Vì vậy, chúng tôi triển khai dịch vụ xác thực chính hãng cho mọi sản phẩm trước khi chúng được đưa đến tay khách hàng. Từ việc kiểm tra tem, mã QR đến việc đối chiếu chi tiết thiết kế, đội ngũ 3H1A Store luôn làm việc tỉ mỉ, cẩn trọng.</p>
                    <img src="./templates/image/service-02.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-item">
                    <h4>Giao Hàng Nhanh</h4>
                    <p>Đơn hàng của bạn sẽ được đóng gói cẩn thận và vận chuyển đến tay trong thời gian sớm nhất. Nếu có bất kỳ vấn đề nào về sản phẩm, vui lòng thông báo, đội ngũ chăm sóc khách hàng sẽ luôn sẵn sàng giải quyết một cách tận tình và nhanh chóng, đảm bảo quyền lợi tối đa cho bạn.</p>
                    <img src="./templates/image/service-03.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Services Area Ends ***** -->

<!-- ***** Subscribe Area Starts ***** -->
<div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2>Gửi tin nhắn cho chúng tôi để nhận mã giảm giá 30% </h2>
                    <span>Gửi tin nhắn ngay cho chúng tôi để nhận mã giảm giá 30% và sở hữu những sản phẩm thời trang chính hãng với mức giá cực kỳ hấp dẫn. Đừng bỏ lỡ cơ hội này – số lượng ưu đãi có hạn!</span>
                </div>
                <form id="subscribe" action="" method="get">
                    <div class="row">
                        <div class="col-lg-5">
                            <fieldset>
                                <input type="hidden" name="name" id="name" value="<?php echo $user_name['fullname'] ?>" />
                                <input name="message" type="text" id="message" placeholder="Nhập tin nhắn" required="">
                            </fieldset>
                        </div>
                        <div class="col-lg-5">
                            <fieldset>
                                <input name="email" type="text" id="email" placeholder="Nhập email của bạn" required="">
                            </fieldset>
                        </div>
                        <div class="col-lg-2">
                            <fieldset>
                                <button type="button" id="send-to-admin-button" class="main-dark-button"><i class="fa fa-paper-plane"></i></button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li>Vị trí:<br><span>89 Phùng Hưng, Hà Đông, Hà Nội, Việt Nam</span></li>
                            <li>Số điện thoại:<br><span>0383083743</span></li>
                            <li>Văn phòng:<br><span>3H1A Store</span></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li>Giờ làm việc:<br><span>07:30 - 21:30 hàng ngày</span></li>
                            <li>Email:<br><span>phamthuthuy_t66@hus.edu.vn</span></li>
                            <li>Social Media:<br><span><a href="#">Facebook</a>, <a href="#">TikTok</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Subscribe Area Ends ***** -->

<?php
layouts('footer');
?>