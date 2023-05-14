<?php
if (!isset($_SESSION['cartTemplate'])) {
   $_SESSION['cartTemplate'] = array();
}
$act = '';
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}
switch ($act) {
   case 'cart':
      if (isset($_POST['masp']) || isset($_GET['id'])) {
         $_SESSION['masp'] = isset($_POST['masp']) ? $_POST['masp'] : $_GET['id'];
         $masp = isset($_POST['masp']) ? $_POST['masp'] : $_GET['id'];
         $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 1;
         $gh = new cart();
         $result = $gh->addProduct($masp, $soluong);
         $prods = new product();
         $quantity = $prods->getDetail($masp);
         if($quantity['soluong'] > 0){
            if ($result != 'false') {
               echo "<script>alert('Thêm sản phẩm thành công')</script>";
            }
         }
         else{
            echo "<script>alert('Mặt hàng này không có sẵn')</script>";
         }
         if(isset($_POST['masp'])){
            echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=productCtrl&act=detail&id='.$_SESSION['masp'].'">';
         }else{
            echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=productCtrl&act=allproduct">';
         }
      }
      break;
   case 'delete':
      if (isset($_GET['id'])) {
         $key = $_GET['id'];
      }
      $item = new cart();
      $item->delete($key);
      include_once 'View/product-cart.php';
      break;
   case 'update':
      if (isset($_POST['soluong'])) {
         $new_list = $_POST['soluong'];
         foreach ($new_list as $key => $quantity) {
            if ($_SESSION['cartTemplate'][$key]['soluong'] != $quantity) {
               $updating = new cart();
               $updating->update($key, $quantity);
            }
         }
      }
      include_once 'View/product-cart.php';
      break;
   case 'checkout':
      include_once 'View/product-checkout.php';
      break;
   default:
      include 'View/product-cart.php';
      break;
}
