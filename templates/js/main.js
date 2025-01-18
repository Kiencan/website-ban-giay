(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner(0);

  // Fixed Navbar
  $(window).scroll(function () {
    if ($(window).width() < 992) {
      if ($(this).scrollTop() > 55) {
        $(".fixed-top").addClass("shadow");
      } else {
        $(".fixed-top").removeClass("shadow");
      }
    } else {
      if ($(this).scrollTop() > 55) {
        $(".fixed-top").addClass("shadow").css("top", -55);
      } else {
        $(".fixed-top").removeClass("shadow").css("top", 0);
      }
    }
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Testimonial carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 2000,
    center: false,
    dots: true,
    loop: true,
    margin: 25,
    nav: true,
    navText: [
      '<i class="bi bi-arrow-left"></i>',
      '<i class="bi bi-arrow-right"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 1,
      },
      992: {
        items: 2,
      },
      1200: {
        items: 2,
      },
    },
  });

  // vegetable carousel
  $(".vegetable-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1500,
    center: false,
    dots: true,
    loop: true,
    margin: 25,
    nav: true,
    navText: [
      '<i class="bi bi-arrow-left"></i>',
      '<i class="bi bi-arrow-right"></i>',
    ],
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
      1200: {
        items: 4,
      },
    },
  });

  // Modal Video
  $(document).ready(function () {
    var $videoSrc;
    $(".btn-play").click(function () {
      $videoSrc = $(this).data("src");
    });
    // console.log($videoSrc);

    $("#videoModal").on("shown.bs.modal", function (e) {
      $("#video").attr(
        "src",
        $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0"
      );
    });

    $("#videoModal").on("hide.bs.modal", function (e) {
      $("#video").attr("src", $videoSrc);
    });
  });

  // Product Quantity
  $(".quantity button").on("click", function () {
    var button = $(this);
    var oldValue = button.parent().parent().find("input").val();
    if (button.hasClass("btn-plus")) {
      var newVal = parseFloat(oldValue) + 1;
    } else {
      if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
      } else {
        newVal = 0;
      }
    }
    button.parent().parent().find("input").val(newVal);
  });
})(jQuery);

function openModal(imageSrc) {
  const modalImage = document.getElementById("modalImage");
  modalImage.src = imageSrc; // Đặt ảnh trong modal bằng ảnh được nhấp
  const imageModal = new bootstrap.Modal(document.getElementById("imageModal"));
  imageModal.show(); // Hiển thị modal
}
document.querySelectorAll(".product-image").forEach((item) => {
  item.addEventListener("click", () => {
    // Loại bỏ lớp active khỏi tất cả các sản phẩm
    document
      .querySelectorAll(".product-name")
      .forEach((name) => name.classList.remove("active"));

    // Thêm lớp active vào phần tử product-name của ảnh được nhấn
    const productName = item.nextElementSibling; // Lấy phần tử <p> (product-name) kế tiếp
    productName.classList.add("active");
  });
});

