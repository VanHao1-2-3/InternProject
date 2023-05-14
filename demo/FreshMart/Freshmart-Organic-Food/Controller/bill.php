<?php
if(isset($_SESSION['makh'])){
   include_once './View/product-checkout.php';
}
else{
   echo "<script>alert('Bạn chưa đăng nhập')</script>";
   echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=user&act=login"/>';
}
if(isset($_GET['act']) && $_GET['act'] == 'checkout'){
   $bill = new bill();
   $mahd = $bill->insertBill($_SESSION['makh']);
   $_SESSION['mahd'] = $mahd;
   $tongtien = 0;
   foreach($_SESSION['cartTemplate'] as $item){
      $bill->insertDetail($mahd,$item['masp'],$item['soluong'],$item['tongtien']);
      $tongtien += $item['tongtien'];
   }
   $bill ->updateTotal($mahd,$tongtien);
   $update = new product();
   foreach($_SESSION['cartTemplate'] as $item){
      $update -> updateProductDB($item['masp'],$item['soluong']);
   }
   echo "<script>alert('Thanh toán thành công')</script>";
   unset($_SESSION['cartTemplate']) ;
   echo '<meta http-equiv="refresh"  content="0; url=./index.php"/>';
}
?>