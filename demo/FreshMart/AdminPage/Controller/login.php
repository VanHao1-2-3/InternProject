
<?php
$act = '';
if(!isset($_GET['act'])){
include_once 'View/login.php';
}
else{
 $act = $_GET['act'];
 switch($act){
  case 'login_act':
   if(isset($_POST['username'])&& isset($_POST['password'])){
    $login = new login();
    $result = $login ->getAdmin($_POST['username'],$_POST['password']);
    if($result){
     echo '<script>alert("Đăng nhập thành công")</script>';
     echo '<meta http-equiv=refresh content="0;url=./index.php?action=home"/>';
    }else{
     echo '<script>alert("Đăng nhập thất bại")</script>';
     echo '<meta http-equiv=refresh content="0;url=./index.php?action=login"/>';
    }
   }
   break;
 }
}
?>