$(document).ready(function () {
  $(".addItemBtn").click(function (e) {
    e.preventDefault();

    const form = $(this).closest(".form-submit");
    const p_id = form.find(".p_id").val();
    const user_id = form.find(".user_id").val();
    const p_price_min = form.find(".p_price_min").val();

    const p_size = $(".chon-size .form-check-input:checked").val();
    const p_quantity = $(".itemQty").val();

    // Kiểm tra các giá trị trước khi gửi AJAX
    if (!p_id || !user_id || !p_price_min || !p_size || !p_quantity) {
      Swal.fire({
        icon: "warning",
        title: "Cảnh báo",
        text: "Vui lòng chọn đầy đủ thông tin sản phẩm!",
        showConfirmButton: true,
      });
      return;
    }

    // Hiển thị trạng thái loading
    Swal.fire({
      title: "Đang xử lý...",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    $.ajax({
      url: "?module=user&action=add_to_cart", // File PHP xử lý thêm vào giỏ hàng
      method: "POST",
      dataType: "json",
      data: {
        p_id: p_id,
        user_id: user_id,
        p_price_min: p_price_min,
        p_size: p_size, // Gửi thông tin size
        p_quantity: p_quantity, // Gửi thông tin số lượng
      },
      success: function (response) {
        Swal.close(); // Đóng trạng thái loading

        if (response && response.status) {
          if (response.status === "added") {
            Swal.fire({
              icon: "success",
              title: "Thành công!",
              text: response.message,
              showConfirmButton: false,
              timer: 1500,
            });
          } else if (response.status === "exists") {
            Swal.fire({
              icon: "info",
              title: "Thông báo",
              text: response.message,
              showConfirmButton: true,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: response.message,
              showConfirmButton: true,
            });
          }

          // Gọi API để cập nhật số lượng sản phẩm
          updateCartCount(user_id);
        } else {
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: "Phản hồi không hợp lệ từ server.",
            showConfirmButton: true,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.close();
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: `Đã xảy ra lỗi: ${error}. Vui lòng thử lại!`,
          showConfirmButton: true,
        });
      },
    });
  });

  // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
  function updateCartCount(user_id) {
    if (!user_id) return;

    $.ajax({
      url: "?module=user&action=cart_count",
      method: "POST",
      data: {
        user_id: user_id,
      },
      success: function (response) {
        if (response && !isNaN(response)) {
          $("#cart-count").text(response);
        }
      },
      error: function () {
        console.error("Không thể cập nhật số lượng sản phẩm.");
      },
    });
  }

  // Thêm class active khi chọn size
  $(".chon-size .size").click(function () {
    $(".chon-size .size").removeClass("active");
    $(this).addClass("active");
  });
});

$(document).ready(function () {
  // Lắng nghe sự kiện nhập vào ô tìm kiếm
  $("#search").on("keyup", function () {
    let query = $(this).val(); // Lấy giá trị từ input search

    if (query.length > 1) {
      // Chỉ tìm kiếm khi từ khóa > 1 ký tự
      $.ajax({
        url: "?module=user&action=search", // File PHP xử lý tìm kiếm
        method: "POST",
        data: {
          query: query,
        }, // Gửi dữ liệu tìm kiếm
        success: function (response) {
          $("#search-results").html(response); // Hiển thị kết quả
        },
        error: function () {
          console.log("Có lỗi xảy ra.");
        },
      });
    } else {
      $("#search-results").html(""); // Xóa kết quả nếu input rỗng
    }
  });
});

$(document).ready(function () {
  $("#send-button").on("click", function () {
    let email = $("#email-input").val();
    // Email validation using regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Vui lòng nhập địa chỉ email hợp lệ.",
      });
      return;
    }

    // Send AJAX request
    $.ajax({
      url: "?module=user&action=send_mail", // Replace with your server-side endpoint
      method: "POST",
      dataType: "json",
      data: {
        email: email,
      },
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "info",
            title: "Thông báo!",
            text: response.message,
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: response.message,
            showConfirmButton: true,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: "Có lỗi xảy ra: " + error,
        });
      },
    });
  });
});

// Send mail to admin
$(document).ready(function () {
  $("#send-to-admin-button").on("click", function (e) {
    e.preventDefault();

    // Lấy dữ liệu từ biểu mẫu
    const name = $("#name").val();
    const different_email = $("#email").val();
    const message = $("#message").val();
    console.log(name);
    console.log(different_email);
    console.log(message);

    // Kiểm tra đầu vào
    if (!name || !different_email || !message) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Vui lòng điền đầy đủ thông tin!",
      });
      return;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(different_email)) {
      Swal.fire({
        icon: "error",
        title: "Lỗi",
        text: "Vui lòng nhập địa chỉ email hợp lệ.",
      });
      return;
    }

    // AJAX gửi dữ liệu
    $.ajax({
      url: "?module=user&action=send_to_admin", // Endpoint xử lý gửi email
      method: "POST",
      dataType: "json",
      data: {
        name: name,
        different_email: different_email,
        message: message,
      },
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: "info",
            title: "Thông báo!",
            text: response.message,
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Lỗi",
            text: response.message,
            showConfirmButton: true,
          });
        }
      },
      error: function (xhr, status, error) {
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: "Đã xảy ra lỗi không xác định.",
        });
      },
    });
  });
});

