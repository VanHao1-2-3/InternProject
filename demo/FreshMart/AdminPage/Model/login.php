<?php

class login{
 public function __construct()
 {
  
 }
 public function getAdmin($username,$password){
$db = new connect();
$pass = md5($password);
$select = "SELECT * from admintable where username = '$username' and password = '$pass'";
$result = $db ->getInstance($select);
 return $result;
}

}
?>