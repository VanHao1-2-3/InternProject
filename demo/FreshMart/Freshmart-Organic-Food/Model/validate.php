<?php

class validate
{
   public function checkRegister($name, $address, $email, $phone, $password, $conpassword)
   {

      $_SESSION['usnameErr'] = $_SESSION['addressErr'] = $_SESSION['emailErr'] = $_SESSION['phoneErr'] = $_SESSION['passErr'] = $_SESSION['confirmPassErr'] = '';

      if (empty($name)) {
         $_SESSION['usnameErr'] = "Username must not be blank";
      } else {
         if (!preg_match("/^[a-zA-Z]/", $name)) {
            $_SESSION['usnameErr'] = "Username must start with a letter and not contain special characters";
         } else {
            $_SESSION['usnameErr'] = '';
         }
      }
      if (empty($address)) {
         $_SESSION['addressErr'] = "Address must not be blank";
      } else {
         $_SESSION['addressErr'] = '';
      }
      if (empty($email)) {
         $_SESSION['emailErr'] = "Email must not be blank";
      } else {
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['emailErr'] = "Incorrect email format";
         } else {
            $_SESSION['emailErr'] = '';
         }
      }

      if (empty($phone)) {
         $_SESSION['phoneErr'] = "Phone number must not be blank";
      } else {
         if (!preg_match("/^0{1}\d{9,10}$/", $phone)) {
            $_SESSION['phoneErr'] = "Incorrect phone number format";
         } else {
            $_SESSION['phoneErr'] = '';
         }
      }
      if (empty($password)) {
         $_SESSION['passErr'] = "Password must not be blank";
      } else {
         if (!preg_match("/^[A-Z][a-z0-9]{6}[^a-z0-9]$/", $password)) {
            $_SESSION['passErr'] = "Password must be start with a capital letter and end with a special letter";
         } else {
            $_SESSION['passErr'] = '';
         }
      }
      if (empty($conpassword)) {
         $_SESSION['confirmPassErr'] = "Password confirm must not be blank";
      } else {
         if ($conpassword == $password) {
            $_SESSION['confirmPassErr'] = '';
         }
      }

      if ($_SESSION['usnameErr'] == "" && $_SESSION['addressErr'] == "" && $_SESSION['emailErr'] == "" && $_SESSION['phoneErr'] == "" && $_SESSION['passErr'] == "" && $_SESSION['confirmPassErr'] == '') {
         return 1;
      }
   }
   function checkLogin($email, $password)
   {
      $_SESSION['emailLogin'] = '';
      $_SESSION['passwordLogin'] = '';
      if (empty($email)) {
         $_SESSION['emailLogin'] = 'Email must not be blank';
      } else{
         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['emailErr'] = "Incorrect email format";
         }
         else {
            $_SESSION['emailLogin'] = '';
         }
      }
      if (empty($password)) {
         $_SESSION['passwordLogin'] = 'Password must not be blank';
      } else {
         $_SESSION['passwordLogin'] = '';
      }
      if ($_SESSION['passwordLogin'] == '' && $_SESSION['emailLogin'] = '') {
         return  1;
      }
   }
   function changePassword($old, $new, $cfnew)
   {
      $_SESSION['oldPass'] = $_SESSION['newPass'] = $_SESSION['cfPass'] = '';
     if(empty($old)){
      $_SESSION['oldPass'] = 'This field must not be plank';
     }
     elseif(md5($old) != $_SESSION['matkhau']){
      $_SESSION['oldPass'] = 'Password is not correct';
     }
     else{
      $_SESSION['oldPass'] = '';
     }
      if (empty($new)) {
         $_SESSION['newPass'] = 'This field must not be plank';
      }
      else{
         if(!preg_match("/^[A-Z][a-z0-9]{6}[^a-z0-9]$/", $new)){
            $_SESSION['newPass'] = 'Incorrect password format';
         }
         else{
            $_SESSION['newPass'] = '';
         }
      }
      $_SESSION['cfPass'] = $new != $cfnew ? "Password confirmation is not correct" : '';
   if($_SESSION['oldPass'] =='' && $_SESSION['newPass'] == ''&& $_SESSION['cfPass'] == ''){
      return 1;
   }
   }
}
