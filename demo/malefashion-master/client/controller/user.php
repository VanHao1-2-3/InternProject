<?php
$act = $_GET['act'] ?? '';
switch($act){
  case 'signup':
    include './view/signup.php';
    break;
    case 'login':
      include './view/login.php';
      break;
    case 'login_act':
      $error = array();
      $email_signin = $_POST['email_signin'] ?? '';
      $password_signin = $_POST['password_signin'] ?? '';
      $error['email_signin'] = empty($email_signin) ? "Không được để trống trường này" : '';
      $error['password_signin'] = empty($password_signin) ? "Không được để trống trường này" : '';
      $user = new user();
      $checkLogin = $user->checkLogin($email_signin, md5($password_signin));
      $_SESSION['customer_id'] = $checkLogin['id']??'';
      $_SESSION['customer_name'] = $checkLogin['customer_name']??'';
      $err = 0;
      foreach ($error as $key => $value) :
        if (empty($value)) {
          $err += 1;
        }
      endforeach;
      $result = '';
      if ($err !== count($error)) {
        $result =  json_encode(array('errors' => $error));
      } elseif (!empty($checkLogin)) {
        $result =  json_encode(array('success' => true, 'name'=> $_SESSION['customer_name']));
      } else {
      
        $result =  json_encode(array('failed' => true));
      }
      echo $result;
      break;
      case 'logout':
        $flag =0;
 if(!empty($_SESSION['customer_name']) && !empty($_SESSION['customer_id'])){
  unset($_SESSION['customer_name']);
  unset($_SESSION['customer_id']);
  $flag =1;
}
if($flag == 1){
  echo json_encode(array('success'=> true));
}
  break;
  case 'forgot_password':
  include './view/forgot_password.php';
  break;
  case 'get_password':
    $email = $_POST['email'] ?? '';
    if(!empty($email)){
      $user_model = new user();
      $checkEmail = $user_model -> checkEmail($email);
      if(empty($checkEmail)){
        echo json_encode(array('notexist' => true));
      }else{
         // tạo ra code gửi qua mail đó
         $code=substr(rand(0,999999),0,6);
         // tạo ra và lưu vào Session
         //tạo ra đối tượng
         $mail = new Mailer();
         if($mail->sendMail($code,$email)){
          $user_model -> changePassword($email, md5($code));
          echo json_encode(array('success'=> true));
        } else {
          echo json_encode(array('senderror'=> true));
        }
         
      }
    }
    break;
  default:
  break;
}
?>