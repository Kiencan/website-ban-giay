<?php
if (!defined('_CODE')) {
  die('Access denied');
}
$filterAll = filter();

if (!empty($filterAll['id'])) {
  $id = $filterAll['id'];
  if ($id == 'bestSelling') {
    $categoryId = 15;
    // $condition = "WHERE isBestSelling = 1";
    // $totalShoes = getRows("SELECT * FROM products " . $condition);
  } else if ($id == 'discount') {
    $categoryId = 16;
    // $condition = "WHERE discount > 0";
    // $totalShoes = getRows("SELECT * FROM products " . $condition);
  } else if ($id == 'giayAdidas') {
    $categoryId = 10;
    // $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayNike') {
    $categoryId = 9;
    // $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayPuma') {
    $categoryId = 17;
    // $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayLining') {
    $categoryId = 18;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'giayAnta') {
    $categoryId = 19;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'quanao') {
    $categoryId = 20;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'phukien') {
    // $categoryId = 21;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'sandal') {
    $categoryId = 22;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'hangkhac') {
    $categoryId = 23;
    // $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  }
}

$category = oneRaw("SELECT * FROM category WHERE category_id = $categoryId");
// echo '<pre>';
// print_r($category);
// echo '</pre>';
$featuredProducts = getRaw("
  SELECT products.*
  FROM products
  INNER JOIN product_name ON products.p_name_id = product_name.p_name_id
  INNER JOIN collection ON product_name.collection_id = collection.collection_id
  INNER JOIN category ON collection.category_id = category.category_id
  " . $condition . "
  GROUP BY products.p_id
  ORDER BY RAND()
  LIMIT 3
");
// echo '<pre>';
// print_r($featuredProducts);
// echo '</pre>';
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
              <a href="?module=user&action=shop&id=giayNike" class="dropdown-item brand-filter" value="Nike">Giày Nike</a>
              <a href="?module=user&action=shop&id=giayPuma" class="dropdown-item brand-filter" value="Puma">Giày Puma</a>
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

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
  <h1 class="text-center text-white display-6"><?php echo $category['category_name'] ?></h1>
  <ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="?module=user&action=trangchu">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pages</a></li>
    <li class="breadcrumb-item active text-white"><?php echo $category['category_name'] ?></li>
  </ol>
</div>
<!-- Single Page Header End -->

<!-- Shoes Shop Start-->
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
                <div class="mb-3 brand-filters">
                  <h4>Additional</h4>
                  <?php
                  if ($categoryId == 15 || $categoryId == 16):
                  ?>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter active" id="Categories-all" name="Categories-1" value="" data-brand="<?php echo $categoryId ?>" checked>
                      <label for="Categories-all">All</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-1" name="Categories-1" value="Adidas">
                      <label for="Categories-1"> Adidas</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-2" name="Categories-1" value="Nike">
                      <label for="Categories-2"> Nike</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-3" name="Categories-1" value="Puma">
                      <label for="Categories-3"> Puma</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-4" name="Categories-1" value="Lining">
                      <label for="Categories-4"> Lining</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-5" name="Categories-1" value="Anta">
                      <label for="Categories-5"> Anta</label>
                    </div>
                  <?php
                  else:
                  ?>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter active" id="Categories-all" name="Categories-1" value="" data-brand="<?php echo $categoryId ?>" checked>
                      <label for="Categories-all">All</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-1" name="Categories-1" value="Adidas">
                      <label for="Categories-1"> Adidas</label>
                    </div>
                    <div class="mb-2">
                      <input type="radio" class="me-2 brand-filter" id="Categories-2" name="Categories-1" value="Nike">
                      <label for="Categories-2"> Nike</label>
                    </div>
                  <?php
                  endif
                  ?>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3 price-filters">
                  <h4 class="mb-2">Giá</h4>
                  <div class="mb-2">
                    <input type="radio" class="me-2 price-filter active" id="Categories" name="Categories-2" value="" checked>
                    <label for="Categories">All</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2 price-filter" id="Categories-6" name="Categories-2" value="1000000-3000000">
                    <label for="Categories-6"> 1.000.000 - 3.000.000</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2 price-filter" id="Categories-7" name="Categories-2" value="3000000-5000000">
                    <label for="Categories-7"> 3.000.000 - 5.000.000</label>
                  </div>
                  <div class="mb-2">
                    <input type="radio" class="me-2 price-filter" id="Categories-8" name="Categories-2" value="5000000-1000000000">
                    <label for="Categories-8"> Trên 5 triệu</label>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <h4 class="mb-3">Sản phẩm nổi bật</h4>
                <?php
                if (!empty($featuredProducts)):
                  foreach ($featuredProducts as $product):
                    $img = oneRaw("SELECT * FROM product_image WHERE p_id = '" . $product['p_id'] . "'");
                ?>
                    <div class="d-flex align-items-center justify-content-start mb-3">
                      <div class="rounded me-4" style="width: 100px; height: 100px;">
                        <img src="<?php echo _WEB_HOST_TEMPLATE . '/image/' . $img['product_image'] ?>" class="img-fluid rounded" alt="<?php echo $product['p_name_custom']; ?>">
                      </div>
                      <div>
                        <h6 class="mb-2"><?php echo $product['p_name_custom']; ?></h6>
                        <div class="d-flex mb-2">
                          <h5 class="fw-bold me-2"><?php echo number_format($product['p_price_min'], 0, ',', '.'); ?> đ</h5>
                          <?php if (!empty($product['p_price_max'])): ?>
                            <h5 class="text-danger text-decoration-line-through">
                              <?php echo number_format($product['p_price_max'], 0, ',', '.'); ?> đ
                            </h5>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php
                  endforeach;
                else:
                  ?>
                  <p class="text-muted">Không có sản phẩm nào để hiển thị.</p>
                <?php endif; ?>
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
              <div class="row g-4 justify-content-center products" id="product-container"></div>
              <!-- Product container -->
              <!-- <div id="product-container" class="products"></div> -->
              <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5" id="pagination">
                  <!-- Hide pagination -->
                  <!-- <a href="#" id="prev-page" class="btn rounded" display="none">&laquo; Previous</a>
                  <div id="page-links" class="page-links"></div>
                  <a href="#" id="next-page" class="btn rounded" display="none">Next &raquo;</a> -->
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
          Tại 3H1A Store, chúng tôi mang đến những đôi giày chất lượng cao với mẫu mã đa dạng, từ năng động đến thanh lịch. Mỗi sản phẩm đều được chọn lọc kỹ lưỡng, đảm bảo bền bỉ và thoải mái.
          Giá cả hợp lý kèm nhiều ưu đãi.
          Dịch vụ tận tâm, giúp bạn tìm được đôi giày ưng ý.
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
          <a class="btn-link" href="?module=user&action=contact">Liên hệ</a>
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