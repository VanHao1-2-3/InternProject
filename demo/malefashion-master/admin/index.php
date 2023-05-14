
<?php
include './model/connect.php';
include './model/login.php';
include './model/bill.php';
include './model/product.php';
session_start();
// session_destroy();

$ctrl = $_GET['action'] ?? 'homeCtrl';
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
  include './controller/'.$ctrl.'.php';
}else{
  include './view/navigation.php';
  include './view/head.php';
  include './controller/'.$ctrl.'.php';
  include './view/footer.php';

}
?>

