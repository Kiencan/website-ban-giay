<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Item detail'
];

$user_id = getUserIdByToken();
$filterAll = filter();
$product = oneRaw("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id WHERE p_id = '" . $filterAll['p_id'] . "'");
$listImg = getRaw("SELECT * FROM product_image WHERE p_id = '" . $filterAll['p_id'] . "'");

layouts('header', $title);

// echo '<pre>';
// print_r($product);
// echo '</pre>';
?>
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
              <?php echo $product['p_name'] . " " . $product['p_color']; ?>
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
                    "><?php echo number_format($product['p_price_min'] / (1 - $product['discount'] / 100), 0, ',', '.') . " - " . number_format($product['p_price_max'] / (1 - $product['discount'] / 100), 0, ',', '.'); ?></span>
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
                      "><?php echo number_format($product['p_price_min'] * (100 - $product['discount']) / 100, 0, ',', '.') . " - " . number_format($product['p_price_max'] * (100 - $product['discount']) / 100, 0, ',', '.'); ?> VNĐ</span>
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
            <div class="type-giay">
              <span class="select-color mt-3">Màu sắc</span>
              <div class="container-product d-flex justify-content-start">
                <?php
                $listColor = getRaw("SELECT p_id, p_color FROM products where p_name_id = " . $product["p_name_id"]);
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
                    <div class="form-check me-3">
                      <input
                        type="radio"
                        id="size-<?php echo $size[$i] ?>"
                        name="size"
                        value="<?php echo $size[$i] ?>"
                        disabled
                        class="form-check-input">
                      <label
                        for="size-<?php echo $size[$i] ?>"
                        class="form-check-label text-muted">
                        <?php echo $size[$i] ?>
                      </label>
                    </div>
                  <?php
                  else:
                  ?>
                    <div class="form-check me-3">
                      <input
                        type="radio"
                        id="size-<?php echo $size[$i] ?>"
                        name="size"
                        value="<?php echo $size[$i] ?>"
                        class="form-check-input">
                      <label
                        for="size-<?php echo $size[$i] ?>"
                        class="form-check-label">
                        <?php echo $size[$i] ?>
                      </label>
                    </div>
                <?php
                  endif;
                endfor;
                ?>
              </div>
              <span class="select-quantity pt-3 mt-3">Số lượng</span>
            </div>
            <div class="input-group quantity mb-3 mt-3"
              style="width: 100px">
              <div class="input-group-btn">
                <button
                  class="btn btn-sm btn-minus rounded-circle bg-light border">
                  <i class="fa fa-minus"></i>
                </button>
              </div>
              <input
                type="text"
                class="form-control form-control-sm text-center border-0 itemQty"
                value="1" />
              <div class="input-group-btn">
                <button
                  class="btn btn-sm btn-plus rounded-circle bg-light border">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="d-flex gap-3">
              <?php
              if (!empty($user_id)):
              ?>
                <form action="" method="POST" class="form-submit">
                  <input type="hidden" class="p_id" value="<?php echo $product['p_id'] ?>">
                  <input type="hidden" class="user_id" value="<?php echo $user_id ?>">
                  <input type="hidden" class="p_price_min" value="<?php echo $product['p_price_min'] ?>">
                  <input type="hidden" class="quantity" value="1">

                  <button type="button" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 addItemBtn" style="color: #4856dd">
                    <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                  </button>
                </form>
              <?php else: ?>
                <a href="?module=user&action=login"
                  class="btn border border-secondary rounded-pill px-4 py-2 mb-4"
                  style="color: #4856dd">
                  <i class="fa fa-shopping-bag me-2"></i>Thêm vào giỏ hàng
                </a>
              <?php endif; ?>
              <a
                href="#"
                class="btn border border-secondary rounded-pill px-4 py-2 mb-4"
                style="color: #4856dd"><i class="fa fa-phone me-2" style="color: #4856dd"></i>Tư vấn:
                0383083743</a>
            </div>
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
                  <?php echo $product['p_description'] ?>
                </p>
              </div>
              <div
                class="tab-pane"
                id="nav-mission"
                role="tabpanel"
                aria-labelledby="nav-mission-tab">
                <?php
                $comments = getRaw("SELECT * FROM comments WHERE p_id = '" . $product['p_id'] . "'");
                foreach ($comments as $comment) : ?>
                  <div class="d-flex">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/avatar.jpg"
                      class="img-fluid rounded-circle p-3"
                      style="width: 100px; height: 100px"
                      alt="" />
                    <div class="">
                      <p class="mb-2" style="font-size: 14px">
                        <?php echo $comment['comment_time']; ?>
                      </p>
                      <div class="d-flex justify-content-between">
                        <h5><?php echo $comment['user_name']; ?></h5>
                        <div class="d-flex mb-3" id="icon-start">
                          <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fa fa-star <?php echo $i <= $comment['rating'] ? 'text-warning' : 'text-secondary'; ?>"></i>
                          <?php endfor; ?>
                        </div>
                      </div>
                      <p>
                        <?php echo $comment['comment_content']; ?>
                      </p>
                    </div>
                  </div>
                <?php endforeach ?>
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
          <form action="?module=user&action=comment" method="POST">
            <h4 class="mb-5 fw-bold">Đánh giá sản phẩm</h4>
            <div class="row g-4">
              <div class="col-lg-6">
                <div class="border-bottom rounded">
                  <input
                    name="tencuaban"
                    type="text"
                    class="form-control border-0 me-4"
                    placeholder="Tên của bạn *" required />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="border-bottom rounded">
                  <input
                    name="emailcuaban"
                    type="email"
                    class="form-control border-0"
                    placeholder="Email *" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="border-bottom rounded my-4">
                  <textarea
                    name="danhgiacuaban"
                    id=""
                    class="form-control border-0"
                    cols="30"
                    rows="8"
                    placeholder="Đánh giá *"
                    spellcheck="false" required></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="d-flex justify-content-between py-3 mb-5">
                  <div class="d-flex align-items-center">
                    <p class="mb-0 me-3">Mức độ hài lòng:</p>
                    <div
                      class="d-flex align-items-center">
                      <div class="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="rating" id="rating" value="0">
                  <input type="hidden" name="productId" id="productId" value="<?php echo $product['p_id']; ?>">
                  <button
                    type="submit"
                    class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                    Bình luận</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-lg-4 col-xl-3">
        <div class="row g-4 item">
          <div class="col-lg-12">

            <div class="mb-4">
              <h4>Danh mục</h4>
              <ul class="list-unstyled item-categorie">
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayAdidas"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Adidas</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 10") ?>)
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayNike"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Nike</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 9") ?>)
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayPuma"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Puma</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 17") ?>)
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayLining"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Lining</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 18") ?>)
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayAnta"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Giày Anta</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 19") ?>)
                    </span>
                  </div>
                </li>
                <li>
                  <div class="d-flex justify-content-between item-name">
                    <a href="?module=user&action=shop&id=giayAnta"><i class="fa fa-shoe-prints fa-rotate-270 fa-sm me-2" style="color: #0b3066"></i>Hãng khác</a>
                    <span>(<?php echo $products = getRows("SELECT * FROM products JOIN product_name ON products.p_name_id = product_name.p_name_id JOIN collection ON product_name.collection_id = collection.collection_id JOIN category ON collection.category_id = category.category_id WHERE category.category_id = 23") ?>)
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12">
            <h4 class="mb-4">Sản phẩm nổi bật</h4>
            <?php
            $sql = "SELECT p.*, pi.product_image, pn.p_name, c.category_name 
                    FROM products p
                    INNER JOIN product_image pi ON p.p_id = pi.p_id 
                    INNER JOIN product_name pn ON p.p_name_id = pn.p_name_id
                    INNER JOIN collection col ON pn.collection_id = col.collection_id
                    INNER JOIN category c ON col.category_id = c.category_id
                    WHERE c.category_name = '" . $product['category_name'] . "'
                    GROUP BY p.p_id
                    ORDER BY RAND() 
                    LIMIT 5";

            $listProducts = getRaw($sql);

            foreach ($listProducts as $listProduct): ?>
              <a href="?module=user&action=shop-detail&p_id=<?php echo $listProduct['p_id']; ?>">
                <div class="d-flex align-items-center justify-content-start">

                  <div class="rounded" style="width: 100px; height: 100px">
                    <img
                      src="<?php echo _WEB_HOST_TEMPLATE ?>/image/<?php echo $listProduct['product_image']; ?>"
                      class="rounded"
                      alt="Image" width="100px" />
                  </div>
                  <div>
                    <h6 class="mb-2"><?php echo $listProduct['p_name_custom'] ?> </h6>
                    <div class="d-flex mb-2">
                      <?php for ($i = 1; $i <= 5; $i++): ?>
                        <i class="fa fa-star <?php echo $i <= $listProduct['p_rate'] ? 'text-warning' : 'text-secondary'; ?>"></i>
                      <?php endfor; ?>
                    </div>
                    <div class="d-flex mb-2">
                      <h5 class="fw-bold me-2"><?php echo number_format($product['p_price_min'], 0, ',', '.'); ?></h5>
                      <h5 class="text-danger text-decoration-line-through">
                        <?php echo number_format($product['p_price_max'] / (1 - $product['discount'] / 100), 0, ',', '.'); ?>
                      </h5>
                    </div>
                  </div>

                </div>
              </a>
            <?php endforeach; ?>
            <div class="d-flex justify-content-center my-4">
              <a
                href="
                <?php
                if ($product['category_id'] == 9):
                  echo "?module=user&action=shop&id=giayNike";
                elseif ($product['category_id'] == 10):
                  echo "?module=user&action=shop&id=giayAdidas";
                elseif ($product['category_id']  == 17):
                  echo "?module=user&action=shop&id=giayPuma";
                elseif ($product['category_id']  == 18):
                  echo "?module=user&action=shop&id=giayLining";
                elseif ($product['category_id']  == 19):
                  echo "?module=user&action=shop&id=giayAnta";
                elseif ($product['category_id']  == 23):
                  echo "?module=user&action=shop&id=hangkhac";
                else:
                  echo "?module=user&action=login";
                endif;
                ?>"
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
      <?php
      $sanphamlq = getRaw("SELECT p.*, pi.product_image, pn.p_name, c.category_name,col.collection_name 
          FROM products p
          INNER JOIN product_image pi ON p.p_id = pi.p_id 
          INNER JOIN product_name pn ON p.p_name_id = pn.p_name_id
          INNER JOIN collection col ON pn.collection_id = col.collection_id
          INNER JOIN category c ON col.category_id = c.category_id
          WHERE col.collection_name = '" . $product['collection_name'] . "'
          GROUP BY p.p_id
          ORDER BY RAND() 
          LIMIT 8");
      foreach ($sanphamlq as $lq): ?>
        <div class="rounded position-relative giamgia-item">
          <a href="?module=user&action=shop-detail&p_id=<?php echo $lq['p_id']; ?>">
            <div class="img-item">
              <img
                src="<?php echo _WEB_HOST_TEMPLATE ?>/image/<?php echo $lq['product_image']; ?>"
                class="img-fluid w-100 rounded-top"
                alt="" />
            </div>
            <div
              class="text-white bg-secondary px-3 py-1 rounded position-absolute"
              style="top: 10px; left: 10px">
              <?php echo $lq['category_name']; ?>
            </div>
            <div class="p-4 border-top-0 rounded-bottom">
              <h4><?php echo $lq['p_name_custom']; ?></h4>
              <p>
                Cam kết chính hãng. Bảo hành trọn đời. Sản phẩm mới 100%
              </p>
              <p>
                <span style="text-decoration: line-through"><?php echo number_format($lq['p_price_max'] / (1 - $lq['discount'] / 100), 0, ',', '.'); ?> VNĐ</span>
                <span style="font-weight: bold; color: black"><?php echo number_format($lq['p_price_min'], 0, ',', '.'); ?> VNĐ</span>
              </p>
              <div class="d-flex justify-content-between flex-lg-wrap">
                <a
                  href="#"
                  class="btn border border-secondary rounded-circle p-auto me-2"
                  style="
                      background-color: rgb(255, 255, 255);
                      color: #4856dd; 
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
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<!-- Single Product End -->

<?php
layouts('footer');
?>