<?php
$act = "";
if (isset($_GET['act'])) {
   $act = $_GET['act'];
}
switch ($act) {
   case 'checkout':
      include_once './View/product-checkout.php';
      break;
   case 'login':
      include_once './View/user-login.php';
      break;
   case 'login_act':
        $check = new validate();
        $checkLolin = $check-> checkLogin($_POST['email'],$_POST['password']);
         $email = $_POST['email'];
         $password = $_POST['password'];
         $us = new user();
         $login = $us->userLogin($email, md5($password));
         if ($login) {
            $_SESSION['makh'] = $login['makh'];
            $_SESSION['tenkh'] = $login['tenkh'];
            $_SESSION['email'] = $login['email'];
            $_SESSION['matkhau'] = $login['matkhau'];
            echo '<script type="text/javascript">
            const Toast = Swal.mixin({
               toast: true,
               position: "top-end",
               showConfirmButton: false,
               timer: 700,
               timerProgressBar: true,
               didOpen: (toast) => {
                 toast.addEventListener("mouseenter", Swal.stopTimer)
                 toast.addEventListener("mouseleave", Swal.resumeTimer)
               }
             })
             
             Toast.fire({
               icon: "success",
               title: "Đăng nhập thành công",
               customClass:{
                  popup:"fontSize"
               }
             })
     </script>';
            echo '<meta http-equiv="refresh"  content=".7; url=./index.php?action=homeCtrl"/>';
         } else {
            echo '<script type="text/javascript">
               alert("Đăng nhập thất bại")
     </script>';
            include_once "./View/user-login.php";
      }
      break;
   case 'register':
      include_once './View/user-register.php';
      break;
   case 'register_act':
      $checkReg = new validate();
      $kq = $checkReg->checkRegister($_POST['username'], $_POST['address'], $_POST['email'], $_POST['phone'], $_POST['password'], $_POST['password2']);
      if (
         $kq == 1
      ) {
         $username = $_POST['username'];
         $email = $_POST['email'];
         $password = $_POST['password'];
         $password2 = $_POST['password2'];
         $phone = $_POST['phone'];
         $address = $_POST['address'];
         $us = new user();
         $checkUs = $us->checkUser($username, $email,$phone);
         if ($checkUs) {
            echo '<script>alert("Tài khoản đã tồn tại 🥲🥲🥲")</script>';
            include_once './View/user-register.php';
         } else {
            $check = $us->InsertUser($username, $address, $email, $phone, md5($password));
            if ($check != 'false') {
               echo '<script>alert("Đăng kí thành công 😁")</script>';
               include_once './View/user-login.php';
            } else {
               echo '<script>alert("Đăng kí thất bại 😒🥲")</script>';
               include_once './View/user-register.php';
            }
         }
      } else {
         include_once './View/user-register.php';
      }
      break;
   case 'logout':
      unset($_SESSION['makh']);
      unset($_SESSION['tenkh']);
      unset($_SESSION['email']);
      unset($_SESSION['cartTemplates']);
      echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=homeCtrl"/>';
      break;
   case 'changepass':
      $change = new validate();
      $_SESSION['oldPass'] = $_SESSION['newPass'] = $_SESSION['cfPass'] = '';
      $kq = 0;
      if(isset($_POST['passwordChange1']) && isset($_POST['passwordChange2']) && isset($_POST['passwordChange3'])){
         $kq = $change-> changePassword($_POST['passwordChange1'],$_POST['passwordChange2'],$_POST['passwordChange3']);
      }
    
      if($kq == 1){
         $new = $_POST['passwordChange2'];
         $newcheck = new user();
         $update = $newcheck -> changePassword(md5($new),$_SESSION['makh']);
         if(empty($update)){
            echo '<script>alert("Thay đổi mật khẩu thành công 😁")</script>';
            echo '<meta http-equiv="refresh"  content="0; url=./index.php?action=user&act=login"/>';
         }
         
      }
      include './View/changePassword.php';
      break;
}
