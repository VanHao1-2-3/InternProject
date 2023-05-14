<?php
// include '../model/connect.php';
// include '../model/user.php';
// session_start();
// $error = array();
//       $email_signin = $_POST['email_signin'] ?? '';
//       $password_signin = $_POST['password_signin'] ?? '';
//       $error['email_signin'] = empty($email_signin) ? "Không được để trống trường này" : '';
//       $error['password_signin'] = empty($password_signin) ? "Không được để trống trường này" : '';
//       $user = new user();
//       $checkLogin = $user->checkLogin($email_signin, md5($password_signin));
//       $_SESSION['customer_id'] = $checkLogin['id']??'';
//       $_SESSION['customer_name'] = $checkLogin['customer_name']??'';
//       $err = 0;
//       foreach ($error as $key => $value) :
//         if (empty($value)) {
//           $err += 1;
//         }
//       endforeach;
//       if ($err !== count($error)) {
//         echo json_encode(array('errors' => $error));
//       } elseif (!empty($checkLogin)) {
//         echo json_encode(array('success' => true, 'name'=> $_SESSION['customer_name']));
//       } else {
      
//         echo json_encode(array('failed' => true));
//       }
?>
