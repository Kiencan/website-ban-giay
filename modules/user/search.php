<?php

if (!defined('_CODE')) {
    die('Access denied');
}

if (isset($_POST['query'])) {
    $search = isset($_POST['query']) ? $_POST['query'] : "";
}

// Truy vấn dữ liệu từ bảng sản phẩm
if ($search !== "") {

    // $sql = "SELECT product_name.p_name, products.p_id, product_image.product_image FROM products INNER JOIN product_name ON products.p_name_id = product_name.p_name_id LEFT JOIN product_image ON products.p_id = product_image.p_id WHERE product_name.p_name LIKE '%$search%' LIMIT 10";
    $sql = "
        SELECT 
            pn.p_name, 
            p.p_id, 
            (
                SELECT 
                    pi.product_image 
                FROM 
                    product_image pi 
                WHERE 
                    pi.p_id = p.p_id 
                LIMIT 1
            ) AS product_image 
        FROM 
            products p
        INNER JOIN 
            product_name pn 
        ON 
            p.p_name_id = pn.p_name_id 
        WHERE 
            pn.p_name LIKE '%$search%' 
        LIMIT 10";

    $result = getRaw($sql);

    if ($result) {
        foreach ($result as $key => $value) {
            echo '<li class="search-item">';
            echo '<a href="?module=user&action=shop-detail&p_id=' . $value['p_id'] . '">';
            echo '<img src= "' . _WEB_HOST_TEMPLATE . '/image/' . $value['product_image'] . '" width="100" alt="' . $value['product_image'] . '">';
            echo '<span>' . $value['p_name'] . '</span>';
            echo '</a></li>';
        }
    } else {
        echo '<li class="search-item">Không tìm thấy sản phẩm.</li>';
    }
}
