<?php
$act = '';
if(isset($_GET['act'])){
  $act = $_GET['act'];
}
switch($act){
  case 'changepassword':
    $admin = new admin();
    $passadmin = $admin -> getPassword();
    if(!empty($_POST['password']) && !empty($_POST['passwordnew']) && !empty($_POST['cfpasswordnew'])){
      if(md5($_POST['password']) != $passadmin){
        echo "<script>alert('Mật khẩu không chính xác')</script>";
        echo '<meta http-equiv=refresh content="0;url=./index.php?action=admin"/>';
      }elseif($_POST['passwordnew'] != $_POST['cfpasswordnew']){
        echo "<script>alert('Mật khẩu xác nhận không chính xác')</script>";
        echo '<meta http-equiv=refresh content="0;url=./index.php?action=admin"/>';
      }
      else{
        $result = $admin -> changePass($_POST['passwordnew']);
        if($result != 'false'){
          echo "<script>alert('Đổi mật khẩu thành công!! Vui lòng đăng nhập lại')</script>";
          echo '<meta http-equiv=refresh content="0;url=./"/>';
        }else{
          echo "<script>alert('Đổi mật khẩu thất bại')</script>";
          echo '<meta http-equiv=refresh content="0;url=./index.php?action=admin"/>';
        }
      }
    }else{
      echo "<script>alert('Vui lòng nhập đầy đủ các trường')</script>";
      echo '<meta http-equiv=refresh content="0;url=./index.php?action=admin"/>';
    }
    break;
  default:
  include 'View/changepass.php';
  break;
}
?>