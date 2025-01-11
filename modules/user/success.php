<?php
    if (!defined('_CODE')) {
        die('Access denied');
    }
    if (!isLogin()) {
        redirect('?module=auth&action=login');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy thông tin từ form
        $fullname = $_POST["fullname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $note = $_POST["note"] ?? '';
        $payment_method = $_POST["payment_method"];
        
        $user_id = getUserIdByToken();
       
        $cart_items = getRaw("SELECT * FROM cart WHERE user_id = '$user_id'");
        
        
        $total = 0;
        foreach ($cart_items as $item) {
            $product = oneRaw("SELECT * FROM products WHERE p_id = '".$item['p_id']."'");
            $total += ($product['p_price_min'] + $product['p_price_max'])/2 * $item['p_quantity'] * (100 - $product['discount'])/100;
        }
        
        // Tạo đơn hàng mới
        $orderData = [
            'user_id' => $user_id,
            'total' => $total,
            'order_status' => 1,
            'payment_type' => $payment_method
        ];

        $order_id = insertAndGetId('orders', $orderData);
        // Cập nhật thông tin giao hàng
        $sql = "UPDATE user SET 
                fullname = '$fullname',
                address = '$address',
                phone = '$phone',
                email = '$email'
                WHERE user_id = '$user_id'";
        query($sql);   


        // Lấy thông tin đơn hàng
        $order = oneRaw("SELECT * FROM orders WHERE payment_id = '$order_id'");
        $user = oneRaw("SELECT * FROM user WHERE user_id = '".$order['user_id']."'");
        // Lấy chi tiết sản phẩm trong đơn hàng
        $orderDetails = getRaw("SELECT p.*, pn.p_name, pi.product_image 
                            FROM cart c 
                            JOIN products p ON c.p_id = p.p_id
                            JOIN product_name pn ON p.p_name_id = pn.p_name_id
                            JOIN product_image pi ON p.p_id = pi.p_id
                            WHERE c.user_id = '".$order['user_id']."'");
        // // Xóa giỏ hàng
        // query("DELETE FROM cart WHERE user_id = '$user_id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Success</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>
<body>
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h1 class="text-success">Đặt hàng thành công!</h1>
                        <p class="fs-5">Cảm ơn bạn đã mua hàng. Chúng tôi sẽ sớm liên hệ với bạn.</p>
                    </div>

                    <!-- Thông tin đơn hàng -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Thông tin đơn hàng #<?php echo $order_id; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3">Thông tin khách hàng:</h6>
                                    <div><strong>Họ tên:</strong> <?php echo $fullname; ?></div>
                                    <div><strong>Email:</strong> <?php echo $email; ?></div>
                                    <div><strong>Số điện thoại:</strong> <?php echo $phone; ?></div>
                                </div>
                                <div class="col-sm-6">
                                    <h6 class="mb-3">Địa chỉ giao hàng:</h6>
                                    <div><?php echo $address; ?></div>
                                    <?php if(!empty($note)): ?>
                                        <div class="mt-3">
                                            <strong>Ghi chú:</strong> <?php echo $note; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Chi tiết sản phẩm -->
                            <h6 class="mb-3">Chi tiết sản phẩm:</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tên</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach($orderDetails as $item):
                                            $itemTotal = ($item['p_price_min'] + $item['p_price_max'])/2 * $item['p_quantity'] * (100 - $item['discount'])/100;
                                            $total += $itemTotal;
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo _WEB_HOST_TEMPLATE.'/image/'.$item['product_image']; ?>" 
                                                    class="img-fluid rounded-circle" 
                                                    style="width: 50px; height: 50px;" alt="">
                                            </td>
                                            <td><?php echo $item['p_name'].' '.$item['p_color']; ?></td>
                                            <td><?php echo number_format(($item['p_price_min'] + $item['p_price_max'])/2 * (100 - $item['discount'])/100, 0, ',', '.'); ?>đ</td>
                                            <td><?php echo $item['p_quantity']; ?></td>
                                            <td><?php echo number_format($itemTotal, 0, ',', '.'); ?>đ</td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                                            <td><strong><?php echo number_format($total, 0, ',', '.'); ?>đ</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Phương thức thanh toán -->
                            <div class="mt-4">
                                <h6 class="mb-3">Phương thức thanh toán:</h6>
                                <div><?php echo $payment_method; ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="text-center mt-4">
                        <a href="?module=user&action=trangchu" class="btn btn-primary me-3">Về trang chủ</a>
                        <a href="#" class="btn btn-outline-primary" onclick="window.print()">In đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>