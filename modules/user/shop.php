<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Trang shop'
];

layouts('header', $title);

// Kiểm tra trạng thái đăng nhập

if (!isLogin()) {
  redirect('?module=auth&action=login');
}
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
    class="container topbar d-none d-lg-block"
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
          <a href="?module=user&action=shop" class="nav-item nav-link">Bán chạy</a>
          <a href="?module=user&action=shop" class="nav-item nav-link">Giảm giá</a>
          <div class="nav-item dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown">Sneaker</a>
            <div class="dropdown-menu m-0 bg-secondary rounded-0">
              <a href="?module=user&action=giayAdidas" class="dropdown-item">Giày Adidas</a>
              <a href="?module=user&action=giayNike" class="dropdown-item">Giày Nike</a>
              <a href="??module=user&action=giayPuma" class="dropdown-item">Giày Puma</a>
              <a href="?module=user&action=giayLining" class="dropdown-item">Giày Lining</a>
              <a href="?module=user&action=giayAnta" class="dropdown-item">Giày Anta</a>
            </div>
          </div>
          <a href="?module=user&action=quanao" class="nav-item nav-link">Quần áo</a>
          <a href="?module=user&action=phukien" class="nav-item nav-link">Phụ kiện</a>
          <a href="?module=user&action=sandal" class="nav-item nav-link">Sandal</a>
        </div>
        <div class="d-flex m-3 me-0">
          <button
            class="btn-search btn border border-secondary rounded-circle bg-white me-4"
            data-bs-toggle="modal"
            data-bs-target="#searchModal"
            style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-search" style="color: #4856dd; font-size: 20px;"></i>
          </button>
          <a href="?module=user&action=cart" class="position-relative me-4 my-auto">
            <i class="fa fa-shopping-bag fa-2x" style="color: #4856dd"></i>
            <span
              class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
              style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
              3
            </span>
          </a>
          <a href="#" class="my-auto">
            <i class="fas fa-user fa-2x" style="color: #4856dd"></i>
          </a>
        </div>
      </div>
    </nav>
  </div>
</div>
<!-- Navbar End -->

<!-- Modal Search Start -->
<div
  class="modal fade"
  id="searchModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content rounded-0">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Search by keyword
        </h5>
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
            placeholder="keywords"
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
  <h1 class="text-center text-white display-6">Shop</h1>
  <ol class="breadcrumb justify-content-center mb-0">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pages</a></li>
    <li class="breadcrumb-item active text-white">Shop</li>
  </ol>
</div>
<!-- Single Page Header End -->

