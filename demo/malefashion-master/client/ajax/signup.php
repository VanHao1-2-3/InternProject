<?php
include '../model/user.php';
include '../model/connect.php';
$error = array();
$pattern = "/^[a-zA-Z ]+$/";
$phone_reg = '/^(0|\+84)[3|5|7|8|9][0-9]{8}$/';
$password_reg = '/^[A-Z].{0,14}[^A-Za-z0-9]$/';
$username = $_POST['username'] ?? '';
$address = $_POST['address'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';

// validate username
if (empty($username)) {
  $error['username'] = "Không được để trống trường này";
} else {
  if (strlen($username) > 20) {
    $error['username'] = "Tên không vượt quá 20 kí tự";
  } else {
    $error['username'] = "";
  }
}
// validate address
if (empty($address)) {
  $error['address'] = "Không được để trống trường này";
} else {
  $error['address'] = "";
}
// validate phone
if (empty($phone)) {
  $error['phone'] = "Không được để trống trường này";
} else {
  if (!preg_match($phone_reg, $phone)) {
    $error['phone'] = "Không đúng định dạng. Ví dụ +84/0 123456789";
  } else {
    $error['phone'] = "";
  }
}
// validate email 
if (empty($email)) {
  $error['email'] = "Không được để trống trường này";
} else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error['email'] = "Email không đúng định dạng";
  } else {
    $error['email'] = "";
  }
}
// validate password
if (empty($password)) {
  $error['password'] = "Không được để trống trường này";
} else {
  if (strlen($password) > 16) {
    $error['password'] = "Mật khẩu không vượt quá 16 kí tự";
  } elseif (!preg_match($password_reg, $password)) {
    $error['password'] = "Mật khẩu bắt đầu bằng kí tự in hoa, kết thúc bằng kí tự đặc biệt";
  } else {
    $error['password'] = "";
  }
}
$err = 0;
foreach ($error as $key => $value) :
  if (empty($value)) {
    $err += 1;
  }
endforeach;

$user = new user();
$checkUser = $user -> checkExistedUser($username,$email, $phone);
if ($err !== count($error)) {
  echo json_encode(array('errors' => $error));
} elseif(!empty($checkUser)){
  echo json_encode(array('existed'=> true));
}
else {
  $insert = $user->insertUser($username, $address, $email, $phone, md5($password));
  echo json_encode(array('success' => true));
}
