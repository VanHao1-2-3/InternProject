<?php
$act = '';
if(isset($_GET['act'])){
$act = $_GET['act'];
}
switch($act){
  case 'update':
    $result = 'false';
    if(isset($_SESSION['masp'])
     ){
      $maspnew = $_POST['masp'];
      $tensp = $_POST['tensp'];
      $dongia = $_POST['dongia'];
      $soluong = $_POST['soluong'];
      $soluongban = $_POST['soluongban'];
      $hinh = $_FILES['hinh']['name'];
      $mota = $_POST['mota'];
      $nhom = $_POST['Nhom'];
      $product = new product();
      $masp = $product -> getMasp($maspnew);
      if( $masp == false || $masp[0]== $_SESSION['masp']){
        $result =  $product -> updateProduct(
          $_SESSION['masp'],
          $maspnew,
          $tensp,
          $soluong,
          $dongia,
          $hinh,
          $mota,
          $nhom,
          $soluongban);
          if($result !='false'){
            uploadImage();
            echo "<script type='text/javascript'>
            Swal.fire({
              icon: 'success',
              title: 'Thành công',
              text: 'Cập nhật sản phẩm thành công',
            })
            </script>";
            //  echo '<meta http-equiv=refresh content="2;url=./index.php?action=home"/>';
           }else{
            echo "<script type='text/javascript'>
            Swal.fire({
              icon: 'error',
              title: 'Thành công',
              text: 'Cập nhật sản phẩm không thành công',
            })
            </script>";
            //  echo '<meta http-equiv=refresh content="2;url=./index.php?action=product&masp='.$_SESSION['masp'].'"/>';
           }
        }else{
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Thất bại.',
          text: 'Mã sản phẩm đã tồn tại!',
          confirmButtonText: 'OK',
        })
        </script>";
        echo '<meta http-equiv=refresh content="2;url=./index.php?action=product&masp='.$_SESSION['masp'].'"/>';
        }
        
     }
    break;
    case 'add':
      if(!empty($_POST['masp'])
      &&!empty($_POST['tensp'])
      &&!empty($_POST['soluong'])
      &&!empty($_POST['dongia'])
      &&!empty($_FILES['hinh']['name'])
      &&!empty($_POST['mota'])
      &&isset($_POST['Nhom'])
      && !empty($_POST['soluongban']))
      {
        $masp = $_POST['masp'];
        $tensp = $_POST['tensp'];
        $dongia = $_POST['dongia'];
        $soluong = $_POST['soluong'];
        $soluongban = $_POST['soluongban'];
        $hinh = $_FILES['hinh']['name'];
        $mota = $_POST['mota'];
        $nhom = $_POST['Nhom'];
        $prod = new product();
        $result = $prod-> getMasp($masp);
        // var_dump($masp,$tensp,$soluong,$dongia,$hinh,$mota,$nhom,$soluongban);
        var_dump(is_string($_POST['soluong']));
        if(isset($result[0])){
          echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Thất bại.',
          text: 'Mã sản phẩm đã tồn tại!',
          confirmButtonText: 'OK',
        })
        </script>";
          echo '<meta http-equiv=refresh content="2;url=./index.php?action=product"/>';
        }else{
          uploadImage();
          $prod ->addProduct($masp,$tensp,$soluong,$dongia,$hinh,$mota,$nhom,$soluongban);
          echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'Thành công',
          text: 'Thêm sản phẩm thành công',
          confirmButtonText: 'OK',
        })
        </script>";
          echo '<meta http-equiv=refresh content="2;url=./index.php?action=home"/>';
        }
      }
      else{
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'warning',
          title: 'Cảnh báo',
          text: 'Vui lòng nhập đầy đủ thông tin',
          confirmButtonText: 'OK',
        })
        </script>";
        echo '<meta http-equiv=refresh content="2;url=./index.php?action=product"/>';
      }
    break;
    case 'delete':
      if(isset($_GET['masp'])){
        $prod = new product();
        $result = $prod->deleteProduct($_GET['masp']);
        if($result != 'false'){
          echo "<script type='text/javascript'>
          Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: 'Xóa sản phẩm thành công',
            confirmButtonText: 'OK',
          })
          </script>";
          echo '<meta http-equiv=refresh content="2;url=./index.php?action=home"/>';
        }else{
          echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Thất bại.',
          text: 'Xóa sản phẩm không thành công',
          confirmButtonText: 'OK',
        })
        </script>";
          echo '<meta http-equiv=refresh content="2;url=./index.php?action=product"/>';
        }
      }
      break;
    default:
    if(isset($_GET['masp'])){
      $_SESSION['masp'] = $_GET['masp'];
    }
    include "View/productForm.php";
    break;
}