<!-- Fruits Shop Start-->
<div class="container-fluid item py-5">
  <div class="container py-5">
    <h1 class="mb-4">Fresh fruits shop</h1>
    <div class="row g-4">
      <div class="col-lg-12">
        <div class="row g-4">
          <div class="col-xl-3">
            <div class="input-group w-100 mx-auto d-flex">
              <input
                type="search"
                class="form-control p-3"
                placeholder="keywords"
                aria-describedby="search-icon-1" />
              <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
            </div>
          </div>
          <div class="col-6"></div>
          <div class="col-xl-3">
            <div
              class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
              <label for="fruits">Default Sorting:</label>
              <select
                id="fruits"
                name="fruitlist"
                class="border-0 form-select-sm bg-light me-3"
                form="fruitform">
                <option value="volvo">Nothing</option>
                <option value="saab">Popularity</option>
                <option value="opel">Organic</option>
                <option value="audi">Fantastic</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-lg-3">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4>Categories</h4>
                  <ul class="list-unstyled item-categorie">
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Apples</a>
                        <span>(3)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Oranges</a>
                        <span>(5)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Strawbery</a>
                        <span>(2)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Banana</a>
                        <span>(8)</span>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex justify-content-between item-name">
                        <a href="#"><i class="fas fa-apple-alt me-2"></i>Pumpkin</a>
                        <span>(5)</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4 class="mb-2">Price</h4>
                  <input
                    type="range"
                    class="form-range w-100"
                    id="rangeInput"
                    name="rangeInput"
                    min="0"
                    max="500"
                    value="0"
                    oninput="amount.value=rangeInput.value" />
                  <output
                    id="amount"
                    name="amount"
                    min-velue="0"
                    max-value="500"
                    for="rangeInput">0</output>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <h4>Additional</h4>
                  <div class="mb-2">
                    <input
                      type="radio"
                      class="me-2"
                      id="Categories-1"
                      name="Categories-1"
                      value="Beverages" />
                    <label for="Categories-1"> Organic</label>
                  </div>
                  <div class="mb-2">
                    <input
                      type="radio"
                      class="me-2"
                      id="Categories-2"
                      name="Categories-1"
                      value="Beverages" />
                    <label for="Categories-2"> Fresh</label>
                  </div>
                  <div class="mb-2">
                    <input
                      type="radio"
                      class="me-2"
                      id="Categories-3"
                      name="Categories-1"
                      value="Beverages" />
                    <label for="Categories-3"> Sales</label>
                  </div>
                  <div class="mb-2">
                    <input
                      type="radio"
                      class="me-2"
                      id="Categories-4"
                      name="Categories-1"
                      value="Beverages" />
                    <label for="Categories-4"> Discount</label>
                  </div>
                  <div class="mb-2">
                    <input
                      type="radio"
                      class="me-2"
                      id="Categories-5"
                      name="Categories-1"
                      value="Beverages" />
                    <label for="Categories-5"> Expired</label>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <h4 class="mb-3">Featured products</h4>
                <div
                  class="d-flex align-items-center justify-content-start">
                  <div
                    class="rounded me-4"
                    style="width: 100px; height: 100px">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-1.jpg"
                      class="img-fluid rounded"
                      alt="" />
                  </div>
                  <div>
                    <h6 class="mb-2">Big Banana</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">
                        4.11 $
                      </h5>
                    </div>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center justify-content-start">
                  <div
                    class="rounded me-4"
                    style="width: 100px; height: 100px">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-2.jpg"
                      class="img-fluid rounded"
                      alt="" />
                  </div>
                  <div>
                    <h6 class="mb-2">Big Banana</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">
                        4.11 $
                      </h5>
                    </div>
                  </div>
                </div>
                <div
                  class="d-flex align-items-center justify-content-start">
                  <div
                    class="rounded me-4"
                    style="width: 100px; height: 100px">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/featur-3.jpg"
                      class="img-fluid rounded"
                      alt="" />
                  </div>
                  <div>
                    <h6 class="mb-2">Big Banana</h6>
                    <div class="d-flex mb-2">
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star text-secondary"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2">2.99 $</h5>
                      <h5 class="text-danger text-decoration-line-through">
                        4.11 $
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-center my-4">
                  <a
                    href="#"
                    class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
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
                    style="
                          top: 50%;
                          right: 10px;
                          transform: translateY(-50%);
                        ">
                    <h3 class="text-secondary fw-bold">
                      Fresh <br />
                      Fruits <br />
                      Banner
                    </h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="row g-4 justify-content-center">
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative item-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-5.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Grapes</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img_item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-5.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Grapes</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-2.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Raspberries</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-4.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Apricots</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-3.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Banana</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-1.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Oranges</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-2.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Raspberries</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-5.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Grapes</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative my-item">
                  <div class="img-item">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/fruite-item-1.jpg"
                      class="img-fluid w-100 rounded-top"
                      alt="" />
                  </div>
                  <div
                    class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                    style="top: 10px; left: 10px">
                    Fruits
                  </div>
                  <div
                    class="p-4 border border-secondary border-top-0 rounded-bottom">
                    <h4>Oranges</h4>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing
                      elit sed do eiusmod te incididunt
                    </p>
                    <div
                      class="d-flex justify-content-between flex-lg-wrap">
                      <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                      <a
                        href="#"
                        class="btn border border-secondary rounded-pill px-3 text-primary"><i
                          class="fa fa-shopping-bag me-2 text-primary"></i>
                        Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="pagination d-flex justify-content-center mt-5">
                  <a href="#" class="rounded">&laquo;</a>
                  <a href="#" class="active rounded">1</a>
                  <a href="#" class="rounded">2</a>
                  <a href="#" class="rounded">3</a>
                  <a href="#" class="rounded">4</a>
                  <a href="#" class="rounded">5</a>
                  <a href="#" class="rounded">6</a>
                  <a href="#" class="rounded">&raquo;</a>
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