// update price on button
$(document).ready(function () {
  $(".itemQty").on("change", function () {
    var $el = $(this).closest("tr");

    var cart_id = $el.find(".cart_id").val();
    var p_quantity = $(this).val();
    var p_price_min = $el.find(".p_price_min").val();
    var p_price_max = $el.find(".p_price_max").val();

    // Gửi AJAX để cập nhật số lượng và tính lại tổng giá
    $.ajax({
      url: "?module=user&action=update_total_price",
      method: "POST",
      cache: false,
      data: {
        cart_id: cart_id,
        p_quantity: p_quantity,
        p_price_min: p_price_min,
        p_price_max: p_price_max,
      },
      success: function (response) {
        var data = JSON.parse(response);
        let total_price = data.total_price.toLocaleString("vi-VN");
        $el.find(".total-price").text(total_price);
        let total = data.total;
        console.log(total);
        $(".thanh_tien").text(total + " VNĐ");
        let ship_fee = data.ship_fee;
        console.log(ship_fee);
        $(".tien_ship").text(ship_fee + " VNĐ");
        let grand_total = data.grand_total;
        console.log(grand_total);
        $(".tong_thanh_toan").text(grand_total + " VNĐ");
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Lỗi",
          text: "Không thể cập nhật số lượng, vui lòng thử lại!",
          showConfirmButton: true,
        });
      },
    });
  });

  // Xử lý sự kiện tăng/giảm số lượng
  $(".btn-minus, .btn-plus").on("click", function (e) {
    e.preventDefault();
    var $input = $(this).closest(".input-group").find(".itemQty");
    var currentValue = parseInt($input.val()) || 0;
    if ($(this).hasClass("btn-minus") && currentValue > 0) {
      $input.val(currentValue).trigger("change");
    } else if ($(this).hasClass("btn-plus")) {
      $input.val(currentValue).trigger("change");
    }
  });

  $(".deleteItemBtn").click(function (e) {
    e.preventDefault();

    const form = $(this).closest(".form-submit1");
    const cart_id = form.find(".cart_id").val();
    const user_id = form.find(".user_id").val();

    // Thêm hộp thoại xác nhận trước khi xóa
    Swal.fire({
      title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
      text: "Thao tác này không thể hoàn tác!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Đồng ý",
      cancelButtonText: "Hủy",
    }).then((result) => {
      if (result.isConfirmed) {
        // Nếu người dùng xác nhận, thực hiện xóa
        $.ajax({
          url: "?module=user&action=cart_delete", // File PHP xử lý thêm vào giỏ hàng
          method: "POST",
          dataType: "json",
          data: {
            cart_id: cart_id,
          },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: "Thành công!",
              text: response.message,
              showConfirmButton: false,
              timer: 1500,
            });
            console.log(response);
            let total = response.total;
            $(".thanh_tien").text(total + " VNĐ");
            let ship_fee = response.ship_fee;
            console.log(ship_fee);
            $(".tien_ship").text(ship_fee + " VNĐ");
            let grand_total = response.grand_total;
            $(".tong_thanh_toan").text(grand_total + " VNĐ");

            // Xóa dòng sản phẩm trên giao diện
            form.closest("tr").remove();

            // Kiểm tra nếu giỏ hàng trống, hiển thị thông báo
            if ($("table tbody tr").length === 0) {
              $("table tbody").html(`
                          <tr>
                              <td colspan="7">
                                  <div class="alert alert-danger text-center">Không có đơn hàng nào!</div>
                              </td>
                          </tr>
                      `);
            }
            updateCartCount(user_id);
          },
          error: function () {
            Swal.fire({
              icon: "error",
              title: "Lỗi",
              text: "Đã xảy ra lỗi, vui lòng thử lại!",
              showConfirmButton: true,
            });
          },
        });
      }
    });
  });

  // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
  function updateCartCount(user_id) {
    $.ajax({
      url: "?module=user&action=cart_count", // File PHP trả về số lượng sản phẩm
      method: "POST",
      data: {
        user_id: user_id,
      },
      success: function (response) {
        $("#cart-count").text(response); // Cập nhật số lượng sản phẩm
      },
    });
  }
});
