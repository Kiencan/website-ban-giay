<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="templates/css/new_balance.css" />
  <link rel="stylesheet" href="templates/css/header.css" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap"
    rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,600;1,600&display=swap");
  </style>
</head>

<body>
  <div class="grid-container">
    <header class="header">
      <div class="mar-left"></div>
      <div class="middle">
        <div class="first-nav">
          <div class="top-left">
            <a href="#">Về chúng tôi</a>
            <a href="#">Trở thành đối tác bán hàng 3H1A</a>
            <a href="#">Liên hệ</a>
            <a href="#">Chương trình</a>
          </div>
          <div class="top-right">
            <a href="#">Ngôn ngữ</a>
            <a href="#">Hỗ trợ</a>
            <a href="#">Thông báo</a>
          </div>
        </div>
        <div class="logo">
          <a href="index.php">
            <img src="./templates/image/logo.jpg" alt="" width="120px" />
          </a>
        </div>
        <div class="search-bar">
          <input type="text" class="search-input" placeholder="" name="" />
          <a href="#" class="search-icon">
            <i class="fa fa-search"></i>
          </a>
        </div>
        <div class="cart">
          <a href="#">
            <img src="./templates/image/cart.png" width="30px" />
          </a>
        </div>
        <div class="last-nav">
          <a href="#">Bán chạy</a>
          <a href="#">Giảm giá</a>
          <a href="new_balance.html">Sneaker</a>
          <a href="#">Sandals</a>
          <a href="#">Dép</a>
          <a href="#">Quần áo</a>
          <a href="#">Phụ kiện</a>
        </div>
      </div>
      <div class="mar-right"></div>
    </header>
    <div class="side-left"></div>
    <div class="balance-content">
      <div class="balance-title">
        <h2>Giày New Balance</h2>
      </div>
      <div class="balance-sidebar">
        <div class="ten-giay">
          <ul class="filter-list">
            <li><a href="#">COLLECTION</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
            <li><a href="#">Giay 1</a></li>
          </ul>
        </div>
        <div class="size-giay">
          <div class="size-text">Size</div>
          <div class="size">
            <button class="item">36</button>
            <button class="item">37</button>
            <button class="item">38</button>
            <button class="item">39</button>
            <button class="item">40</button>
            <button class="item">41</button>
            <button class="item">42</button>
            <button class="item">43</button>
            <button class="item">44</button>
          </div>
        </div>
      </div>
      <div class="balance-body">
        <div class="filter">
          <div class="path">
            <button class="path-item">
              <a href="index.php">Trang chủ</a>
            </button>
            /
            <button class="path-item-balance">
              <a href="#">Giày New Balance</a>
            </button>
          </div>
          <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">
              Bán chạy<i class="fa fa-angle-down"></i>
            </button>
            <div id="myDropdown" class="dropdown-content">
              <a href="#">Sale up 50%</a>
              <a href="#">Sale up 75%</a>
              <a href="#">Sale up 100%</a>
            </div>
          </div>
        </div>
        <div class="giay">
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
          <div class="giay-item">
            <a href="chon_giay.php"><img src="./templates/image/giay1.jpg" class="anh-giay" alt="" /></a>
            <div class="description">
              <div>Air Jordan 1 Mid</div>
              <div class="giay-new">New Balance</div>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              <div>
                <span class="price-old">1,295,000đ</span>
                <span class="price-new">985,000đ</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="side-right">
      <div class="echbay-sms-messenger style-for-position-br">
        <div class="phonering-alo-alo">
          <a
            href="tel:0387440192"
            rel="nofollow"
            class="echbay-phonering-alo-event">.</a>
        </div>
        <div class="phonering-alo-sms">
          <a
            href="sms:0387440192"
            rel="nofollow"
            class="echbay-phonering-sms-event">.</a>
        </div>
        <div class="phonering-alo-zalo">
          <a
            href="https://zalo.me/0387440192"
            target="_blank"
            rel="nofollow"
            class="echbay-phonering-zalo-event">.</a>
        </div>
        <div class="phonering-alo-messenger">
          <a
            href="https://www.facebook.com/3h1a.store"
            target="_blank"
            rel="nofollow"
            class="echbay-phonering-messenger-event">.</a>
        </div>
      </div>
    </div>
    <footer class="footer"><b>3H1ASTORE.COM</b> || 2023</footer>
  </div>
  <script src="templates/js/new_balance.js"></script>
</body>

</html>