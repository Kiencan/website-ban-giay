<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Trang chủ 3H1A Store'
];

layouts('header', $title);

// Kiểm tra trạng thái đăng nhập

// if (!isLogin()) {
//   redirect('?module=auth&action=login');
// }

# Lấy userId
$user_id = getUserIdByToken();

$listBanner = getRaw("SELECT * FROM banner ORDER BY id");
$listProd = getRaw("SELECT * FROM products")

?>

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
          <a href="?module=user&action=cart" class="position-relative me-4 my-auto">
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

<!-- Hero Start -->
<div
  class="container-fluid py-5 mb-5 hero-header">
  <div class="container py-5">
    <div class="row g-5 align-items-center">
      <div class="col-md-12 col-lg-7">
        <h4 class="mb-3" style="color: black; font-size: 0.85em">
          Chuyên cung cấp các loại giày thể thao, sneaker, giày chạy bộ
          <br />Chuẩn authentic, đa dạng mẫu mã, giá rẻ bao thị trường.
        </h4>
        <h1 class="mb-5 display-3" style="color: #4856dd">
          3H1A Store
          <br />
          Modern & Fashion
        </h1>
        <div class="position-relative mx-auto">
          <a
            href="#banchay"
            class="btn btn-dark py-3 px-4 rounded-pill text-white"
            style="
                  background-color: black;
                  border: none;
                  text-decoration: none;
                ">
            Mua ngay
          </a>
        </div>
      </div>
      <div class="col-md-12 col-lg-5">
        <div
          id="carouselId"
          class="carousel slide position-relative"
          data-bs-ride="carousel">

          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $listBanner[1]['banner'] ?>"
                class="img-fluid w-100 h-100 rounded"
                alt="First slide" />
            </div>
            <?php
            if (!empty($listBanner)):
              for ($i = 2; $i < count($listBanner); $i++):
            ?>
                <div class="carousel-item rounded">
                  <img
                    src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $listBanner[$i]['banner'] ?>"
                    class="img-fluid w-100 h-100 rounded"
                    alt="Second slide" />
                </div>
            <?php
              endfor;
            endif;
            ?>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselId"
            data-bs-slide="prev"
            style="background-color: black">
            <span
              class="carousel-control-prev-icon"
              aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselId"
            data-bs-slide="next"
            style="background-color: black">
            <span
              class="carousel-control-next-icon"
              aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Hero End -->

<!-- Featurs Section Start -->
<div class="container-fluid featurs py-5">
  <div class="container py-5">
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="featurs-item text-center rounded bg-light p-4">
          <div
            class="featurs-icon btn-square rounded-circle mb-5 mx-auto"
            style="background-color: #4856dd">
            <i class="fas fa-car-side fa-3x text-white"></i>
          </div>
          <div class="featurs-content text-center">
            <h5>Miễn phí vận chuyển</h5>
            <p class="mb-0">Miễn phí vận chuyển toàn quốc</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="featurs-item text-center rounded bg-light p-4">
          <div
            class="featurs-icon btn-square rounded-circle mb-5 mx-auto"
            style="background-color: #4856dd">
            <i class="fas fa-user-shield fa-3x text-white"></i>
          </div>
          <div class="featurs-content text-center">
            <h5>Thanh toán bảo mật</h5>
            <p class="mb-0">100% cọc trước khi order</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="featurs-item text-center rounded bg-light p-4">
          <div
            class="featurs-icon btn-square rounded-circle mb-5 mx-auto"
            style="background-color: #4856dd">
            <i class="fas fa-exchange-alt fa-3x text-white"></i>
          </div>
          <div class="featurs-content text-center">
            <h5>Chính sách hoàn trả</h5>
            <p class="mb-0">Hoàn trả khi lỗi, không đúng size</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="featurs-item text-center rounded bg-light p-4">
          <div
            class="featurs-icon btn-square rounded-circle mb-5 mx-auto"
            style="background-color: #4856dd">
            <i class="fa fa-phone-alt fa-3x text-white"></i>
          </div>
          <div class="featurs-content text-center">
            <h5>Hỗ trợ 24/7</h5>
            <p class="mb-0">Hỗ trợ khách hàng mọi lúc mọi nơi</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Featurs Section End -->

