<?php
$act = $_GET['act'] ?? '';
switch($act){
  case 'login':
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $login_model = new login();
    $result = $login_model -> AdminLogin($name, md5($password));
    if(!empty($result)){
     echo json_encode(array('success'=> true));
     $_SESSION['admin_id'] = $result['id'];
    }else{
     echo json_encode(array('success'=> false));
    }
     break;
  case 'login_act':
   include './view/content.php';
   break;
  default:
  include './view/login.php';
  break;
}
?>