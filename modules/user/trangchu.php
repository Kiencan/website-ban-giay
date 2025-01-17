<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Trang chủ 3H1A Store'
];

# Lấy userId
$user_id = getUserIdByToken();

$listBanner = getRaw("SELECT * FROM banner ORDER BY id");
$listProd = getRaw("SELECT * FROM products");

layouts('header', $title);
?>

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
                <span class="text-dark" style="width: 130px">Giày Adidas</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex py-2 m-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-2">
                <span class="text-dark" style="width: 130px">Giày Nike</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-3">
                <span class="text-dark" style="width: 130px">Giày Puma</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-4">
                <span class="text-dark" style="width: 130px">Sandal</span>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="d-flex m-2 py-2 bg-light rounded-pill"
                data-bs-toggle="pill"
                href="#tab-5">
                <span class="text-dark" style="width: 130px">Khác</span>
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
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1  AND collection.category_id = 10 LIMIT 4");
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
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1  AND collection.category_id = 9 LIMIT 4");
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
                            Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
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
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1  AND collection.category_id = 17 LIMIT 4");
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
                            Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
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
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1  AND collection.category_id = 22 LIMIT 4");
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
                            Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
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
                $listBS = getRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE isBestSelling = 1  AND collection.category_id = 23 LIMIT 4");
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
                            Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
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
                Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
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
                  height: 40px;">
                  <i class="fa fa-heart heart-icon"></i>
                  <!-- Icon trái tim -->
                </a>

                <a href="?module=user&action=shop-detail&p_id=<?php echo $value['p_id'] ?>" class="btn border border-secondary rounded-pill px-3 add-cart">
                  <i class="fa fa-shopping-bag me-2 bag-icon"></i>Thêm vào giỏ hàng
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
            Giảm giá tất cả sản phẩm, bao gồm cả những mẫu mới nhất!

            Đa dạng mẫu mã và size cho cả gia đình thoải mái lựa chọn.

            Áp dụng cho cả cửa hàng và online.
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
              Sản phẩm tuyệt vời. Tôi đi rất thoải mái. Shop tư vấn nhiệt tình, trách nhiệm. Sẽ ủng hộ lâu dài
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/avt.JPG"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Thủy Phạm</h4>
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
              Sản phẩm tuyệt vời. Tôi đi rất thoải mái. Shop tư vấn nhiệt tình, trách nhiệm. Sẽ ủng hộ lâu dài
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/avt2.JPG"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Kiên Béo</h4>
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
              Sản phẩm tuyệt vời. Tôi đi rất thoải mái. Shop tư vấn nhiệt tình, trách nhiệm. Sẽ ủng hộ lâu dài
            </p>
          </div>
          <div class="d-flex align-items-center flex-nowrap">
            <div class="bg-secondary rounded">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/avt3.JPG"
                class="img-fluid rounded"
                style="width: 100px; height: 100px"
                alt="" />
            </div>
            <div class="ms-4 d-block">
              <h4 class="text-dark">Nam Ngô</h4>
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

<?php
layouts('footer');
?>