<!-- Bán chạy Start-->
<div class="container-fluid item py-5" id="banchay">
  <div class="container">
    <div class="tab-class text-center">
      <div class="row g-4">
        <div class="col-lg-4 text-start">
          <h1>Bán chạy</h1>
        </div>
        <div class="col-lg-8 text-end">
          <ul class="nav nav-pills d-inline-flex text-center mb-5">
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill active"
                data-bs-toggle="pill"
                href="#tab-1">
                <span class="text-dark" style="width: 130px">Giày Sneaker</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex py-2 m-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-2">
                <span class="text-dark" style="width: 130px">Quần áo</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-3">
                <span class="text-dark" style="width: 130px">Sandal</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-4">
                <span class="text-dark" style="width: 130px">Phụ kiện</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-5">
                <span class="text-dark" style="width: 130px">Dép</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="tab-content">
        <div id="tab-1" class="tab-pane fade show p-0 active">
          <div class="row g-4">
            <div class="col-lg-12">
              <div class="row g-4">
                <?php
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1 LIMIT 4");
                foreach ($listBS as $key => $value):
                  $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
                ?>
                  <div class="col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center" style="cursor: pointer;">
                    <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>">
                      <div class="rounded position-relative my-item">
                        <div class="img-item">
                          <img
                            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $img['product_image'] ?>"
                            class="img-fluid w-100 rounded-top"
                            alt="" />
                        </div>
                        <div
                          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                          style="top: 10px; left: 10px;">
                          <?php echo $value['category_name'] ?>
                        </div>
                        <div class="p-4 border-top-0 rounded-bottom">
                          <h4><?php echo $value['p_name_custom'] ?></h4>
                          <p style="color: grey">
                            Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
                          </p>
                          <span style="font-weight: bold; color: black">
                            <?php
                            echo number_format($value['p_price_min'], 0, ',', '.') . ' VNĐ - ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                            ?>
                          </span>
                          <div class="d-flex justify-content-center flex-wrap">
                            <a
                              href="#"
                              class="btn border border-secondary rounded-circle p-auto me-2"
                              style="
                          background-color: rgb(255, 255, 255);
                          color: white;
                          width: 40px;
                          height: 40px;
                        ">
                              <i class="fa fa-heart"></i>
                              <!-- Icon trái tim -->
                            </a>
                            <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                              <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a
              href="?module=user&action=shop&id=bestSelling"
              class="btn"
              style="color: white; background-color: rgba(0, 0, 0, 0.4); text-align: center;">Xem thêm
            </a>
          </div>
        </div>

        <div id="tab-2" class="tab-pane fade show p-0">
          <div class="row g-4">
            <div class="col-lg-12">
              <div class="row g-4">
                <?php
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1 LIMIT 4");
                foreach ($listBS as $key => $value):
                  $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
                ?>
                  <div class="col-md-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                    <a href="?module=user&action=shop-detail&id=<?php echo $value['p_id'] ?>">
                      <div class="rounded position-relative my-item">
                        <div class="img-item">
                          <img
                            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $img['product_image'] ?>"
                            class="img-fluid w-100 rounded-top"
                            alt="" />
                        </div>
                        <div
                          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                          style="top: 10px; left: 10px">
                          <?php echo $value['category_name'] ?>
                        </div>
                        <div class="p-4 border-top-0 rounded-bottom">
                          <h4><?php echo $value['p_name_custom'] ?></h4>
                          <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit sed do eiusmod te incididunt
                          </p>
                          <p>
                            <span style="font-weight: bold; color: black">
                              <?php
                              echo number_format($value['p_price_min'], 0, ',', '.') . ' VNĐ - ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                              ?>
                            </span>
                          </p>
                          <div class="d-flex justify-content-between flex-lg-wrap">
                            <a
                              href="#"
                              class="btn border border-secondary rounded-circle p-auto me-2"
                              style="
                              background-color: rgb(255, 255, 255);
                              color: white;
                              width: 40px;
                              height: 40px;
                            ">
                              <i class="fa fa-heart"></i>
                              <!-- Icon trái tim -->
                            </a>

                            <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                              <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a
              href="?module=user&action=shop&id=bestSelling"
              class="btn"
              style="color: white; background-color: rgba(0, 0, 0, 0.4)">Xem thêm</a>
          </div>
        </div>
        <div id="tab-3" class="tab-pane fade show p-0">
          <div class="row g-4">
            <div class="col-lg-12">
              <div class="row g-4">
                <?php
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1 LIMIT 4");
                foreach ($listBS as $key => $value):
                  $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
                ?>
                  <div class="col-md-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                    <a href="?module=user&action=shop-detail&id=<?php echo $value['p_id'] ?>">
                      <div class="rounded position-relative my-item">
                        <div class="img-item">
                          <img
                            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $img['product_image'] ?>"
                            class="img-fluid w-100 rounded-top"
                            alt="" />
                        </div>
                        <div
                          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                          style="top: 10px; left: 10px">
                          <?php echo $value['category_name'] ?>
                        </div>
                        <div class="p-4 border-top-0 rounded-bottom">
                          <h4><?php echo $value['p_name_custom'] ?></h4>
                          <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit sed do eiusmod te incididunt
                          </p>
                          <p>
                            <span style="font-weight: bold; color: black">
                              <?php
                              echo number_format($value['p_price_min'], 0, ',', '.') . 'VNĐ - ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                              ?>
                            </span>
                          </p>
                          <div class="d-flex justify-content-between flex-lg-wrap">
                            <a
                              href="#"
                              class="btn border border-secondary rounded-circle p-auto me-2"
                              style="
                              background-color: rgb(255, 255, 255);
                              color: white;
                              width: 40px;
                              height: 40px;
                            ">
                              <i class="fa fa-heart"></i>
                              <!-- Icon trái tim -->
                            </a>

                            <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                              <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a
              href="?module=user&action=shop&id=bestSelling"
              class="btn"
              style="color: white; background-color: rgba(0, 0, 0, 0.4)">Xem thêm</a>
          </div>
        </div>
        <div id="tab-4" class="tab-pane fade show p-0">
          <div class="row g-4">
            <div class="col-lg-12">
              <div class="row g-4">
                <?php
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1 LIMIT 4");
                foreach ($listBS as $key => $value):
                  $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
                ?>
                  <div class="col-md-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                    <a href="?module=user&action=shop-detail&id=<?php echo $value['p_id'] ?>">
                      <div class="rounded position-relative my-item">
                        <div class="img-item">
                          <img
                            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $img['product_image'] ?>"
                            class="img-fluid w-100 rounded-top"
                            alt="" />
                        </div>
                        <div
                          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                          style="top: 10px; left: 10px">
                          <?php echo $value['category_name'] ?>
                        </div>
                        <div class="p-4 border-top-0 rounded-bottom">
                          <h4><?php echo $value['p_name_custom'] ?></h4>
                          <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit sed do eiusmod te incididunt
                          </p>
                          <p>
                            <span style="font-weight: bold; color: black">
                              <?php
                              echo number_format($value['p_price_min'], 0, ',', '.') . ' VNĐ - ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                              ?>
                            </span>
                          </p>
                          <div class="d-flex justify-content-between flex-lg-wrap">
                            <a
                              href="#"
                              class="btn border border-secondary rounded-circle p-auto me-2"
                              style="
                              background-color: rgb(255, 255, 255);
                              color: white;
                              width: 40px;
                              height: 40px;
                            ">
                              <i class="fa fa-heart"></i>
                              <!-- Icon trái tim -->
                            </a>

                            <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                              <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a
              href="?module=user&action=shop&id=bestSelling"
              class="btn"
              style="color: white; background-color: rgba(0, 0, 0, 0.4)">Xem thêm</a>
          </div>
        </div>
        <div id="tab-5" class="tab-pane fade show p-0">
          <div class="row g-4">
            <div class="col-lg-12">
              <div class="row g-4">
                <?php
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1 LIMIT 4");
                foreach ($listBS as $key => $value):
                  $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
                ?>
                  <div class="col-md-6 col-lg-4 col-xl-3" style="cursor: pointer;">
                    <a href="?module=user&action=shop-detail&id=<?php echo $value['p_id'] ?>">
                      <div class="rounded position-relative my-item">
                        <div class="img-item">
                          <img
                            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $img['product_image'] ?>"
                            class="img-fluid w-100 rounded-top"
                            alt="" />
                        </div>
                        <div
                          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                          style="top: 10px; left: 10px">
                          <?php echo $value['category_name'] ?>
                        </div>
                        <div class="p-4 border-top-0 rounded-bottom">
                          <h4><?php echo $value['p_name_custom'] ?></h4>
                          <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit sed do eiusmod te incididunt
                          </p>
                          <p>
                            <span style="font-weight: bold; color: black">
                              <?php
                              echo number_format($value['p_price_min'], 0, ',', '.') . ' VNĐ- ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                              ?>
                            </span>
                          </p>
                          <div class="d-flex justify-content-between flex-lg-wrap">
                            <a
                              href="#"
                              class="btn border border-secondary rounded-circle p-auto me-2"
                              style="
                              background-color: rgb(255, 255, 255);
                              color: white;
                              width: 40px;
                              height: 40px;
                            ">
                              <i class="fa fa-heart"></i>
                              <!-- Icon trái tim -->
                            </a>

                            <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                              <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                            </a>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                endforeach;
                ?>
              </div>
            </div>
          </div>
          <div class="text-end mt-3">
            <a
              href="?module=user&action=shop&id=bestSelling"
              class="btn"
              style="color: white; background-color: rgba(0, 0, 0, 0.4)">Xem thêm</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Bán chạy End-->

