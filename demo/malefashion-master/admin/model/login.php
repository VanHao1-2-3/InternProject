<?php

class login{
  public function AdminLogin($adname, $pass){
  $conn = new connect(); 
  $select = "SELECT * FROM admintable where admin_name = '$adname' AND password='$pass'";
  $result = $conn -> getInstance($select);
  return $result;
  }
}
?>