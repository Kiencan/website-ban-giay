<?php
    session_start();
    if ((! isset($_SESSION['username']))) {
        header('location:login_test.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="templates/css/style.css" />
    <link rel="stylesheet" href="templates/css/header.css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;1,600&display=swap');
    </style>

</head>

<body>
    <div class="grid-container">
        <header class="header">
            <div class="mar-left"></div>
            <div class="middle">
                <div class="first-nav">
                    <div class="top-left">
                        <a href="#">Về chúng tôi</a>
                        <a href="#">Trở thành đối tác bán hàng 3H1A</a>
                        <a href="#">Liên hệ</a>
                        <a href="#">Chương trình</a>
                    </div>
                    <div class="top-right">
                        <a href="#">Ngôn ngữ</a>
                        <a href="#">Hỗ trợ</a>
                        <a href="#">Thông báo</a>
                    </div>
                </div>
                <div class="logo">
                    <a href="index.php">
                        <img src="./templates/image/logo.jpg" alt="" width="120px" />
                    </a>
                </div>
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="" name="" />
                    <a href="#" class="search-icon">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
                <div class="cart">
                    <a href="#">
                        <img src="./templates/image/cart.png" width="30px" />
                    </a>
                </div>
                <div class="last-nav">
                    <a href="#">Bán chạy</a>
                    <a href="#">Giảm giá</a>
                    <a href="new_balance.php">Sneaker</a>
                    <a href="#">Sandals</a>
                    <a href="#">Dép</a>
                    <a href="#">Quần áo</a>
                    <a href="#">Phụ kiện</a>
                </div>
            </div>
            <div class="mar-right">
                <div class='dang-xuat'><a href="logout_test.php">Đăng xuất</a></div>
            </div>
        </header>
        <div class="side-left"></div>
        <div class="content">
            <div class="banner">
                <div class="box-left">
                    <h2>
                        <span><strong>3H1A STORE</strong></span>
                        <br />
                        <span><strong>UY TÍN</strong></span>
                    </h2>
                    <p>
                        Chuyên cung cấp các loại giày thể thao, sneaker, giày chạy bộ
                        chuẩn authentic, đa dạng mẫu mã, giá rẻ bao thị trường.
                    </p>
                    <button>Mua ngay</button>
                </div>
                <div class="box-right">
                    <img src="./templates/image/top1.jpg" width="120" height="276" alt="" />
                    <img src="./templates/image/top2.jpg" width="150" height="350" alt="" />
                    <img src="./templates/image/top3.jpg" width="120" height="276" alt="" />
                </div>
                <div class="to-bottom">
                    <a href="#sneaker">
                        <img src="./templates/image/to_bottom.png" alt="Scroll to Section" />
                    </a>
                </div>
            </div>
            <main>
                <section class="slogan"></section>

                <section class="grid-sale" style="background-color: #075dd6;">
                    <div class="row1">
                        <div class="brand-sales">
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                            <div class="brand">
                                <img src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400">
                            </div>
                        </div>
                    </div>
                    <div class="row2">
                        <div class="col1">
                            <p>Kết thúc sau: </p>
                        </div>
                    </div>
                </section>
                <section class="sale-section" id="sneaker">
                    <h2>BÁN CHẠY</h2>
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="./templates/image/sneaker1.webp" alt="Sneaker 1" />
                            <p>Sneaker trắng</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker2.jpg" alt="Sneaker 2" />
                            <p>Sneaker đen</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                    </div>
                    <div class="to-right">
                        <a href="new_balance.html">
                            <img src="./templates/image/to_right.png" alt="" />
                        </a>
                    </div>
                </section>
                <section class="sale-section" id="sneaker">
                    <h2>GIẢM GIÁ</h2>
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="./templates/image/sneaker1.webp" alt="Sneaker 1" />
                            <p>Sneaker trắng</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker2.jpg" alt="Sneaker 2" />
                            <p>Sneaker đen</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                    </div>
                    <div class="to-right">
                        <a href="new_balance.html">
                            <img src="./templates/image/to_right.png" alt="" />
                        </a>
                    </div>
                </section>
                <section class="sale-section" id="sneaker">
                    <h2>SNEAKER</h2>
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="./templates/image/sneaker1.webp" alt="Sneaker 1" />
                            <p>Sneaker trắng</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker2.jpg" alt="Sneaker 2" />
                            <p>Sneaker đen</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                    </div>
                    <div class="to-right">
                        <a href="new_balance.html">
                            <img src="./templates/image/to_right.png" alt="" />
                        </a>
                    </div>
                </section>
                <section class="sale-section" id="sneaker">
                    <h2>SANDALS</h2>
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="./templates/image/sneaker1.webp" alt="Sneaker 1" />
                            <p>Sneaker trắng</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker2.jpg" alt="Sneaker 2" />
                            <p>Sneaker đen</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                    </div>
                    <div class="to-right">
                        <a href="new_balance.html">
                            <img src="./templates/image/to_right.png" alt="" />
                        </a>
                    </div>
                </section>
                <section class="sale-section" id="sneaker">
                    <h2>QUẦN ÁO</h2>
                    <div class="product-grid">
                        <div class="product-item">
                            <img src="./templates/image/sneaker1.webp" alt="Sneaker 1" />
                            <p>Sneaker trắng</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker2.jpg" alt="Sneaker 2" />
                            <p>Sneaker đen</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                        <div class="product-item">
                            <img src="./templates/image/sneaker3.avif" alt="Sneaker 3" />
                            <p>Sneaker xám</p>
                        </div>
                    </div>
                    <div class="to-right">
                        <a href="new_balance.html">
                            <img src="./templates/image/to_right.png" alt="" />
                        </a>
                    </div>
                </section>

                <section class="store-info">
                    <h2>3H1A Store In Ha Noi City</h2>
                    <p>
                        Tìm kiếm đôi giày sneaker yêu thích của bạn tại 3H1A Store, cửa
                        hàng giày sneaker và phụ kiện thời trang đường phố hàng đầu Việt
                        Nam. Tự hào phục vụ hơn 5000 khách hàng tại Hà Nội và toàn Việt
                        Nam từ 2022. Chúng tôi có đầy đủ các loại giày sneaker từ các
                        thương hiệu nổi tiếng nhất thế giới từ Nike, Adidas, Converse đến
                        New Balance, Jordan, Vans.v.v. Đội ngũ nhân viên thân thiện và
                        nhiệt tình sẽ giúp bạn tìm được đôi giày hoàn hảo cho phong cách
                        của mình.
                    </p>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/3h1a.store"><img src="./templates/image/fb-icon.png" alt="Facebook" /></a>
                        <a href="#"><img src="./templates/image/ins-icon.png" alt="Instagram" /></a>
                        <a href="#"><img src="./templates/image/zalo-icon.png" alt="Zalo" /></a>
                        <a href="#"><img src="./templates/image/tiktok-icon.png" alt="TikTok" /></a>
                    </div>
                </section>

                <section class="payment-shipping">
                    <h3>Phương Thức Thanh Toán</h3>
                    <p>Visa | Master Card | MOMO | Cash on Delivery</p>
                    <h3>Đối Tác Vận Chuyển</h3>
                    <p>
                        ShopeeExpress | Giaohangnhanh | Lalamove | Ahamove | GrabExpress
                    </p>
                </section>
            </main>
            <div class="trust">
                <a href="http://online.gov.vn/" target="_blank">
                    <img src="./templates/image/gov.png" width="160px" />
                </a>
            </div>
        </div>
        <div class="side-right">
            <div class="echbay-sms-messenger style-for-position-br">
                <div class="phonering-alo-alo">
                    <a href="tel:0387440192" rel="nofollow" class="echbay-phonering-alo-event">.</a>
                </div>
                <div class="phonering-alo-sms">
                    <a href="sms:0387440192" rel="nofollow" class="echbay-phonering-sms-event">..</a>
                </div>
                <div class="phonering-alo-zalo">
                    <a href="https://zalo.me/0387440192" target="_blank" rel="nofollow" class="echbay-phonering-zalo-event">.</a>
                </div>
                <div class="phonering-alo-messenger">
                    <a href="https://www.facebook.com/3h1a.store" target="_blank" rel="nofollow"
                        class="echbay-phonering-messenger-event">.</a>
                </div>
            </div>
        </div>
        <div class="footer">
            <p><b>3H1ASTORE.COM</b> || 2023</p>
        </div>
    </div>
</body>

</html>