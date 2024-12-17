<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Item detail'
];

layouts('header', $title);

// Kiểm tra trạng thái đăng nhập

// if (!isLogin()) {
//   redirect('?module=auth&action=login');
// }
$user_id = getUserIdByToken();
$filterAll = filter();
$product = oneRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE p_id = '" . $filterAll['p_id'] . "'");
$listImg = getRaw("SELECT * FROM product_image WHERE p_id = '" . $filterAll['p_id'] . "'");



// echo '<pre>';
// print_r($product);
// echo '</pre>';
?>
<!-- Spinner Start -->
<div
  id="spinner"
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
          <a href="?module=user&action=cart&id=<?php echo $user_id ?>" class="position-relative me-4 my-auto">
            <i class="fa fa-shopping-bag fa-2x" style="color: #4856dd"></i>
            <span
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

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
  <h1 class="text-center text-white display-6 text-primary">Sản phẩm</h1>
  <ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item">
      <a href="#">Trang chủ</a>
    </li>
    <li class="breadcrumb-item">
      <a href="#">Sneaker</a>
    </li>
    <li class="breadcrumb-item active text-white">Giày Adidas</li>
  </ol>
</div>
<!-- Single Page Header End -->

<!-- Single Product Start -->
<div class="container-fluid py-5 mt-5">
  <div class="container py-5">
    <div class="row g-4 mb-5">
      <div class="col-lg-8 col-xl-9">
        <div class="row g-4">
          <div class="col-lg-6">
            <div id="carouselId"
              class="carousel slide position-relative border rounded"
              data-bs-ride="carousel">
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active rounded">
                  <img src="<?php echo _WEB_HOST_TEMPLATE . '/image/' . $listImg[0]['product_image'] ?>"
                    class="img-fluid bg-secondary rounded"
                    alt="Ảnh 1"

                    style="cursor: pointer" />
                </div>
                <?php
                if (!empty($listImg)):

                  for ($i = 1; $i < count($listImg); $i++):
                ?>
                    <div class="carousel-item rounded">
                      <img
                        src="<?php echo _WEB_HOST_TEMPLATE . '/image/' . $listImg[$i]['product_image'] ?>"
                        class="img-fluid rounded"
                        alt="Ảnh <?= $i + 1 ?>"

                        style="cursor: pointer" />
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
            <p class="mb-3">Mã sản phẩm: <?php echo $filterAll['p_id']; ?></p>

          </div>

          <!-- Modal for enlarged image -->
          <div
            class="modal fade"
            id="imageModal"
            tabindex="-1"
            aria-labelledby="imageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ảnh đã nhấn</h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <img
                    id="modalImage"
                    src=""
                    class="img-fluid rounded"
                    alt="Modal Image" />
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <h4 class="fw-bold mb-3" id="imageModalLabel">
              <?php echo $product['collection_name'] . " " . $product['p_color']; ?>
            </h4>
            <p class="mb-3">Phân loại: <?php echo $product['category_name'] ?></p>
            <h5 class="fw-bold mb-3">
              <?php if ($product['discount'] > 0):
              ?>
                <span
                  style="
                      text-decoration: line-through;
                      font-family: 'Open Sans', sans-serif;
                      font-size: 15px;
                    "><?php

                      echo number_format($product['p_price_min'] * (100 - $product['discount']) / 100, 0, ',', '.') . " - " . number_format($product['p_price_max'] * (100 - $product['discount']) / 100, 0, ',', '.');

                      ?></span>
                <span
                  style="
                      font-weight: bold;
                      color: black;
                      font-family: 'Open Sans', sans-serif;
                    "><?php echo number_format($product['p_price_min'], 0, ',', '.') . " - " . number_format($product['p_price_max'], 0, ',', '.'); ?> VNĐ</span>
              <?php else: ?>
                <span
                  style="
                        font-weight: bold;
                        color: black;
                        font-family: 'Open Sans', sans-serif;
                      "><?php echo number_format($product['p_price_min'], 0, ',', '.') . " - " . number_format($product['p_price_max'], 0, ',', '.'); ?> VNĐ</span>
              <?php endif; ?>
            </h5>
            <div class="d-flex mb-4">
              <?php

              $full_stars = floor($product['p_rate']);

              $empty_stars = 5 - $full_stars;

              for ($i = 0; $i < $full_stars; $i++) {
                echo '<i class="fa fa-star text-secondary"></i>';
              }
              // Hiển thị sao trống
              for ($i = 0; $i < $empty_stars; $i++) {
                echo '<i class="fa fa-star"></i>';
              }
              ?>
            </div>
            <!-- <p class="mb-4">
                  The generated Lorem Ipsum is therefore always free from
                  repetition injected humour, or non-characteristic words etc.
                </p> -->

            <div class="type-giay">
              <span class="select-color mt-3">Màu sắc</span>
              <div class="container-product d-flex justify-content-start">
                <?php
                $listColor = getRaw("SELECT p_id, p_color FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id WHERE collection_id = " . $product["collection_id"]);
                foreach ($listColor as $color):
                  $image = oneRaw("SELECT product_image FROM product_image WHERE p_id = '" . $color["p_id"] . "'");

                ?>
                  <div class="product">
                    <a href="?module=user&action=shop-detail&p_id=<?php echo $color['p_id'] ?>">
                      <img src="<?php echo _WEB_HOST_TEMPLATE . "/image/" . $image["product_image"] ?>" alt="Product" class="product-image" style="width: 60px">
                      <p class="product-name"><?php echo $color["p_color"] ?></p>
                    </a>
                  </div>

                <?php
                endforeach;
                ?>

              </div>
            </div>

            <div class="chon-size">
              <span class="select-size mt-3">Kích thước</span>
              <div class="container-product d-flex justify-content-start p-3">
                <?php
                $sizeAvailable = explode(", ", $product['size_available']);
                $sizeNotAvailable = explode(", ", $product['size_not_available']);

                $size = array_merge($sizeAvailable, $sizeNotAvailable);
                sort($size);
                for ($i = 0; $i < count($size); $i++):
                  if ($size[$i] == ""):
                    continue;
                  endif;
                  if (in_array($size[$i], $sizeNotAvailable)):
                ?>
                    <button type="button" class="size" value="<?php echo $size[$i] ?>" disabled><?php echo $size[$i] ?></button>
                  <?php
                  else:
                  ?>
                    <button type="button" class="size" value="<?php echo $size[$i] ?>"><?php echo $size[$i] ?></button>
                <?php
                  endif;
                endfor;
                ?>

              </div>
              <span class="select-quantity pt-3 mt-3">Số lượng</span>
            </div>

            <div
              class="input-group quantity mb-3 mt-3"
              style="width: 100px">
              <div class="input-group-btn">
                <button
                  class="btn btn-sm btn-minus rounded-circle bg-light border">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
              <input
                type="number"
                class="form-control form-control-sm text-center border-0"
                value="1" />
              <div class="input-group-btn">
                <button
                  class="btn btn-sm btn-plus rounded-circle bg-light border">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-4 py-2 mb-4"
              style="color: #4856dd"><i class="fa fa-shopping-bag me-2" style="color: #4856dd"></i> Thêm vào giỏ hàng</a>
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-4 py-2 mb-4"
              style="color: #4856dd"><i class="fa fa-phone me-2" style="color: #4856dd"></i>Tư vấn:
              0383083743</a>
          </div>
          <div class="col-lg-12">
            <nav>
              <div class="nav nav-tabs mb-3">
                <button
                  class="nav-link active border-white border-bottom-0"
                  type="button"
                  role="tab"
                  id="nav-about-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-about"
                  aria-controls="nav-about"
                  aria-selected="true">
                  Mô tả
                </button>
                <button
                  class="nav-link border-white border-bottom-0"
                  type="button"
                  role="tab"
                  id="nav-mission-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#nav-mission"
                  aria-controls="nav-mission"
                  aria-selected="false">
                  Đánh giá
                </button>
              </div>
            </nav>
            <div class="tab-content mb-5">
              <div
                class="tab-pane active"
                id="nav-about"
                role="tabpanel"
                aria-labelledby="nav-about-tab">
                <p>
                  The generated Lorem Ipsum is therefore always free from
                  repetition injected humour, or non-characteristic words
                  etc. Susp endisse ultricies nisi vel quam suscipit
                </p>
                <p>
                  Sabertooth peacock flounder; chain pickerel hatchetfish,
                  pencilfish snailfish filefish Antarctic icefish goldeye
                  aholehole trumpetfish pilot fish airbreathing catfish,
                  electric ray sweeper.
                </p>
                <div class="px-2">
                  <div class="row g-4">
                    <div class="col-6">
                      <div
                        class="row bg-light align-items-center text-center justify-content-center py-2">
                        <div class="col-6">
                          <p class="mb-0">Weight</p>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">1 kg</p>
                        </div>
                      </div>
                      <div
                        class="row text-center align-items-center justify-content-center py-2">
                        <div class="col-6">
                          <p class="mb-0">Country of Origin</p>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">Agro Farm</p>
                        </div>
                      </div>
                      <div
                        class="row bg-light text-center align-items-center justify-content-center py-2">
                        <div class="col-6">
                          <p class="mb-0">Quality</p>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">Organic</p>
                        </div>
                      </div>
                      <div
                        class="row text-center align-items-center justify-content-center py-2">
                        <div class="col-6">
                          <p class="mb-0">Сheck</p>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">Healthy</p>
                        </div>
                      </div>
                      <div
                        class="row bg-light text-center align-items-center justify-content-center py-2">
                        <div class="col-6">
                          <p class="mb-0">Min Weight</p>
                        </div>
                        <div class="col-6">
                          <p class="mb-0">250 Kg</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="tab-pane"
                id="nav-mission"
                role="tabpanel"
                aria-labelledby="nav-mission-tab">
                <div class="d-flex">
                  <img
                    src="img/avatar.jpg"
                    class="img-fluid rounded-circle p-3"
                    style="width: 100px; height: 100px"
                    alt="" />
                  <div class="">
                    <p class="mb-2" style="font-size: 14px">
                      April 12, 2024
                    </p>
                    <div class="d-flex justify-content-between">
                      <h5>Jason Smith</h5>
                      <div class="d-flex mb-3" id="icon-start">
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                      </div>
                    </div>
                    <p>
                      The generated Lorem Ipsum is therefore always free
                      from repetition injected humour, or non-characteristic
                      words etc. Susp endisse ultricies nisi vel quam
                      suscipit
                    </p>
                  </div>
                </div>
                <div class="d-flex">
                  <img
                    src="img/avatar.jpg"
                    class="img-fluid rounded-circle p-3"
                    style="width: 100px; height: 100px"
                    alt="" />
                  <div class="">
                    <p class="mb-2" style="font-size: 14px">
                      April 12, 2024
                    </p>
                    <div class="d-flex justify-content-between">
                      <h5>Sam Peters</h5>
                      <div class="d-flex mb-3">
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-secondary"></i>
                        <i class="fa fa-star text-muted"></i>
                      </div>
                    </div>
                    <p class="text-dark">
                      The generated Lorem Ipsum is therefore always free
                      from repetition injected humour, or non-characteristic
                      words etc. Susp endisse ultricies nisi vel quam
                      suscipit
                    </p>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="nav-vision" role="tabpanel">
                <p class="text-dark">
                  Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                  tempor sit. Aliqu diam amet diam et eos labore. 3
                </p>
                <p class="mb-0">
                  Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam
                  et eos labore. Clita erat ipsum et lorem et sit
                </p>
              </div>
            </div>
          </div>
          <form action="#">
            <h4 class="mb-5 fw-bold">Đánh giá sản phẩm</h4>
            <div class="row g-4">
              <div class="col-lg-6">
                <div class="border-bottom rounded">
                  <input
                    type="text"
                    class="form-control border-0 me-4"
                    placeholder="Tên của bạn *" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="border-bottom rounded">
                  <input
                    type="email"
                    class="form-control border-0"
                    placeholder="Email *" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="border-bottom rounded my-4">
                  <textarea
                    name=""
                    id=""
                    class="form-control border-0"
                    cols="30"
                    rows="8"
                    placeholder="Đánh giá *"
                    spellcheck="false"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="d-flex justify-content-between py-3 mb-5">
                  <div class="d-flex align-items-center">
                    <p class="mb-0 me-3">Mức độ hài lòng:</p>
                    <div
                      class="d-flex align-items-center"
                      style="font-size: 12px">
                      <i class="fa fa-star text-muted"></i>
                      <i class="fa fa-star text-muted"></i>
                      <i class="fa fa-star text-muted"></i>
                      <i class="fa fa-star text-muted"></i>
                      <i class="fa fa-star text-muted"></i>
                    </div>
                  </div>
                  <a
                    href="#"
                    class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                    Bình luận</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-4 col-xl-3">
        <div class="row g-4 item">
          <div class="col-lg-12">
            <div class="input-group w-100 mx-auto d-flex mb-4">
              <input
                type="search"
                class="form-control p-3"
                placeholder="Nhập từ khóa"
                aria-describedby="search-icon-1" />
              <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
            </div>
            <div class="mb-4">
              <h4>Danh mục</h4>
              <ul class="list-unstyled item-categorie">
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=giayAdidas"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Adidas</a>
                    <span>(3)</span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=giayNike"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Nike</a>
                    <span>(5)</span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=giayPuma"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Puma</a>
                    <span>(2)</span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=giayLining"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Lining</a>
                    <span>(8)</span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=giayAnta"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Anta</a>
                    <span>(5)</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <h4 class="mb-4">Sản phẩm nổi bật</h4>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-start">
              <div class="rounded" style="width: 100px; height: 100px">
                <img
                  src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay4.jpg"
                  class="img-fluid rounded"
                  alt="Image" />
              </div>
              <div>
                <h6 class="mb-2">Giày Adidas Duramo </h6>
                <div class="d-flex mb-2">
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star text-secondary"></i>
                  <i class="fa fa-star"></i>
                </div>
                <div class="d-flex mb-2">
                  <h5 class="fw-bold me-2">1.500.000đ</h5>
                  <h5 class="text-danger text-decoration-line-through">
                    2.000.000đ
                  </h5>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-center my-4">
              <a
                href="#"
                class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem thêm</a>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="position-relative">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/banner-fruits.jpg"
                class="img-fluid w-100 rounded"
                alt="" />
              <div
                class="position-absolute"
                style="top: 50%; right: 10px; transform: translateY(-50%)">
                <h3 class="text-secondary fw-bold">
                  Sneaker <br />
                  Authentic <br />
                  Banner
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1 class="mb-5">Sản phẩm liên quan</h1>
    <div
      class="owl-carousel vegetable-carousel justify-content-center text-center">
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
      <div class="rounded position-relative giamgia-item">
        <div class="img-item">
          <img
            src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay3.jpg"
            class="img-fluid w-100 rounded-top"
            alt="" />
        </div>
        <div
          class="text-white bg-secondary px-3 py-1 rounded position-absolute"
          style="top: 10px; left: 10px">
          Giày sneaker
        </div>
        <div class="p-4 border-top-0 rounded-bottom">
          <h4>Giày Adidas Duramo</h4>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit sed do
            eiusmod te incididunt
          </p>
          <p>
            <span style="text-decoration: line-through">2.500.00đ</span>
            <span style="font-weight: bold; color: black">1.499.000đ</span>
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
            <a
              href="#"
              class="btn border border-secondary rounded-pill px-3"><i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Single Product End -->

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
            style="color: aliceblue">Xem thêm</a>
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