<?php
$act = $_GET['act'] ?? '';
switch ($act) {
    // phần sản phẩm
  case 'show-products':
    include './view/product.php';
    break;
  case 'add-products':
    include './view/add-products.php';
    break;
  case 'update-products':
    include './view/product.php';
    break;
  case 'delete-products':
    include './view/product.php';
    break;
    // Phần bill
  case 'show-bills':
    include './view/bills.php';
    break;
  case 'update-bills':
    include './view/bills.php';
    break;
  case 'delete-bills':
    include './view/bills.php';
    break;
    // phần khách hàng
  case 'show-customers':
    include './view/customers.php';
    break;
  case 'delete-customers':
    include './view/customers.php';
    break;
    // phần tài khoản quản trị
  case 'show-admin':
    include './view/admin.php';
    break;
  case 'add-admin':
    include './view/add-admin.php';
    break;
  case 'delete-admin':
    include './view/admin.php';
    break;
  case 'show-chart':
    include './view/charts.php';
    break;
  default:
    break;
}
?>