<!-- Featurs Start -->
<div class="container-fluid service py-5">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <?php
      for ($i = 0; $i < 6; $i++):
      ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 brand">
          <a href="link_to_your_product_1" class="img-link">
            <img
              src="https://cdn.shopify.com/s/files/1/0456/5070/6581/files/LP_D10_SAU_E.png?v=1727839574&width=1400"
              class="img-fluid"
              alt="Brand Logo" />
          </a>
        </div>
      <?php
      endfor;
      ?>
    </div>
  </div>
</div>
<!-- Featurs End -->

<!-- Giảm giá Start -->
<div class="container-fluid giamgia py-5">
  <div class="container py-5 position-relative">
    <h1 class="mb-0">Giảm giá</h1>
    <div class="owl-carousel vegetable-carousel justify-content-center text-center">
      <?php
      $listD = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE discount > 0");
      foreach ($listD as $key => $value):
        $imgD = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $value['p_id'] . "'");
      ?>
        <div class="rounded position-relative giamgia-item">
          <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>">
            <div class="img-item">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE . '/image/' . $imgD['product_image'] ?>"
                class="img-fluid w-100 rounded-top"
                alt="" />
            </div>
            <div
              class="text-white bg-secondary px-3 py-1 rounded position-absolute"
              style="top: 10px; left: 10px">
              <?php echo $value['category_name'] ?>
            </div>
            <div class="p-4 border-top-0 rounded-bottom">
              <h4><?php echo $value['p_name_custom'] ?></h4>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
                eiusmod te incididunt
              </p>
              <p>
                <span style="font-weight: bold; color: black">
                  <?php
                  echo number_format($value['p_price_min'], 0, ',', '.') . ' VNĐ - ' . number_format($value['p_price_max'], 0, ',', '.') . ' VNĐ';
                  ?>
                </span>
              </p>
              <div class="d-flex justify-content-between flex-lg-wrap">
                <a
                  href="#"
                  class="btn border border-secondary rounded-circle p-auto me-2"
                  style="
                  background-color: rgb(255, 255, 255);
                  color: white;
                  width: 40px;
                  height: 40px;
                ">
                  <i class="fa fa-heart"></i>
                  <!-- Icon trái tim -->
                </a>

                <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3">
                  <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                </a>
              </div>
            </div>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    </div>
    <div class="text-end mt-3">
      <a
        href="?module=user&action=shop&id=discount"
        class="btn"
        style="color: white; background-color: rgba(0, 0, 0, 0.4);">Xem thêm</a>
    </div>
  </div>
