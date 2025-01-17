<?php
if (!defined('_CODE')) {
  die('Access denied');
}
$filterAll = filter();

if (!empty($filterAll['id'])) {
  $id = $filterAll['id'];
  if ($id == 'bestSelling') {
    $categoryId = 15;
    $condition = "WHERE isBestSelling = 1";
    // $totalShoes = getRows("SELECT * FROM products " . $condition);
  } else if ($id == 'discount') {
    $categoryId = 16;
    $condition = "WHERE discount > 0";
    // $totalShoes = getRows("SELECT * FROM products " . $condition);
  } else if ($id == 'giayAdidas') {
    $categoryId = 10;
    $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayNike') {
    $categoryId = 9;
    $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayPuma') {
    $categoryId = 17;
    $condition = " WHERE collection.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id " . $condition);
  } else if ($id == 'giayLining') {
    $categoryId = 18;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'giayAnta') {
    $categoryId = 19;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'quanao') {
    $categoryId = 20;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'phukien') {
    // $categoryId = 21;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'sandal') {
    $categoryId = 22;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  } else if ($id == 'hangkhac') {
    $categoryId = 23;
    $condition = " WHERE category.category_id = $categoryId";
    // $totalShoes = getRows("SELECT * FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id INNER JOIN collection ON product_name.collection_id = collection.collection_id INNER JOIN category ON collection.category_id = category.category_id " . $condition);
  }
}

$category = oneRaw("SELECT * FROM category WHERE category_id = $categoryId");
// echo '<pre>';
// print_r($category);
// echo '</pre>';

// echo '<pre>';
// print_r($featuredProducts);
// echo '</pre>';
$title = [
  'pageTitle' => 'Trang ' . $category['category_name']
];


$user_id = getUserIdByToken();

layouts('header', $title);
?>

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
          </div>
          <div class="col-6"></div>
          <div class="col-xl-3">
            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
              <label for="fruits">Lọc theo giá:</label>
              <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3 oderby-price" form="fruitform">
                <option value="normal">Normal</option>
                <option value="increase">Từ cao đến thấp</option>
                <option value="decrease">Từ thấp đến cao</option>
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
                    <?php
                    $randCollection = getRaw("SELECT * FROM collection WHERE category_id = $categoryId ORDER BY RAND() LIMIT 4");
                    foreach ($randCollection as $rand):
                    ?>
                      <div class="mb-2">
                        <input type="radio" class="me-2 brand-filter" id="Categories-1" name="Categories-1" value="<?php echo $rand['collection_name'] ?> ">
                        <label for="Categories-1"> <?php echo $rand['collection_name'] ?></label>
                      </div>
                  <?php
                    endforeach;
                  endif;
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

<?php
layouts('footer');
?>