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

$limit = 9; // Số sản phẩm mỗi trang
$offset = ($page - 1) * $limit;

// Câu truy vấn chính
$query = "SELECT p.*, pn.p_name, c.category_name, 
(SELECT product_image FROM product_image WHERE p_id = p.p_id LIMIT 1) as product_image
FROM products p
JOIN product_name pn ON p.p_name_id = pn.p_name_id
JOIN collection col ON pn.collection_id = col.collection_id
JOIN category c ON col.category_id = c.category_id";
if (!empty($brand)) {
    $query .= " WHERE c.category_name LIKE '%$brand' ";
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
if (!empty($brand)) {
    $total_query .= " WHERE c.category_name LIKE '%$brand'";
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
?>