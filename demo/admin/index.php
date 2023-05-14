
<?php 
include './model/connect.php';
include './model/login.php';
include './model/product.php';
include './model/bill.php';
include './model/customer.php';
include './model/admin.php';
include './model/chart.php';
session_start();

$ctrl = $_GET['action'] ?? 'homeCtrl';
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
  include './controller/'.$ctrl.'.php';
}else{
    if($ctrl == 'homeCtrl' && empty($_GET['act'])){
        include './view/head.php'; 
        include './controller/'.$ctrl.'.php';
        include './view/script.php';
    }
    else{
        include './view/head.php'; 
        // include './view/headBody.php';
        include './view/navbar.php';
        include './controller/'.$ctrl.'.php';
        include './view/footer.php';
        include './view/script.php';

    }
}


?>