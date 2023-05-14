<?php
session_start();
// session_destroy();

include_once './model/connect.php';
include_once './model/products.php';
include_once './model/user.php';
include_once './model/cart.php';
include_once './model/bill.php';
include './mail/index.php';
?>

    <?php
    $action =  $_GET['action'] ?? 'home';
    // Kiểm tra xem trang web đang được yêu cầu thông qua AJAX hay không
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        include_once './controller/'.$action.'.php';
    } else {
        // Nếu không phải yêu cầu AJAX, bao gồm phần header và footer
        include_once './view/head.php';
        include_once './view/header.php';
        include_once './controller/'.$action.'.php';
        include_once './view/footer.php';
        include_once './view/script.php';
    }
    ?>

