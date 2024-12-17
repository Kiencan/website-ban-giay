<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = [
    'pageTitle' => 'Trang shop'
];

layouts('header', $title);

// Kiểm tra trạng thái đăng nhập
$user_id = getUserIdByToken();
if (!isLogin()) {
    redirect('?module=auth&action=login');
}
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
                <a href="#" class="text-white"><small class="text-white mx-2">Liên hệ</small>/</a>
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
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                            <?php
                            if (empty($user_id)) {
                                echo 0;
                            } else {
                                echo getRows("SELECT * FROM order_item WHERE customer_id = " . $user_id);
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
                                <li><a class="dropdown-item" href="#">Mục yêu thích</a></li>
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
    <h1 class="text-center text-white display-6">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100"
                            style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="" class="">
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
                        <input type="email" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
                        <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" placeholder="Your Message"></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">123 Street New York.USA</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">info@example.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
            <div class="row g-4">
                <div class="col-lg-3">
                    <a href="#">
                        <h1 class="text-primary mb-0">Fruitables</h1>
                        <p class="text-secondary mb-0">Fresh products</p>
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative mx-auto">
                        <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                        <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex justify-content-end pt-3">
                        <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Why People Like us!</h4>
                    <p class="mb-4">typesetting, remaining essentially unchanged. It was
                        popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                    <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Shop Info</h4>
                    <a class="btn-link" href="">About Us</a>
                    <a class="btn-link" href="">Contact Us</a>
                    <a class="btn-link" href="">Privacy Policy</a>
                    <a class="btn-link" href="">Terms & Condition</a>
                    <a class="btn-link" href="">Return Policy</a>
                    <a class="btn-link" href="">FAQs & Help</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="d-flex flex-column text-start footer-item">
                    <h4 class="text-light mb-3">Account</h4>
                    <a class="btn-link" href="">My Account</a>
                    <a class="btn-link" href="">Shop details</a>
                    <a class="btn-link" href="">Shopping Cart</a>
                    <a class="btn-link" href="">Wishlist</a>
                    <a class="btn-link" href="">Order History</a>
                    <a class="btn-link" href="">International Orders</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-item">
                    <h4 class="text-light mb-3">Contact</h4>
                    <p>Address: 1429 Netus Rd, NY 48247</p>
                    <p>Email: Example@gmail.com</p>
                    <p>Phone: +0123 4567 8910</p>
                    <p>Payment Accepted</p>
                    <img src="img/payment.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid copyright bg-dark py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
            </div>
            <div class="col-md-6 my-auto text-center text-md-end text-white">
                <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
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