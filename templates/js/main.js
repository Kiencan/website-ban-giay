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
    console.log($videoSrc);

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

function updateCarousel(color) {
  // Tìm phần tử carousel
  const carouselInner = document.querySelector(".carousel-inner");

  // Xóa nội dung cũ
  carouselInner.innerHTML = "";

  // Thêm ảnh mới dựa trên màu
  let images = [];
  if (color === "hong") {
    images = [
      {
        src: "templates/image/giayhong1.jpg",
        alt: "Giày Nike E hồng 1",
      },
      {
        src: "templates/image/giayhong2.jpg",
        alt: "Giày Nike E hồng 2",
      },
      {
        src: "templates/image/giayhong3.jpg",
        alt: "Giày Nike E hồng 2",
      },
      {
        src: "templates/image/giayhong4.jpg",
        alt: "Giày Nike E hồng 2",
      },
    ];
  } else if (color === "den") {
    images = [
      {
        src: "templates/image/giayden1.jpg",
        alt: "Giày Nike E đen 1",
      },
      {
        src: "templates/image/giayden2.jpg",
        alt: "Giày Nike E đen 2",
      },
      {
        src: "templates/image/giayden3.jpg",
        alt: "Giày Nike E đen 3",
      },
      {
        src: "templates/image/giayden4.jpg",
        alt: "Giày Nike E đen 4",
      },
    ];
  }

  // Thêm các ảnh mới vào carousel
  images.forEach((image, index) => {
    const carouselItem = document.createElement("div");
    carouselItem.className = `carousel-item ${index === 0 ? "active" : ""}`;
    carouselItem.innerHTML = `
      <img src="${image.src}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="${color}" />
    `;
    carouselInner.appendChild(carouselItem);
  });
}