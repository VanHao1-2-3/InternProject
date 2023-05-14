<?php
$act = '';
if (isset($_GET['act'])) {
  $act = $_GET['act'];
}
switch ($act) {
  case 'update':
    include 'View/producttype.php';
    break;
  case 'type_update':
    if (isset($_POST['maloai'])) {
      $maloai =  $_POST['maloai'];
      $tenloai = isset($_POST['tenloai']) ? $_POST['tenloai'] : null;
      $type = new type();
      $type->editType($maloai, $tenloai);
    }
    echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
    break;
  case 'add':
    include 'View/producttype.php';
    break;
  case 'type_add':
    if (empty($_POST['maloai']) || empty($_POST['tenloai'])) {
      echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'warning',
          title: 'Cảnh báo',
          text: 'Vui lòng nhập đầy đủ các trường',
          confirmButtonText: 'OK',
        })
        </script>";
      echo '<meta http-equiv=refresh content="2;url=./index.php?action=type&act=add"/>';
    } else {
      $type = new type();
      $maloai = $type->getMaloai($_POST['maloai']);
      if ($maloai != null) {
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Thất bại.',
          text: 'Mã loại hàng đã tồn tại!',
          confirmButtonText: 'OK',
        })
        </script>";
        echo '<meta http-equiv=refresh content="2;url=./index.php?action=type&act=add"/>';
      } else {
        $type->insertProductType($_POST['maloai'], $_POST['tenloai']);
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'Thành công.',
          text: 'Thêm loại thành công',
          confirmButtonText: 'OK',
        })
        </script>";
        echo '<meta http-equiv=refresh content="2;url=./index.php?action=home"/>';
      }
    }
    break;
  case 'type_delete':
    if (isset($_GET['maloai'])) {
      $type = new type();
      $type->deleteType($_GET['maloai']);
      echo "<script type='text/javascript'>
      Swal.fire({
        icon: 'success',
        title: 'Thành công.',
        text: 'Xóa thành công',
        confirmButtonText: 'OK',
      })
      </script>";
      print_r($_GET['maloai']);
    }
    echo '<meta http-equiv=refresh content="3;url=./index.php?action=home"/>';
    break;
  case 'import':
    if (isset($_POST['submit_file'])) {
      $file = $_FILES['file']['tmp_name'];
      // Xóa những kí tự đặc biệt
      file_put_contents($file, str_replace("\xEF\xBB\xBF", "", file_get_contents($file)));
      // mở file ra
      $file_open = fopen($file, "r");
      // đọc nội dung của file
      while (($csv = fgetcsv($file_open, 1000, ",")) != false) {
        $db = new connect();
        $import = "INSERT INTO loaisp(maloai,loaisp) values
      ($csv[0],'$csv[1]')";
      $result = $db -> exec($import);
      if($result != 'false'){
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'Thành công.',
          text: 'Nhập dữ liệu thành công',
          confirmButtonText: 'OK',
        })
        </script>";
        echo '<meta http-equiv=refresh content="3;url=./index.php?action=home"/>';
      }else{
        echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'error',
          title: 'Thất bại.',
          text: 'Nhập dữ liệu không thành công!',
          confirmButtonText: 'OK',
        })
        </script>";
      }
      }
    }
    break;
}