</div>

<!-- Giảm giá End -->

<!-- Banner Section Start-->
<div class="container-fluid banner bg-secondary my-5">
  <div class="container py-5">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <div class="py-4">
          <h1 class="display-3 text-white">Sneaker Authentic</h1>
          <p class="fw-normal display-3 text-dark mb-4">Đẳng cấp & thời thượng</p>
          <p class="mb-4 text-dark">
            The generated Lorem Ipsum is therefore always free from
            repetition injected humour, or non-characteristic words etc.
          </p>
          <a
            href="?module=user&action=cart"
            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Mua ngay</a>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="position-relative">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $listBanner[0]['banner'] ?>"
            class="img-fluid w-100 rounded"
            alt="" />
          <div
            class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
            style="width: 140px; height: 140px; top: 0; left: 0">
            <h1 style="font-size: 100px">1</h1>
            <div class="d-flex flex-column">
              <span class="h2 mb-0">Giảm 50%</span>
              <span class="h4 text-muted mb-0">đôi</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Banner Section End -->


<!-- Fact Start -->
<div class="container-fluid py-5">
  <div class="container">
    <div class="bg-light p-5 rounded">
      <div class="row g-4 justify-content-center">
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="counter bg-white rounded p-5">
            <i class="fa fa-users"></i>
            <h4>Khách hàng hài lòng</h4>
            <h1 style="font-family: 'Open Sans', sans-serif">1963</h1>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="counter bg-white rounded p-5">
            <i class="fa fa-users"></i>
            <h4>Chất lượng dịch vụ</h4>
            <h1 style="
                      font-family: 'Open Sans', sans-serif
                    ">99%</h1>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="counter bg-white rounded p-5">
            <i class="fa fa-users"></i>
            <h4>Chứng nhận chất lượng</h4>
            <h1 style="
                      font-family: 'Open Sans', sans-serif
                    ">5</h1>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="counter bg-white rounded p-5">
            <i class="fa fa-users"></i>
            <h4>Sản phẩm đang có sẵn</h4>
            <h1 style="
                      font-family: 'Open Sans', sans-serif
                    ">789</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Fact Start -->

