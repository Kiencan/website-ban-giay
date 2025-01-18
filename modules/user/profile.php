<?php
if (!defined('_CODE')) {
  die('Access denied');
}

$title = [
  'pageTitle' => 'Trang cá nhân'
];

# Lấy userId
$user_id = getUserIdByToken();

$listBanner = getRaw("SELECT * FROM banner ORDER BY id");
$listProd = getRaw("SELECT * FROM products");

layouts('header', $title);
?>

<div class="container emp-profile">
            <form>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="./templates/image/avt.jpg" alt="" style = "width: 200px; height: 200px"/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        Tên khách hàng
                                    </h5>
                                    <h6>
                                        ID: 
                                    </h6>
                                    <p class="proile-rating">Số đơn thành công: <span>Sửa đây</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Đổi mật khẩu"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="?module=user&action=trangchu">Trang chủ</a><br/>
                            <a href="?module=user&action=cart">Giỏ hàng</a><br/>
                            <a href="?module=user&action=favourite">Mục yêu thích</a>
                            <p>Danh mục</p>
                            <a href="?module=user&action=shop&id=bestSelling">Bán chạy</a><br/>
                            <a href="?module=user&action=shop&id=discount">Giảm giá</a><br/>
                            <a href="?module=user&action=shop&id=giayAdidas">Giày Adidas</a><br/>
                            <a href="?module=user&action=shop&id=giayNike">Giày Nike</a></a><br/>
                            <a href="?module=user&action=shop&id=hangkhac">Giày hãng khác</a><br/>
                            <a href="?module=user&action=shop&id=quanao">Quần áo</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tên đăng nhập</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sửa đây</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tên</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sửa đây</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sửa đây</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Số điện thọai</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sửa đây</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Địa chỉ</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Sửa đây</p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>

<?php
layouts('footer');
?>