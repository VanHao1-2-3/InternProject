<?php
$act = '';
if (isset($_GET['act'])) {
  $act = $_GET['act'];
}
switch ($act) {
  case 'update':
   if(isset($_GET['mahd'])){
    $_SESSION['mahd'] = $_GET['mahd'];
   }
   include 'View/bill.php';
    break;
  case 'bill_update':
    if (
      isset($_POST['mahd'])
      && isset($_POST['makh'])
      && isset($_POST['ngaydat'])
    ) {
      $date = $_POST['ngaydat'];
      $dateFormat = date('Y-m-d',strtotime($date));
      $bill = new bill();
      $result = $bill -> getMakh($_POST['makh']);
      if(isset($result[0])){
        $bill->updateBill(
          $_SESSION['mahd'],
          $_POST['mahd'],
          $_POST['makh'],
          $dateFormat
        );
        echo '<script>alert("Cập nhật hóa đơn thành công")</script>';
        echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
      }
      else{
        echo '<script>alert("Mã khách hàng không tồn tại")</script>';
        echo '<meta http-equiv=refresh content="0;url=./index.php?action=bill&mahd='.$_SESSION['mahd'].'"/>';
      }
    }
    else{
      echo '<script>alert("Cập nhật hóa đơn không thành công")</script>';
      echo '<meta http-equiv=refresh content="0;url=./index.php?action=bill&mahd='.$_SESSION['mahd'].'"/>';
    }
    break;
  case 'detail':
    include "View/billDetail.php";
    if(isset($_GET['mahd']) && isset($_GET['masp'])){
      $_SESSION['mahd']= $_GET['mahd'];
      $_SESSION['masp']= $_GET['masp'];
    }
    break;
  case 'update_detail':
    $tongtien = 0 ;
    if(isset($_POST['masp']) && isset($_POST['soluong'])){
      $masp = $_POST['masp'];
      $soluong = $_POST['soluong'];
      $bill = new bill();
      $billDetail = $bill -> getSingleBillDetail($_SESSION['mahd'],$masp);
      $billPrice = $bill->getPrice($masp);
      $thanhtien = $soluong * $billPrice[0];
      $update = $bill->updateBillDetail($_SESSION['mahd'],$_SESSION['masp'],$masp,$soluong,$thanhtien);
      if($update !='false'){
        $listBill = $bill -> getBillByMahd($_SESSION['mahd']);
        foreach($listBill as $item){
          $tongtien +=  $item['thanhtien'];
        }
      }
      $bill->updateBillTotal($_SESSION['mahd'],$tongtien);
      echo '<script>alert("Cập nhật thành công")</script>';
      echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
    }
    include "View/billDetail.php";
  break;
    break;
  case 'bill_delete':
    if(isset($_GET['mahd'])){
      $bill = new bill();
      $result = $bill->deleteBill($_GET['mahd']);
      if($result != 'false'){
        echo "<script>alert('Xóa thành công')</script>";
      }else{
        echo "<script>alert('Xóa không thành công')</script>";
      }
      echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
    }
    break;
    case 'billDetail_delete':
      if(isset($_GET['masp']) && isset($_GET['mahd'])){
        $bill = new bill();
        $price = $bill -> getDetailPrice($_GET['masp'],$_GET['mahd']);
        $result = $bill -> deleteDetailBill($_GET['mahd'],$_GET['masp']);
       $bill -> updateTotal($_GET['mahd'],$price);
       if($result != 'false'){
        echo "<script>alert('Xóa thành công')</script>";
        
      }else{
        echo "<script>alert('Xóa không thành công')</script>";
        
      }
    }
    echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
      break;
  default:
    include 'View/bill.php';
    break;
}
