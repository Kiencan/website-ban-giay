<?php
if (!defined('_CODE')) {
    die('Access denied');
}
$connect = new mysqli("localhost", "root", "", "shoes_shop_db");

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
// Nhận thông tin từ AJAX
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$brand = isset($_POST['brand']) ? $connect->real_escape_string($_POST['brand']) : '';
$categoryId = isset($_POST['categoryId']) ? (int)$_POST['categoryId'] : '';
$currentPrice = isset($_POST['currentPrice']) ? (string)$_POST['currentPrice'] : '';
$currentCollection = isset($_POST['currentCollection']) ? (string)$_POST['currentCollection'] : '';
$order = isset($_POST['orderByPrice']) ? (string)$_POST['orderByPrice'] : 'normal';

$price = explode("-", $currentPrice);
$price[0] = isset($price[0]) ? (int)$price[0] : 0;
$price[1] = isset($price[1]) ? (int)$price[1] : 0;

$limit = 9; // Số sản phẩm mỗi trang
$offset = ($page - 1) * $limit;


// Câu truy vấn chính
$query = "SELECT p.*, pn.p_name, col.collection_name, c.category_name, 
(SELECT product_image FROM product_image WHERE p_id = p.p_id LIMIT 1) as product_image
FROM products p
JOIN product_name pn ON p.p_name_id = pn.p_name_id
JOIN collection col ON pn.collection_id = col.collection_id
JOIN category c ON col.category_id = c.category_id";
if ($categoryId == 15) {
    $query .= " WHERE p.isBestSelling = 1";
} else if ($categoryId == 16) {
    $query .= " WHERE p.discount > 0 ";
} else {
    $query .= " WHERE c.category_id = $categoryId";
}
if (!empty($brand)) {
    $query .= " AND c.category_name LIKE '%$brand'";
}
if (!empty($currentCollection)) {
    $query .= " AND col.collection_name LIKE '%$currentCollection'";
}
if (!empty($currentPrice)) {
    $query .= " AND p.p_price_min BETWEEN $price[0] AND $price[1]";
}

if ($order === 'normal') {
    $query .= " ORDER BY p.create_at DESC";
}
if ($order === 'increase') {
    $query .= " ORDER BY p.p_price_min DESC";
}
if ($order === 'decrease') {
    $query .= " ORDER BY p.p_price_min ASC";
}
$query .= " LIMIT $offset, $limit";

// SELECT p.*, pn.p_name, c.category_name, 
// (SELECT product_image FROM product_image WHERE p_id = p.p_id LIMIT 1) as product_image
// FROM products p
// JOIN product_name pn ON p.p_name_id = pn.p_name_id
// JOIN collection col ON pn.collection_id = col.collection_id
// JOIN category c ON col.category_id = c.category_id
// WHERE c.category_name LIKE "%Nike";
$result = $connect->query($query);
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
// SELECT COUNT(*) as total
// FROM products p
// JOIN product_name pn ON p.p_name_id = pn.p_name_id
// JOIN collection col ON pn.collection_id = col.collection_id
// JOIN category c ON col.category_id = c.category_id
// WHERE c.category_name = 'Giày Adidas';
// Tổng số sản phẩm cho phân trang
$total_query = "SELECT COUNT(*) as total
FROM products p
JOIN product_name pn ON p.p_name_id = pn.p_name_id
JOIN collection col ON pn.collection_id = col.collection_id
JOIN category c ON col.category_id = c.category_id";
if ($categoryId == 15) {
    $total_query .= " WHERE p.isBestSelling = 1";
} else if ($categoryId == 16) {
    $total_query .= " WHERE p.discount > 0 ";
} else {
    $total_query .= " WHERE c.category_id = $categoryId";
}
if (!empty($brand)) {
    $total_query .= " AND c.category_name LIKE '%$brand'";
}
if (!empty($currentCollection)) {
    $total_query .= " AND col.collection_name LIKE '%$currentCollection'";
}
if (!empty($currentPrice)) {
    $total_query .= " AND p.p_price_min BETWEEN $price[0] AND $price[1]";
}
$total_result = $connect->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

$output = [
    'products' => $products,
    'total_products' => $total_products,
    'total_pages' => ceil($total_products / $limit),
];

echo json_encode($output);

$connect->close();
