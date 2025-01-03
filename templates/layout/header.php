<?php
if (!defined('_CODE')) {
  die('Access denied');
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="utf-8" />
  <title><?php echo !empty($title['pageTitle']) ? $title['pageTitle'] : '3H1A Store'; ?></title>
  <link rel="icon" type="image/png" href="<?php echo _WEB_HOST_TEMPLATE ?>/image/favicon-96x96.png" sizes="96x96">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="keywords" />
  <meta content="" name="description" />

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
    rel="stylesheet" />

  <!-- Icon Font Stylesheet -->
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    rel="stylesheet" />

  <!-- Libraries Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Template Stylesheet -->
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/search.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/style.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/header.css" rel="stylesheet" />
  <link href="<?php echo _WEB_HOST_TEMPLATE ?>/css/shop-detail.css" rel="stylesheet" />
  <style>
    .form-check {
      display: inline-block;
      margin-right: 10px;
    }

    .form-check-input:disabled+.form-check-label {
      color: #ccc;
      cursor: not-allowed;
    }

    .form-check-input:checked+.form-check-label {
      font-weight: bold;
      color: #007bff;
    }
  </style>
</head>

<body>
</body>

</html>