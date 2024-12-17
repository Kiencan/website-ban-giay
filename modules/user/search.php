<?php

if (!defined('_CODE')) {
    die('Access denied');
}

// Kết nối tới database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "shoes_shop_db";

$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu tìm kiếm từ AJAX
$search = isset($_POST['query']) ? $_POST['query'] : "";

// Truy vấn dữ liệu từ bảng sản phẩm
if ($search !== "") {
    $search = $conn->real_escape_string($search); // Chống SQL Injection
    $sql = "SELECT product_name.p_name, products.p_id, product_image.product_image FROM products INNER JOIN product_image ON products.p_id = product_image.p_id INNER JOIN product_name ON products.p_name_id = product_name.p_name_id WHERE product_name.p_name LIKE '%$search%' LIMIT 10";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<li class="search-item">';
            echo '<a href="?module=user&action=shop-detail&p_id=' . $row['p_id'] . '">';
            echo '<img src= "' . _WEB_HOST_TEMPLATE . '/image/' . $row['product_image'] . '" width="100" alt="' . $row['product_image'] . '">';
            echo '<span>' . $row['p_name'] . '</span>';
            echo '</a></li>';
        }
    } else {
        echo '<li class="search-item">Không tìm thấy sản phẩm.</li>';
    }
}

$conn->close();
