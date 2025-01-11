let currentPage = 1;
let currentBrand = "";
let totalPages = 1;
let currentPrice = 0;
let categoryId = $("#Categories-all").data("brand");
// Load sản phẩm
function loadProducts(page = 1, brand = "") {
  $.ajax({
    url: "?module=user&action=filter",
    method: "POST",
    data: { page, brand, categoryId, currentPrice },
    dataType: "json",
    success: function (data) {
      const productContainer = $("#product-container");
      productContainer.empty();

      // Hiển thị sản phẩm
      // console.log(data.products);
      data.products.forEach((product) => {
        productContainer.append(`
                <div class="col-md-6 col-lg-6 col-xl-4">
                <a href="?module=user&action=shop-detail&p_id=${product.p_id}">
                  <div class="rounded position-relative my-item">
                    <div class="img-item">
                      <img src="${BASE_URL}/image/${product.product_image}" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${product.category_name}</div>
                    <div class="p-4 border-top-0 rounded-bottom">
                      <h4>Giày ${product.p_name}</h4>
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                      <div class="d-flex justify-content-between flex-lg-wrap">
                        <p>
                          <span style="text-decoration: line-through">${product.p_price_max}đ</span>
                          <span style="font-weight: bold; color: black">${product.p_price_min}đ</span>
                        </p>
                        <div class="product-actions">
                          <a href="#" class="btn border border-secondary rounded-circle p-auto me-2" style="background-color: rgb(255, 255, 255); color: #4856dd; width: 40px; height: 40px;">
                            <i class="fa fa-heart"></i>
                          </a>
                          <a href="?module=user&action=shop-detail&p_id=${product.p_id}" class="btn border border-secondary rounded-pill px-3 text-primary">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ hàng
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                </div>
                `);
      });

      totalPages = data.total_pages;
      // Hiển thị phân trang
      if (totalPages > 0) {
        createPagination();
        renderPagination(totalPages, page);
      } else {
        removePagination();
      }
    },
  });
}
function createPagination() {
  const paginationContainer = $("#pagination");
  paginationContainer.empty();

  // Thêm nút Previous
  paginationContainer.append(`
        <a href="#" id="prev-page" class="btn rounded">&laquo; Previous</a>
        `);
  paginationContainer.append(`
          <div id="page-links" class="page-links"></div>
          `); // Thêm nút Next
  paginationContainer.append(`
        <a href="#" id="next-page" class="btn rounded">Next &raquo;</a>
        `);
}
function removePagination() {
  const paginationLinks = $("#page-links");
  paginationLinks.empty();

  const prevButton = $("#prev-page");
  const nextButton = $("#next-page");

  prevButton.hide();
  nextButton.hide();
}
// Hàm hiển thị phân trang
function renderPagination(totalPages, currentPage) {
  const paginationLinks = $("#page-links");
  const prevButton = $("#prev-page");
  const nextButton = $("#next-page");

  paginationLinks.empty();

  // Hiển thị các trang
  let pageArray = [];
  if (totalPages <= 7) {
    pageArray = Array.from({ length: totalPages }, (_, i) => i + 1);
  } else {
    if (currentPage <= 4) {
      pageArray = [1, 2, 3, 4, 5, "...", totalPages];
    } else if (currentPage >= totalPages - 3) {
      pageArray = [
        1,
        "...",
        totalPages - 4,
        totalPages - 3,
        totalPages - 2,
        totalPages - 1,
        totalPages,
      ];
    } else {
      pageArray = [
        1,
        "...",
        currentPage - 1,
        currentPage,
        currentPage + 1,
        "...",
        totalPages,
      ];
    }
  }

  // Thêm các nút trang vào pagination
  pageArray.forEach((page) => {
    if (page === "...") {
      paginationLinks.append(
        `<a href="#" class="btn rounded disabled">...</a>`
      );
    } else if (page === currentPage) {
      paginationLinks.append(
        `<a href="#" class="btn rounded active">${page}</a>`
      );
    } else {
      paginationLinks.append(
        `<a href="#" class="btn rounded" data-page="${page}">${page}</a>`
      );
    }
  });

  // Xử lý nút Previous
  if (currentPage > 1) {
    prevButton.removeClass("disabled");
    prevButton.attr("data-page", currentPage - 1);
  } else {
    prevButton.addClass("disabled");
  }

  // Xử lý nút Next
  if (currentPage < totalPages) {
    nextButton.removeClass("disabled");
    nextButton.attr("data-page", currentPage + 1);
  } else {
    nextButton.addClass("disabled");
  }
}

// Xử lý sự kiện nút phân trang
$(document).on("click", "#page-links a", function (e) {
  e.preventDefault();
  const page = $(this).data("page");
  if (page) {
    currentPage = page;
    loadProducts(currentPage, currentBrand);
  }
});

// Xử lý sự kiện nút Previous
$(document).on("click", "#prev-page", function (e) {
  e.preventDefault();
  const page = $(this).data("page");
  if (page) {
    currentPage = page;
    loadProducts(currentPage, currentBrand);
  }
});

// Xử lý sự kiện nút Next
$(document).on("click", "#next-page", function (e) {
  e.preventDefault();
  const page = $(this).data("page");
  if (page) {
    currentPage = page;
    loadProducts(currentPage, currentBrand);
  }
});

// Xử lý khi bấm vào nút lọc thương hiệu
$(document).on("change", ".brand-filter", function () {
  currentBrand = $(this).val();
  currentPage = 1;
  loadProducts(currentPage, currentBrand);
});

// Xử lý khi bấm vào nút lọc giá
$(document).on("change", ".price-filter", function () {
  currentPrice = $(this).val();
  console.log(currentPrice);
  currentPage = 1;
  loadProducts(currentPage, currentBrand);
});

// Tải sản phẩm lần đầu
loadProducts();
