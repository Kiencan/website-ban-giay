<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$user_id = getUserIdByToken();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <title><?php echo !empty($title['pageTitle']) ? $title['pageTitle'] : '3H1A Store'; ?></title>
  <link rel="icon" type="image/png" href="<?php echo _WEB_HOST_TEMPLATE ?>/image/favicon-96x96.png" sizes="96x96">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/search.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/style.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/header.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/shop-detail.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/about.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/profile.css" rel="stylesheet" />
</head> 

<body>
    <!-- Spinner Start -->
  <div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
  </div>
  <!-- Spinner End -->

  <!-- Navbar start -->
  <div class="container-fluid fixed-top">
    <div
      class="container topbar d-none d-lg-block mb-3"
      style="background-color:rgb(0, 0, 0)">
      <div class="d-flex justify-content-between">
        <div class="top-info ps-2">
          <a href="?module=user&action=about" class="text-white"><small class="text-white mx-2">Về chúng tôi</small>/</a>
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
    <div class="container px-0 mt-3">
      <nav class="navbar navbar-light bg-white navbar-expand-xl">
        <a href="?module=user&action=trangchu" class="navbar-brand">
        <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/logo.jpg" alt="logo" class = "img-fluid p-5 " width="200" height="200">
        </a>
        <button 
          class="navbar-toggler py-2 px-3"
          type="button" 
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse">
          <span class="fa fa-bars" style="color:rgb(0, 0, 0)"></span>
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
              <div class="dropdown-menu m-0 rounded-0">
                <a href="?module=user&action=shop&id=giayAdidas" class="dropdown-item">Giày Adidas</a>
                <a href="?module=user&action=shop&id=giayNike" class="dropdown-item">Giày Nike</a>
                <a href="??module=user&action=shop&id=giayPuma" class="dropdown-item">Giày Puma</a>
                <a href="?module=user&action=shop&id=giayLining" class="dropdown-item">Giày Lining</a>
                <a href="?module=user&action=shop&id=giayAnta" class="dropdown-item">Giày Anta</a>
                <a href="?module=user&action=shop&id=hangkhac" class="dropdown-item">Sản phẩm khác</a>
              </div>
            </div>
            <a href="?module=user&action=shop&id=quanao" class="nav-item nav-link">Quần áo</a>
            <a href="?module=user&action=shop&id=phukien" class="nav-item nav-link">Phụ kiện</a>
            <a href="?module=user&action=shop&id=sandal" class="nav-item nav-link">Sandal</a>
          </div>

          <div class="d-flex m-3 me-0">
            <button
              class="btn-search btn rounded-circle bg-white me-4 my-auto"
              data-bs-toggle="modal"
              data-bs-target="#searchModal"
              style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
              <i class="fas fa-search" style="color:rgb(0, 0, 0); font-size: 20px;"></i>
            </button>
            <a href="?module=user&action=cart" class="position-relative me-4 my-auto">
              <i class="fa fa-shopping-bag fa-2x" style="color:rgb(0, 0, 0)"></i>
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
                <a type="button" class="btn btn-dark btn-sm" href="?module=auth&action=login">Đăng nhập</a>
                <a type="button" class="btn btn-dark btn-sm" href="?module=auth&action=register">Đăng kí</a>
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
                  <i class="fas fa-user fa-2x" style="color:rgb(0, 0, 0)"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="?module=user&action=profile">Trang cá nhân</a></li>
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