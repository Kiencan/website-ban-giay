<?php
if (!defined('_CODE')) {
  die('Access denied');
}
$filterAll = filter();

if (!empty($filterAll['id'])) {
  $id = $filterAll['id'];
  if ($id == 'bestSelling') {
    $categoryId = 15;
  } else if ($id == 'discount') {
    $categoryId = 16;
  } else if ($id == 'giayAdidas') {
    $categoryId = 10;
  } else if ($id == 'giayNike') {
    $categoryId = 9;
  } else if ($id == 'giayPuma') {
    $categoryId = 17;
  } else if ($id == 'giayLining') {
    $categoryId = 18;
  } else if ($id == 'giayAnta') {
    $categoryId = 19;
  } else if ($id == 'quanao') {
    $categoryId = 20;
  } else if ($id == 'phukien') {
    $categoryId = 21;
  } else if ($id == 'sandal') {
    $categoryId = 22;
  }
}

$category = oneRaw("SELECT * FROM category WHERE category_id = $categoryId");

$title = [
  'pageTitle' => 'Trang ' . $category['category_name']
];

layouts('header', $title);
$user_id = getUserIdByToken();
// Kiểm tra trạng thái đăng nhập

// if (!isLogin()) {
//   redirect('?module=auth&action=login');
// }
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
            <div class="d-flex flex-column gap-1" style="width: 130px;">
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
      <div class="modal-body d-flex align-items-center">
        <div class="input-group w-75 mx-auto d-flex">
          <input
            type="search"
            class="form-control p-3"
            placeholder="Nhập tại đây"
            aria-describedby="search-icon-1" />
          <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Search End -->

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
  <h1 class="text-center text-white display-6"><?php echo $category['category_name'] ?></h1>
  <ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pages</a></li>
    <li class="breadcrumb-item active text-white"><?php echo $category['category_name'] ?></li>
  </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid item py-5">
  <div class="container py-5">
    <h1 class="mb-4"><?php echo $category['category_name'] ?></h1>
    <div class="row g-4">
      <div class="col-lg-12">
        <div class="row g-4">
          <div class="col-xl-3">
            <div class="input-group w-100 mx-auto d-flex">
              <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
              <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
            </div>
          </div>
          <div class="col-6"></div>
          <div class="col-xl-3">
            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
              <label for="fruits">Bán chạy:</label>
              <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                <option value="volvo">Sale up 25%</option>
                <option value="saab">Sale up 50%</option>
                <option value="opel">Sale up 75%</option>
                <option value="audi">Sale up 100%</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-lg-3">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4>Collection</h4>
                  <ul class="list-unstyled item-categorie">
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Giày 1</a>
                        <span>(3)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Giày 1</a>
                        <span>(5)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Giày 1</a>
                        <span>(2)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Giày 1</a>
                        <span>(8)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Giày 1</a>
                        <span>(5)</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4 class="mb-2">Giá</h4>
                  <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                  <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4>Additional</h4>
                  <div class="mb-2">
                    <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Beverages">
                    <label for="Categories-1"> Adidas</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Beverages">
                    <label for="Categories-2"> Nike</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Beverages">
                    <label for="Categories-3"> Puma</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Beverages">
                    <label for="Categories-4"> Lining</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Beverages">
                    <label for="Categories-5"> Alta</label>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <h4 class="mb-3">Featured products</h4>
                <div class="d-flex align-items-center justify-content-start">
                  <div class="rounded me-4" style="width: 100px; height: 100px;">
                    <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-1.jpg" class="img-fluid rounded" alt="">
                  </div>
                  <div>
                    <h6 class="mb-2">Sneaker</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-start">
                  <div class="rounded me-4" style="width: 100px; height: 100px;">
                    <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-2.jpg" class="img-fluid rounded" alt="">
                  </div>
                  <div>
                    <h6 class="mb-2">Sneaker</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                    </div>
                  </div>
                </div>
                <div class="d-flex align-items-center justify-content-start">
                  <div class="rounded me-4" style="width: 100px; height: 100px;">
                    <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-3.jpg" class="img-fluid rounded" alt="">
                  </div>
                  <div>
                    <h6 class="mb-2">Sneaker</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                  <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="position-relative">
                  <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                  <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                    <h3 class="text-secondary fw-bold">Adidas <br> Nike <br> Lining</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="tab-content">
              <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-6 col-xl-4">
                  <div class="rounded position-relative my-item">
                    <div class="img-item">
                      <img src="<?php echo _WEB_HOST_TEMPLATE ?>/image/giay5.jpg" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Giày Adidas</div>
                    <div class="p-4 border-top-0 rounded-bottom">
                      <h4>Giày Adidas Duramo</h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                      <div class="d-flex justify-content-between flex-lg-wrap">
                        <p>
                          <span style="text-decoration: line-through">2.500.00đ</span>
                          <span style="font-weight: bold; color: black">1.499.000đ</span>
                        </p>
                        <div class="product-actions">
                          <a
                            href="#"
                            class="btn border border-secondary rounded-circle p-auto me-2"
                            style="
                                          background-color: rgb(255, 255, 255);
                                          color: #4856dd;
                                          width: 40px;
                                          height: 40px;">
                            <i class="fa fa-heart"></i>
                          </a>
                          <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
                $totalShoes = 54;
                $numberShoes = 9;
                $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $totalPages = ceil($totalShoes / $numberShoes);
                for ($i = 1; $i < $numberShoes; $i++):
                ?>
                  <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="rounded position-relative my-item">
                      <div class="img-item">
                        <img src="<?php echo _WEB_HOST_TEMPLATE ?>\image\giay5.jpg" class="img-fluid w-100 rounded-top" alt="">
                      </div>
                      <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Giày Adidas</div>
                      <div class="p-4 border-top-0 rounded-bottom">
                        <h4>Giày Adidas Duramo</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p>
                            <span style="text-decoration: line-through">2.500.000đ</span>
                            <span style="font-weight: bold; color: black">1.499.000đ</span>
                          </p>
                          <div class="product-actions">
                            <a href="#" class="btn border border-secondary rounded-circle p-auto me-2" style="background-color: rgb(255, 255, 255); color: #4856dd; width: 40px; height: 40px;">
                              <i class="fa fa-heart"></i>
                            </a>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endfor; ?>
                <div class="col-12">
                  <div class="pagination d-flex justify-content-center mt-5">
                    <a href="?module=user&action=shop&id=<?php echo $id ?>&page=<?php echo max(1, $currentPage - 1); ?>" class="btn rounded <?php echo ($currentPage == 1) ? 'disabled' : ''; ?>">&laquo;</a>
                    <?php
                    for ($i = 1; $i <= $totalPages; $i++):
                    ?>
                      <a href="?module=user&action=shop&id=<?php echo $id ?>&page=<?php echo $i ?>" class="btn rounded <?php echo $i == $currentPage ? 'active' : '' ?>"><?php echo $i ?></a>
                    <?php
                    endfor;
                    ?>
                    <a href="?module=user&action=shop&id=<?php echo $id ?>&page=<?php echo min($totalPages, $currentPage + 1); ?>" class="btn rounded <?php echo ($currentPage == $totalPages) ? 'disabled' : ''; ?>">&raquo;</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Fruits Shop End-->

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
  class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>

<?php
layouts('footer');
?>