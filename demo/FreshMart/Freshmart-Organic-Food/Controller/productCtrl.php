<?php
$ctrl = "";
if(isset($_GET['act'])){
   $ctrl = $_GET['act'];}
   switch($ctrl){
      case 'allproduct': include_once "./View/product-list.php";break;
      case 'detail': include_once "./View/product-detail.php";break;
      case 'cart': include_once "./View/product-cart.php";break;
      case 'comment':
         if( isset($_GET['id']) && isset($_POST['rating'])){
            $mahh = $_GET['id'];
            $makh = $_SESSION['makh'];
            $rating = $_POST['rating'];
            $noidung = $_POST['comment'];
            $cm = new product();
            $comment = $cm ->insertComment($mahh,$makh,$noidung,$rating);
         echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=productCtrl&act=detail&id='.$mahh.'"/>';
         }
         break;
         case "search":
            if(isset($_POST['txtsearch'])){
               $search = $_POST['txtsearch'];
            }
            include_once "./View/product-list.php";
            break;
            case 'yeuthich':
               if(isset($_GET['id'])){
                  $prod = new product();
                  $wishlist = $prod-> checkWishlist($_GET['id']);                
               if($wishlist[0] !== 0){
                  echo '<script>alert("Mặt hàng này đã có trong danh sách yêu thích")</script>';
               }else{
                  $product = $prod-> getDetail($_GET['id']);
                 $prod->insertWishlist(
                  $product['masp'],
                  $product['tensp'],
                  $product['soluong'],
                  $product['dongia'],
                  $product['hinh'],
                  $product['motasanpham'],
                  $product['Nhom'],
                  $product['soluongban']);
                  echo '<script>alert("Cập nhật danh sách yêu thích thành công")</script>';
               }
               }else{
                  echo '<script>alert("Không tìm thấy sản phẩm")</script>';
               }
               echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=productCtrl&act=allproduct"/>';
               break;
               default:
               include "View/product-list.php";
               break;
   }