<!-- Tastimonial Start -->
<div class="container-fluid testimonial py-5">
  <div class="container py-5">
    <div class="testimonial-header text-center">
      <h4 class="text-primary">Đánh giá</h4>
      <h1 class="display-5 mb-5 text-dark">Phản hồi khách hàng</h1>
    </div>
    <div class="owl-carousel testimonial-carousel">
      <div class="testimonial-item img-border-radius bg-light rounded p-4">
        <div class="position-relative">
          <i
            class="fa fa-quote-right fa-2x position-absolute"
            style="bottom: 30px; right: 0"></i>
          <div class="mb-4 pb-4 border-bottom border-secondary">
            <p class="mb-0">
              Lorem Ipsum is simply dummy text of the printing Ipsum has
              been the industry's standard dummy text ever since the 1500s,
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/testimonial-1.jpg"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Tên khách hàng</h4>
              <p class="m-0 pb-3">Nghề nghiệp</p>
              <div class="d-flex pe-5">
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="testimonial-item img-border-radius bg-light rounded p-4">
        <div class="position-relative">
          <i
            class="fa fa-quote-right fa-2x position-absolute"
            style="bottom: 30px; right: 0"></i>
          <div class="mb-4 pb-4 border-bottom border-secondary">
            <p class="mb-0">
              Lorem Ipsum is simply dummy text of the printing Ipsum has
              been the industry's standard dummy text ever since the 1500s,
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/testimonial-1.jpg"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Tên khách hàng</h4>
              <p class="m-0 pb-3">Nghề nghiệp</p>
              <div class="d-flex pe-5">
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="testimonial-item img-border-radius bg-light rounded p-4">
        <div class="position-relative">
          <i
            class="fa fa-quote-right fa-2x position-absolute"
            style="bottom: 30px; right: 0"></i>
          <div class="mb-4 pb-4 border-bottom border-secondary">
            <p class="mb-0">
              Lorem Ipsum is simply dummy text of the printing Ipsum has
              been the industry's standard dummy text ever since the 1500s,
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/testimonial-1.jpg"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Tên khách hàng</h4>
              <p class="m-0 pb-3">Nghề nghiệp</p>
              <div class="d-flex pe-5">
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
                <i class="fas fa-star text-secondary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Tastimonial End -->

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
              class="form-control border-0 w-100 py-3 px-4 rounded-pill"
              type="number"
              placeholder="Nhập email của bạn" />
            <button
              type="submit"
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
            style="color: aliceblue">Xem thêm
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="d-flex flex-column text-start footer-item">
          <h4 class="text-light mb-3">Thông tin</h4>
          <a class="btn-link" href="">Về chúng tôi</a>
          <a class="btn-link" href="">Liên hệ</a>
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
<a
  href="#"
  class="btn btn-dark border-3 border-dark rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
layouts('footer');
?>